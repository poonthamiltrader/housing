<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use App\Models\City;
use App\Models\State;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Traits\AjaxTableDataTrait;

class CityController extends Controller
{
    use AjaxTableDataTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page_title = "City";
        $module_name = "List";

        // dd($cities);
        return view('city.index', compact('page_title', 'module_name'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page_title = "City";
        $module_name = "Add";
        $data = new City;
        $route = 'city.store';
        $method = 'POST';

        $states = State::where('status', 1)->pluck('name', 'id');
        // dd($states);
        return view('city.add_edit', compact('data', 'method', 'states', 'route', 'page_title', 'module_name'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd('hii');
        $rules = [
            'name' => 'required|regex:/^[a-zA-Z0-9][a-zA-Z0-9\s&\/\-_]*$/|unique:city,name',
            'state_id' => 'required',
            'status' => 'required|in:1,2',
        ];

        $messages = [
            'name.required' => 'The state name is required.',
            'name.unique' => 'The state name must be unique among active states.',
            'status.required' => 'Please select status',
            'state_id.required' => 'Please select state',
        ];

        $validator = Validator::make($request->only('name', 'state_id', 'status'), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = new City;
        $data->name = $request->name;
        $data->state_id = $request->state_id;
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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $page_title = "City";
        $module_name = "Edit";
        $method = 'PUT';
        $data = City::find($id);
        $route = ['city.update', $id];
        $states = State::where('status', 1)->pluck('name', 'id');

        return view('city.add_edit', compact('data', 'method', 'states', 'route', 'page_title', 'module_name'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => [
                'required',
                'regex:/^[a-zA-Z0-9][a-zA-Z0-9\s&\/\-_]*$/',
                Rule::unique('city')->ignore($id),
            ],
            'state_id' => 'required',
            'status' => 'required|in:1,2',
        ];

        $messages = [
            'name.required' => 'The state name is required.',
            'name.unique' => 'The state name must be unique among active states.',
            'status.required' => 'Please select status',
            'state_id.required' => 'Please select state',
        ];

        $validator = Validator::make($request->only('name', 'state_id', 'status'), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = City::find($id);
        $data->name = $request->name;
        $data->state_id = $request->state_id;
        $data->status = $request->status;
        $data->updated_by = @Auth::user()->id;
        $data->save();

        return response()->json([
            'message' => 'Item Created successfully.',
            'data' => $data
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = City::find($id);

        if (!$data) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found',
            ], 404);
        }

        $data->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Data deleted successfully',
        ], 200);
    }

    public function getCityIndexData(Request $request)
    {
        // dd($request);
        $model = City::class;
        $entity = 'city';
        
        $response = $this->getTableData($model, $entity, $request, function ($record, $sno) use ($entity) {
            $editButton = $this->getEditButton($record->id, $entity);
            $deleteButton = $this->getDeleteButton($record->id, $entity);
            $statusBadge = $this->getStatusBadge($record->status);

            return [
                "id" => $sno,
                "name" => $record->name,
                "state_name" => $record->state->name,
                "status" => $statusBadge,
                "action" => $editButton . ' ' . $deleteButton,
            ];
        });
        
        return response()->json($response);
    }
}
