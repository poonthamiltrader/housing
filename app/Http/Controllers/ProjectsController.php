<?php

namespace App\Http\Controllers;

use App\Models\Amenities;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
// use App\Models\Area;
use App\Models\Builder;
// use App\Models\City;
use App\Models\Projectdetails;
use App\Models\Projects;
use App\Models\State;
use Illuminate\Http\Request;

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
        $amenities = Amenities::where('status', 1)->pluck('name', 'id');
        // dd($builders);

        return view('projects.add', compact('data', 'method', 'states', 'route', 'page_title', 'module_name', 'builders'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->status);
        $rules = [
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'state_id' => 'required|exists:state,id',
            'city_id' => 'required|exists:city,id',
            'area_id' => 'required|exists:area,id',
            'from_price' => 'required|numeric|min:0',
            'to_price' => 'required|numeric|min:0',
            'from_sqft' => 'required|numeric|min:0',
            'to_sqft' => 'required|numeric|min:0',
            'building_status' => 'required|integer|in:0,1,2,3', // Adjust according to actual status values
            'completion_date' => 'required|date',
            'floor_plan' => 'required|string|max:255',
            'area_details' => 'required|numeric|min:0',
            'price_details' => 'required|numeric|min:0',
            'project_description' => 'nullable|string',
            'ratings' => 'nullable|integer|between:1,5', // Assuming ratings are between 1 and 5
            'reviews' => 'nullable|string',
            'builder_id' => 'required|exists:builder,id',
            'status' => 'nullable|integer' // Assuming status is either 0 or 1
        ];

        $messages = [
            'name.required' => 'The name field is required.',
            'state_id.exists' => 'The selected state is invalid.',
            'city_id.exists' => 'The selected city is invalid.',
            'area_id.exists' => 'The selected area is invalid.',
            'building_status.in' => 'The building status value is invalid.',
            'completion_date.date' => 'The completion date is not a valid date.',
            'ratings.between' => 'The rating must be between 1 and 5.',
            'status.in' => 'The status value is invalid.',
            // Add more custom messages as needed
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $data = new Projectdetails;
        $data->name = $request->name;
        $data->address = $request->address;
        $data->state_id = $request->state_id;
        $data->city_id = $request->city_id;
        $data->area_id = $request->area_id;
        $data->builder_id = $request->builder_id;
        $data->from_price = $request->from_price;
        $data->to_price = $request->to_price;
        $data->from_sqft = $request->from_sqft;
        $data->to_sqft = $request->to_sqft;
        $data->building_status = $request->building_status;
        $data->completion_date = $request->completion_date;
        $data->floor_plan = $request->floor_plan;
        $data->area_details = $request->area_details;
        $data->price_details = $request->price_details;
        $data->project_description = $request->project_description;
        $data->ratings = $request->ratings;
        $data->reviews = $request->reviews;

        $data->status = $request->status;
        $data->created_by = @Auth::user()->id;



        $data->save();

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
        // dd("hai");
        $page_title = "Project Management";
        $module_name = "Edit";
        $data = Projectdetails::find($id);
        $route = ['projects.update', $id];
        $method = 'PUT';
        // dd($data);
        $states = State::where('status', 1)->pluck('name', 'id');

        $builders = Builder::where('status', 1)->pluck('name', 'id');
        // dd($builders);

        return view('projects.add', compact('data', 'method', 'states', 'route', 'page_title', 'module_name', 'builders'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd($request->status);
        $rules = [
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'state_id' => 'required|exists:state,id',
            'city_id' => 'required|exists:city,id',
            'area_id' => 'required|exists:area,id',
            'from_price' => 'required|numeric|min:0',
            'to_price' => 'required|numeric|min:0',
            'from_sqft' => 'required|numeric|min:0',
            'to_sqft' => 'required|numeric|min:0',
            'building_status' => 'required|integer|in:0,1,2,3', // Adjust according to actual status values
            'completion_date' => 'required|date',
            'floor_plan' => 'required|string|max:255',
            'area_details' => 'required|numeric|min:0',
            'price_details' => 'required|numeric|min:0',
            'project_description' => 'nullable|string',
            'ratings' => 'nullable|integer|between:1,5', // Assuming ratings are between 1 and 5
            'reviews' => 'nullable|string',
            'builder_id' => 'required|exists:builder,id',
            'status' => 'nullable|integer' // Assuming status is either 0 or 1
        ];

        $messages = [
            'name.required' => 'The name field is required.',
            'state_id.exists' => 'The selected state is invalid.',
            'city_id.exists' => 'The selected city is invalid.',
            'area_id.exists' => 'The selected area is invalid.',
            'building_status.in' => 'The building status value is invalid.',
            'completion_date.date' => 'The completion date is not a valid date.',
            'ratings.between' => 'The rating must be between 1 and 5.',
            'status.in' => 'The status value is invalid.',
            // Add more custom messages as needed
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $data = Projectdetails::find($id);
        $data->name = $request->name;
        $data->address = $request->address;
        $data->state_id = $request->state_id;
        $data->city_id = $request->city_id;
        $data->area_id = $request->area_id;
        $data->builder_id = $request->builder_id;
        $data->from_price = $request->from_price;
        $data->to_price = $request->to_price;
        $data->from_sqft = $request->from_sqft;
        $data->to_sqft = $request->to_sqft;
        $data->building_status = $request->building_status;
        $data->completion_date = $request->completion_date;
        $data->floor_plan = $request->floor_plan;
        $data->area_details = $request->area_details;
        $data->price_details = $request->price_details;
        $data->project_description = $request->project_description;
        $data->ratings = $request->ratings;
        $data->reviews = $request->reviews;

        $data->status = $request->status;
        $data->created_by = @Auth::user()->id;



        $data->save();

        return response()->json([
            'message' => 'Item Updated successfully.',
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
        $records = $query->get();

        $data_arr = [];
        // $sno = 0;
        foreach ($records as $record) {
            $editButton = '<a href="' . url('projects/' . $record->id . '/edit') . '" class="btn btn-primary waves-effect waves-light">
            <i class="ri-pencil-fill"></i>
        </a>';
            $viewButton = '<button class="btn btn-success waves-effect waves-light" href="#" onclick="viewEntity(\'' . $record->id . '\', \'' . $entity . '\')"><i class="ri-eye-fill"></i></button>';
            $deleteButton = '<button class="btn btn-danger waves-effect waves-light" href="#" onclick="deleteEntity(\'' . $record->id . '\', \'' . $entity . '\')"><i class="ri-delete-bin-fill"></i></button>';
            $statusBadge = $record->status == 1 ? '<span class="badge bg-success-subtle text-success">Active</span>' : '<span class="badge bg-warning-subtle text-warning">Inactive</span>';
            $buildingStatusBadge = $record->building_status == 1 ? '<span class="badge bg-success-subtle text-success">Ready to move</span>' : '<span class="badge bg-warning-subtle text-warning">Under Construction</span>';

            $data_arr[] = [
                "id" => ++$start,
                "name" => $record->name,
                "address" => $record->state->name . ', ' . $record->city->name . ', ' . $record->area->name,
                "base_price" => $record->from_price . '-' . $record->to_price,
                "plot_area" => $record->from_sqft . 'sq.ft' . '-' . $record->to_sqft . 'sq.ft',
                "building_status" => $buildingStatusBadge,
                "Completion_date" => $record->completion_date,
                "floor_plan" => $record->floor_plan,
                "area_details" => $record->area_details,
                "price_details" => $record->price_details,
                "project_description" => $record->project_description,
                "builder_details" => $record->builder->name,
                // "ratings" => $record->ratings,
                "status" => $statusBadge,
                "action" => $editButton . ' ' . $deleteButton.''.$viewButton,
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
