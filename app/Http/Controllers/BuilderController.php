<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Builder;
use Illuminate\Http\Request;

class BuilderController extends Controller
{
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
        // return $this->getTableData(State::class, $request, 'state');
        // dd($request);
        $model = Builder::class;
        $entity = 'builder';
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
            $editButton = '<button class="btn btn-primary waves-effect waves-light" onclick="addEditModal(\'' . $record->id . '\', \'' . $entity . '\', \'edit\', \'GET\')" data-bs-toggle="modal" data-bs-target="#' . $entity . '-add-edit" href="#"><i class="ri-pencil-fill"></i></button>';
            $deleteButton = '<button class="btn btn-danger waves-effect waves-light" href="#" onclick="deleteEntity(\'' . $record->id . '\', \'' . $entity . '\')"><i class="ri-delete-bin-fill"></i></button>';
            $statusBadge = $record->status == 1 ? '<span class="badge bg-success-subtle text-success">Active</span>' : '<span class="badge bg-warning-subtle text-warning">Inactive</span>';

            $data_arr[] = [
                "id" => ++$start,
                "name" => $record->name,
                "address1"=>$record->address_1,
                "address2"=>$record->address_2,
                "description"=>$record->description,
                "mobile"=>$record->Mobile,
                "status" => $statusBadge,
                "action" => $editButton . ' ' . $deleteButton,
            ];
        }

        $response = [
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        ];

        return response()->json($response);
    }
}
