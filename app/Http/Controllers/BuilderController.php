<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Builder;
use Illuminate\Http\Request;
use App\Traits\AjaxTableDataTrait;

class BuilderController extends Controller
{
    use AjaxTableDataTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $page_title = "Builder Details";
        $module_name = "List";

        return view('builder.index', compact('page_title', 'module_name'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $page_title = "Builder Details";
        $module_name = "Add";
        $data = new Builder;
        $route = 'builder.store';
        $method = 'POST';
        return view('builder.add_edit', compact('data', 'method', 'route', 'page_title', 'module_name'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
            $rules = [
                'name' => 'required|string|max:255',
    
    
                'Mobile' => 'required|numeric|unique:users,Mobile',
    
            ];
    
            $messages = [
                'name.required' => 'The name field is required.',
    
                'Mobile.required' => 'The mobile field is required.',
                'Mobile.numeric' => 'The mobile field must be a number.',
                'Mobile.unique' => 'The mobile number has already been taken.',
    
            ];
            $validator = Validator::make($request->only(
                'name',
    
                'Mobile'
            ), $rules, $messages);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
            $data = new Builder;
            $data->name = $request->name;
            $data->status = $request->status;
            $data->description = $request->description;
            $data->Mobile = $request->Mobile;
            $data->address_1 = $request->address_1;
            $data->address_2 = $request->address_2;
            $data->properties_list = $request->properties_list;
            $data->created_by = @Auth::user()->id;
            $data->save();
            return response()->json([
                'message' => 'Builder-list Created successfully.',
                'data' => $data
            ], 200);
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $page_title = "Builder Details";
        $module_name = "Edit";
        $data = Builder::find($id);
        $route = ['builder.update', $id];
        $method = 'PUT';
        return view('builder.add_edit', compact('data', 'method', 'route', 'page_title', 'module_name'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        
        $rules = [
            'name' => 'required|string|max:255',


            'Mobile' => 'required|numeric|unique:users,Mobile',

        ];

        $messages = [
            'name.required' => 'The name field is required.',

            'Mobile.required' => 'The mobile field is required.',
            'Mobile.numeric' => 'The mobile field must be a number.',
            'Mobile.unique' => 'The mobile number has already been taken.',

        ];
        $validator = Validator::make($request->only(
            'name',

            'Mobile'
        ), $rules, $messages);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
        $data = Builder::find($id);
        $data->name = $request->name;
        $data->status = $request->status;
        $data->description = $request->description;
        $data->Mobile = $request->Mobile;
        $data->address_1 = $request->address_1;
        $data->address_2 = $request->address_2;
        $data->properties_list = $request->properties_list;
        $data->created_by = @Auth::user()->id;
        $data->save();
        return response()->json([
            'message' => 'Builder-list Created successfully.',
            'data' => $data
        ], 200);
    
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function getBuilderIndexData(Request $request)
    {
        $model = Builder::class;
        $entity = 'builder';
        $response = $this->getTableData($model, $entity, $request, function ($record, $sno) use ($entity) {
            $editButton = $this->getEditButton($record->id, $entity);
            $deleteButton = $this->getDeleteButton($record->id, $entity);
            $statusBadge = $this->getStatusBadge($record->status);

            return [
                "id" => $sno,
                "name" => $record->name,
                "address1"=>$record->address_1,
                "address2"=>$record->address_2,
                "description"=>$record->description,
                "mobile"=>$record->Mobile,
                "status" => $statusBadge,
                "action" => $editButton . ' ' . $deleteButton,
            ];
        });
       
        return response()->json($response);
    }
}
