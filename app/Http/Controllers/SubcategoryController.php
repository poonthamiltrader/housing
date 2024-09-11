<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Traits\AjaxTableDataTrait;

class SubcategoryController extends Controller
{
    use AjaxTableDataTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page_title = "Subcategory";
        $module_name = "List";

        return view('subcategory.index', compact('page_title', 'module_name'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page_title = "Subcategory";
        $module_name = "Add";
        $data = new Subcategory;
        $route = 'subcategory.store';
        $categories = Category::where('status', 1)->pluck('name', 'id');

        $method = 'POST';
        return view('subcategory.add_edit', compact('data', 'method', 'categories', 'route', 'page_title', 'module_name'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $rules = [
            'name' => 'required|regex:/^[a-zA-Z0-9][a-zA-Z0-9\s]*$/|unique:subcategory,name',
            'category_id' => 'required',
            'status' => 'required|in:1,2',
        ];

        $messages = [
            'name.required' => 'The subcategory name is required.',
            'name.unique' => 'The subcategory name must be unique among active subcategories.',
            'category_id.required' => 'Please select category',
            'status.required' => 'Please select status',
        ];

        $validator = Validator::make($request->only('name', 'category_id', 'status'), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = new Subcategory;
        $data->name = $request->name;
        $data->category_id = $request->category_id;
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
    public function show(Subcategory $subcategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $page_title = "Subcategory";
        $module_name = "Edit";

        //$route = 'category.update';
        $method = 'PUT';
        $data = Subcategory::find($id);
        $route = ['subcategory.update', $id];
        $categories = Category::where('status', 1)->pluck('name', 'id');
        // dd($data);
        return view('subcategory.add_edit', compact('data', 'categories', 'method', 'route', 'page_title', 'module_name'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => [
                'required',
                'regex:/^[a-zA-Z0-9][a-zA-Z0-9\s]*$/',
                Rule::unique('subcategory')->ignore($id),
            ],
            'category_id' => 'required',
            'status' => 'required|in:1,2',
        ];

        $messages = [
            'name.required' => 'The subcategory name is required.',
            'name.unique' => 'The subcategory name must be unique among active subcategories.',
            'status.required' => 'Please select status',
            'category_id.required' => 'Please select category',
        ];

        $validator = Validator::make($request->only('name', 'category_id', 'status'), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = Subcategory::find($id);
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
    public function destroy($id)
    {
        $data = Subcategory::find($id);

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

    public function getSubCategoryIndexData(Request $request)
    {
        // dd('hii');


        $model = Subcategory::class;
        $entity = 'subcategory';
       
        $response = $this->getTableData($model, $entity, $request, function ($record, $sno) use ($entity) {
            $editButton = $this->getEditButton($record->id, $entity);
            $deleteButton = $this->getDeleteButton($record->id, $entity);
            $statusBadge = $this->getStatusBadge($record->status);

            return [
                "id" => $sno,
                "name" => $record->name,
                "category_name" => $record->category->name,
                "status" => $statusBadge,
                "action" => $editButton . ' ' . $deleteButton,
            ];
        });

        return response()->json($response);
    }
}
