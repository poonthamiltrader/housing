<?php

namespace App\Http\Controllers;

use App\Models\Amenities;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Traits\AjaxTableDataTrait;

class AmenitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    use AjaxTableDataTrait;
    public function index()
    {
        // dd('hii');
        $page_title = "Amenities";
        $module_name = "List";

        return view('amenities.index', compact('page_title', 'module_name'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page_title = "Amenities";
        $module_name = "Add";
        $data = new Amenities;
        $route = 'amenities.store';
        $method = 'POST';
        return view('amenities.add_edit', compact('data', 'method', 'route', 'page_title', 'module_name'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|regex:/^[a-zA-Z0-9][a-zA-Z0-9\s]*$/|unique:amenities,name',
            'status' => 'required|in:1,2',
        ];

        $messages = [
            'name.required' => 'The amenities name is required.',
            'name.unique' => 'The amenities name must be unique among active amenities.',
            'status.required' => 'Please select status',
        ];

        $validator = Validator::make($request->only('name', 'status'), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = new Amenities;
        $data->name = $request->name;
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
        $page_title = "Amenities";
        $module_name = "Edit";

        //$route = 'category.update';
        $method = 'PUT';
        $data = Amenities::find($id);
        $route = ['amenities.update', $id];
        // dd($data);
        return view('amenities.add_edit', compact('data', 'method', 'route', 'page_title', 'module_name'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules = [
            'name' => [
                'required',
                'regex:/^[a-zA-Z0-9][a-zA-Z0-9\s]*$/',
                Rule::unique('amenities')->ignore($id),
            ],
            'status' => 'required|in:1,2',
        ];

        $messages = [
            'name.required' => 'The amenities name is required.',
            'name.unique' => 'The amenities name must be unique among active amenities.',
            'status.required' => 'Please select status',
        ];

        $validator = Validator::make($request->only('name', 'status'), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = Amenities::find($id);
        $data->name = $request->name;
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
        $data = Amenities::find($id);

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
    public function getAmenitiesIndexData(Request $request)
    {
        $model = Amenities::class;
        $entity = 'amenities';

        $response = $this->getTableData($model, $entity, $request, function ($record, $sno) use ($entity) {
            $editButton = $this->getEditButton($record->id, $entity);
            $deleteButton = $this->getDeleteButton($record->id, $entity);
            $statusBadge = $this->getStatusBadge($record->status);

            return [
                "id" => $sno,
                "name" => $record->name,
                "status" => $statusBadge,
                "action" => $editButton . ' ' . $deleteButton,
            ];
        });

        return response()->json($response);
    }
}
