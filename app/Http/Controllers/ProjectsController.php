<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

use App\Models\Amenities;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
// use App\Models\Area;
use App\Models\Builder;
use App\Models\Floor;
use App\Models\Projectamenities;
use App\Models\Projectbuilder;
// use App\Models\City;
use App\Models\Projectdetails;
use App\Models\Projects;
use App\Models\Propertytypes;
use App\Models\State;
use App\Models\Subfloor;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\Console;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page_title = "Project Management";
        $module_name = "List";

        return view('projects.index', compact('page_title', 'module_name'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $page_title = "Project Management";
        $module_name = "Add";
        $data = new Projectdetails;
        $route = 'projects.store';
        $method = 'POST';
        // dd($route);
        $states = State::where('status', 1)->pluck('name', 'id');

        $builders = Builder::where('status', 1)->pluck('name', 'id');
        $amenities = Amenities::where('status', 1)->get();
        $property_types = Propertytypes::where('status', 1)->pluck('name', 'id');
        // dd($property_types);

        return view('projects.add', compact('data', 'method', 'states', 'route', 'page_title', 'module_name', 'builders', 'amenities', 'property_types'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $rules = [
            'name' => 'required|string|max:255',

            'state_id' => 'required|exists:state,id',
            'city_id' => 'required|exists:city,id',
            'area_id' => 'required|exists:area,id',
            // 'from_price' => 'required|numeric|min:0',
            // 'to_price' => 'required|numeric|min:0',
            // 'from_sqft' => 'required|numeric|min:0',
            // 'to_sqft' => 'required|numeric|min:0',
            'building_status' => 'required|integer|in:0,1,2,3', // Adjust according to actual status values
            'completion_date' => 'required|date',
            // 'floor_plan' => 'required|string|max:255',
            // 'area_details' => 'required|numeric|min:0',

            'project_description' => 'nullable|string',

            'status' => 'nullable|integer' // Assuming status is either 0 or 1
        ];

        $messages = [
            'name.required' => 'The name field is required.',
            'state_id.exists' => 'The selected state is invalid.',
            'city_id.exists' => 'The selected city is invalid.',
            'area_id.exists' => 'The selected area is invalid.',
            'building_status.in' => 'The building status value is invalid.',
            'completion_date.date' => 'The completion date is not a valid date.',

            'status.in' => 'The status value is invalid.',
            // Add more custom messages as needed
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // dd($request);
        $data = new Projectdetails;
        if ($request->hasFile('images')) {
            $files = $request->file('images');
            $path = public_path('assets/images/projects/' . $request->name);
        
            // Create directory if it doesn't exist
            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
            }
        
            $imagePaths = [];
            foreach ($files as $key => $file) {
                $filename = $key . '_' . time() . '.' . $file->getClientOriginalExtension();
                $filePath = $file->move($path, $filename); // Move file to the specified path
                $imagePaths[] = 'assets/images/projects/' . $request->name . '/' . $filename; // Correct relative path
            }
        
            // Save the image paths as JSON in the database
            $data->img_path = json_encode($imagePaths);
        }
        
        $data->name = $request->name;
        $data->state_id = $request->state_id;
        $data->city_id = $request->city_id;
        $data->area_id = $request->area_id;
        $data->building_status = $request->building_status;
        $data->completion_date = $request->completion_date;
        $data->project_description = $request->project_description;
        $data->status = $request->status;
        $data->created_by = @Auth::user()->id;
        
        $data->save();
        $project_id = $data->id;
        // dd($project_id);

        // $floorData = $floorData ?? [];
        $name1 = $request->propertytype_id;
        // foreach ($floorData as $floor) {
        for ($i = 0; $i < count($name1); $i++) {
            $data1 = new Floor;
            $data1->propertytype_id = $request->propertytype_id[$i];
            $data1->project_id = $project_id;
            $data1->from_price = $request->from_price[$i];
            $data1->to_price = $request->to_price[$i];
            $data1->from_sqft = $request->from_sqft[$i];
            $data1->to_sqft = $request->to_sqft[$i];
            $data1->save();
            $floor_id = $data1->id; // Get the newly inserted floor ID
        }

        // $subfloor = $subfloor ?? [];
        $name2 = $request->subpropertytype_id;
        // foreach ($subfloor as $subfloors)  
        for ($j = 0; $j < count($name2); $j++) {
            $data2 = new Subfloor;
            $data2->project_id = $project_id;
            $data2->floor_id = $floor_id;
            $data2->propertytype_id = $request->subpropertytype_id[$j];
            $data2->builtup_area = $request->builtup_area[$j];
            $data2->price = $request->base_price[$j];
            $data2->save();
        }

        $data3 = new Projectamenities;
        $data3->amenities_id = $request->amenities_id;
        $data3->project_id = $project_id;
        $data3->save();

        $data4 = new Projectbuilder;
        $data4->builder_id = $request->builder_id;
        $data4->project_id = $project_id;
        $data4->save();

        $data->created_by = @Auth::user()->id;

        return response()->json([
            'message' => 'Item Created successfully.',
            'data' => $data
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Projects $projects)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {

        $page_title = "Project Management";
        $module_name = "Edit";
        $data = Projectdetails::find($id);
        $route = ['projects.update', $data->id];
        $method = 'PUT';
        // dd($route);
        $states = State::where('status', 1)->pluck('name', 'id');

        $builders = Builder::where('status', 1)->pluck('name', 'id');
        $amenities = Amenities::where('status', 1)->get();
        $property_types = Propertytypes::where('status', 1)->pluck('name', 'id');
        // dd($property_types);

        return view('projects.add', compact('data', 'method', 'states', 'route', 'page_title', 'module_name', 'builders', 'amenities', 'property_types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->all());
        $rules = [
            'name' => 'required|string|max:255',

            'state_id' => 'required|exists:state,id',
            'city_id' => 'required|exists:city,id',
            'area_id' => 'required|exists:area,id',
            // 'from_price' => 'required|numeric|min:0',
            // 'to_price' => 'required|numeric|min:0',
            // 'from_sqft' => 'required|numeric|min:0',
            // 'to_sqft' => 'required|numeric|min:0',
            'building_status' => 'required|integer|in:0,1,2,3', // Adjust according to actual status values
            'completion_date' => 'required|date',
            // 'floor_plan' => 'required|string|max:255',
            // 'area_details' => 'required|numeric|min:0',

            'project_description' => 'nullable|string',

            'status' => 'nullable|integer' // Assuming status is either 0 or 1
        ];

        $messages = [
            'name.required' => 'The name field is required.',
            'state_id.exists' => 'The selected state is invalid.',
            'city_id.exists' => 'The selected city is invalid.',
            'area_id.exists' => 'The selected area is invalid.',
            'building_status.in' => 'The building status value is invalid.',
            'completion_date.date' => 'The completion date is not a valid date.',

            'status.in' => 'The status value is invalid.',
            // Add more custom messages as needed
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }


        $data = Projectdetails::find($id);
        $data->name = $request->name;
        $data->state_id = $request->state_id;
        $data->city_id = $request->city_id;
        $data->area_id = $request->area_id;
        $data->building_status = $request->building_status;
        $data->completion_date = $request->completion_date;
        $data->project_description = $request->project_description;
        $data->status = $request->status;
        $data->save();
        $project_id = $data->id;
        // dd($project_id);

        // $floorData = $floorData ?? [];
        $name1 = $request->propertytype_id;
        // foreach ($floorData as $floor) {
        for ($i = 0; $i < count($name1); $i++) {
            $data1 = Floor::find($id);
            $data1->propertytype_id = $request->propertytype_id[$i];
            $data1->project_id = $project_id;
            $data1->from_price = $request->from_price[$i];
            $data1->to_price = $request->to_price[$i];
            $data1->from_sqft = $request->from_sqft[$i];
            $data1->to_sqft = $request->to_sqft[$i];
            $data1->save();
            $floor_id = $data1->id; // Get the newly inserted floor ID
        }

        // $subfloor = $subfloor ?? [];
        $name2 = $request->subpropertytype_id;
        // foreach ($subfloor as $subfloors)  
        for ($j = 0; $j < count($name2); $j++) {
            $data2 = Subfloor::find($id);
            $data2->project_id = $project_id;
            $data2->floor_id = $floor_id;
            $data2->propertytype_id = $request->subpropertytype_id[$j];
            $data2->builtup_area = $request->builtup_area[$j];
            $data2->price = $request->base_price[$j];
            $data2->save();
        }

        $data3 = Projectamenities::find($id);
        $data3->amenities_id = $request->amenities_id;
        $data3->project_id = $project_id;
        $data3->save();

        $data4 = Projectbuilder::find($id);
        $data4->builder_id = $request->builder_id;
        $data4->project_id = $project_id;
        $data4->save();

        $data->created_by = @Auth::user()->id;

        return response()->json([
            'message' => 'Item Created successfully.',
            'data' => $data
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Projects $projects)
    {
        //
    }


    public function getProjectIndexData(Request $request)
    {
        // dd($request);
        $model = Projectdetails::class;
        $entity = 'project';
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length");
        $searchValue = $request->get('search')['value'];

        // Total records without filters
        $totalRecords = $model::count();

        // Query for filtered records
        $query = $model::query();

        if (!empty($searchValue)) {
            $query->where('name', 'LIKE', '%' . $searchValue . '%');
        }

        $totalRecordswithFilter = $query->count();

        // Sorting and pagination
        $query->orderBy('id', 'asc')->skip($start)->take($rowperpage);
        // $records = $query->get();
        $records = $query->with('floor')->get();
        // dd($records);

        $data_arr = [];
        // $sno = 0;
        foreach ($records as $record) {
            // dd($record->projectbuilder);
            $editButton = '<a href="' . url('projects/' . $record->id . '/edit') . '" class="btn btn-primary waves-effect waves-light">
            <i class="ri-pencil-fill"></i>
        </a>';
            $viewButton = '<button class="btn btn-success waves-effect waves-light" href="#" onclick="viewEntity(\'' . $record->id . '\', \'' . $entity . '\')"><i class="ri-eye-fill"></i></button>';
            $deleteButton = '<button class="btn btn-danger waves-effect waves-light" href="#" onclick="deleteEntity(\'' . $record->id . '\', \'' . $entity . '\')"><i class="ri-delete-bin-fill"></i></button>';
            $statusBadge = $record->status == 1 ? '<span class="badge bg-success-subtle text-success">Active</span>' : '<span class="badge bg-warning-subtle text-warning">Inactive</span>';
            $buildingStatusBadge = $record->building_status == 1 ? '<span class="badge bg-success-subtle text-success">Ready to move</span>' : '<span class="badge bg-warning-subtle text-warning">Under Construction</span>';
            // dd($record->floor->min());
            $data_arr[] = [
                "id" => ++$start,
                "name" => $record->name,
                "address" => $record->state->name . ', ' . $record->city->name . ', ' . $record->area->name,
                "base_price" => $record->floor->min('from_price') . '-' . $record->floor->max('to_price'),
                "plot_area" => $record->floor->min('from_sqft') .  ' ' . 'sq.ft' . ' ' . '-' . ' ' . $record->floor->max('to_sqft') . ' ' . 'sq.ft',
                "building_status" => $buildingStatusBadge,
                "Completion_date" => $record->completion_date,
                "status" => $statusBadge,
                "action" => $editButton . ' ' . $deleteButton . ' ' . $viewButton,
            ];
        }


        $response = [
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        ];

        return response()->json($response);
        // return $this->getTableData(City::class, $request, 'city');
    }

    // public function addProject(){
    //     $page_title = "Add Project";
    //     $module_name = "Add";

    //     return view('projects.add', compact('page_title', 'module_name'));
    // }
}
