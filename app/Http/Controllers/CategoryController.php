<?php

namespace App\Http\Controllers;

use App\Models\Category;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Traits\AjaxTableDataTrait;

class CategoryController extends Controller
{
    use AjaxTableDataTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // dd('hii');
        $page_title = "Category";
        $module_name = "List";

        return view('category.index', compact('page_title', 'module_name'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page_title = "Category";
        $module_name = "Add";
        $data = new Category;
        $route = 'category.store';
        $method = 'POST';
        return view('category.add_edit', compact('data', 'method', 'route', 'page_title', 'module_name'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required|regex:/^[a-zA-Z0-9][a-zA-Z0-9\s&\/\-_]*$/|unique:category,name',
            'status' => 'required|in:1,2',
        ];

        $messages = [
            'name.required' => 'The category name is required.',
            'name.unique' => 'The category name must be unique among active categories.',
            'status.required' => 'Please select status',
        ];

        $validator = Validator::make($request->only('name', 'status'), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = new Category;
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
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $page_title = "Category";
        $module_name = "Edit";

        //$route = 'category.update';
        $method = 'PUT';
        $data = Category::find($id);
        $route = ['category.update', $id];
        // dd($data);
        return view('category.add_edit', compact('data', 'method', 'route', 'page_title', 'module_name'));
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
                Rule::unique('category')->ignore($id),
            ],
            'status' => 'required|in:1,2',
        ];

        $messages = [
            'name.required' => 'The category name is required.',
            'name.unique' => 'The category name must be unique among active categories.',
            'status.required' => 'Please select status',
        ];

        $validator = Validator::make($request->only('name', 'status'), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = Category::find($id);
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
        $data = Category::find($id);

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

    public function getCategoryIndexData(Request $request)
    {
        // return $this->getTableData(State::class, $request, 'state');

        $model = Category::class;
        $entity = 'category';
       
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
