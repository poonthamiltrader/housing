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
use App\Traits\AjaxTableDataTrait;

class ProjectsController extends Controller
{
    use AjaxTableDataTrait;

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

        $response = $this->getTableData($model, $entity, $request, function ($record, $sno) use ($entity) {
            $editButton = $this->getEditButton($record->id, $entity);
            $deleteButton = $this->getDeleteButton($record->id, $entity);
            $viewButton = $this->getViewButton($record->id, $entity);
            $statusBadge = $this->getStatusBadge($record->status);
            $buildingStatusBadge = $this->getBuildingStatusBadge($record->building_status);

            return [
                "id" => $sno,
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
                "action" => $editButton . ' ' . $deleteButton . '' . $viewButton,
            ];
        });

        return response()->json($response);
    }
}
