<?php

namespace App\Http\Controllers;

use App\Models\Package;

use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Traits\AjaxTableDataTrait;

class PackageController extends Controller
{
    use AjaxTableDataTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page_title = "State";
        $module_name = "List";

        // dd($page_title);
        return view('package.index', compact('page_title', 'module_name'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // dd('hii');
        $page_title = "Package";
        $module_name = "Add";
        $data = new Package;
        $route = 'package.store';
        $method = 'POST';
        return view('package.add_edit', compact('data', 'method', 'route', 'page_title', 'module_name'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $rules = [
            'name' => 'required|regex:/^[a-zA-Z0-9][a-zA-Z0-9\s]*$/|unique:packages,name',
            'price' => 'required|numeric|min:0',
            'period' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0',
            'no_of_listing' => 'required|numeric|min:0',
            'user_type' => 'required|numeric|min:0',
            'status' => 'required|in:1,2',
        ];

        $messages = [
            'name.required' => 'The package name is required.',
            'name.unique' => 'The package name must be unique among active packages.',
            'price.required' => 'The price is required.',
            'period.required' => 'The period is required.',
            'discount.required' => 'The discount is required.',
            'user_type.required' => 'The discount is required.',
            'no_of_listing.required' => 'The no of listing is required.',
            'status.required' => 'Please select status',
            'state_id.required' => 'Please select state',
        ];

        $validator = Validator::make($request->only('name', 'price', 'period', 'discount', 'user_type', 'no_of_listing', 'status'), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = new Package;
        $data->name = $request->name;
        $data->price = $request->price;
        $data->period = $request->period;
        $data->no_of_listing = $request->no_of_listing;
        $data->discount = $request->discount;
        $data->user_type = $request->user_type;
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
    public function show(Package $package)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $page_title = "Package";
        $module_name = "Edit";
        $method = 'PUT';
        $data = Package::find($id);
        $route = ['package.update', $id];

        return view('package.add_edit', compact('data', 'method', 'route', 'page_title', 'module_name'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // dd('hii');
        $rules = [
            'name' => [
                'required',
                'regex:/^[a-zA-Z0-9][a-zA-Z0-9\s]*$/',
                Rule::unique('packages')->ignore($id),
            ],
            'price' => 'required|numeric|min:0',
            'period' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0',
            'no_of_listing' => 'required|numeric|min:0',
            'user_type' => 'required|numeric|min:0',
            'status' => 'required|in:1,2',
        ];

        $messages = [
            'name.required' => 'The package name is required.',
            'name.unique' => 'The package name must be unique among active packages.',
            'price.required' => 'The price is required.',
            'period.required' => 'The period is required.',
            'discount.required' => 'The discount is required.',
            'user_type.required' => 'The discount is required.',
            'no_of_listing.required' => 'The no of listing is required.',
            'status.required' => 'Please select status',
            'state_id.required' => 'Please select state',
        ];

        $validator = Validator::make($request->only('name', 'price', 'period', 'discount', 'user_type', 'no_of_listing', 'status'), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = Package::find($id);
        $data->name = $request->name;
        $data->price = $request->price;
        $data->period = $request->period;
        $data->no_of_listing = $request->no_of_listing;
        $data->discount = $request->discount;
        $data->user_type = $request->user_type;
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
    public function destroy($id)
    {
        $data = Package::find($id);

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

    public function getPackageIndexData(Request $request)
    {
        // return $this->getTableData(State::class, $request, 'state');

        $model = Package::class;
        $entity = 'package';
       
        $response = $this->getTableData($model, $entity, $request, function ($record, $sno) use ($entity) {
            $editButton = $this->getEditButton($record->id, $entity);
            $deleteButton = $this->getDeleteButton($record->id, $entity);
            $statusBadge = $this->getStatusBadge($record->status);

            return [
                "id" => $sno,
                "name" => $record->name,
                "price" => $record->price,
                "period" => $record->period,
                "no_of_listing" => $record->no_of_listing,
                "discount" => $record->discount,
                "status" => $statusBadge,
                "action" => $editButton . ' ' . $deleteButton,
            ];
        });

        return response()->json($response);
    }
}
