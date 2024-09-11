<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\State;
use App\Models\City;
use App\Models\Area;

use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use App\Traits\AjaxTableDataTrait;

class StateController extends Controller
{
    use AjaxTableDataTrait;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = State::where('status', 1)->get();
        return response()->json([
            'data' => $data,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page_title = "State";
        $module_name = "Add";
        $data = new State;
        $route = 'state.store';
        $method = 'POST';
        return response()->json([
            'data' => $data,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
        $rules = [
            'name' => 'required|regex:/^[a-zA-Z0-9][a-zA-Z0-9\s]*$/|unique:state,name',
            'status' => 'required|in:1,2',
        ];

        $messages = [
            'name.required' => 'The state name is required.',
            'name.unique' => 'The state name must be unique among active states.',
            'status.required' => 'Please select status',
        ];

        $validator = Validator::make($request->only('name', 'status'), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = new State;
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
        $page_title = "State";
        $module_name = "Edit";

        //$route = 'state.update';
        $method = 'PUT';
        $data = State::find($id);
        $route = ['state.update', $id];
        // dd($data);
        return response()->json([
            'data' => $data,
        ], 200);
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
                Rule::unique('state')->ignore($id),
            ],
            'status' => 'required|in:1,2',
        ];

        $messages = [
            'name.required' => 'The state name is required.',
            'name.unique' => 'The state name must be unique among active states.',
            'status.required' => 'Please select status',
        ];

        $validator = Validator::make($request->only('name', 'status'), $rules, $messages);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $data = State::find($id);
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
        $data = State::find($id);

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


    public function getStateIndexData(Request $request)
    {
        // return $this->getTableData(State::class, $request, 'state');

        $model = State::class;
        $entity = 'state';
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
        $sno = 0;
        foreach ($records as $record) {
            $editButton = '<button class="btn btn-primary waves-effect waves-light" onclick="addEditModal(\'' . $record->id . '\', \'' . $entity . '\', \'edit\', \'GET\')" data-bs-toggle="modal" data-bs-target="#' . $entity . '-add-edit" href="#"><i class="ri-pencil-fill"></i></button>';
            $deleteButton = '<button class="btn btn-danger waves-effect waves-light" href="#" onclick="deleteEntity(\'' . $record->id . '\', \'' . $entity . '\')"><i class="ri-delete-bin-fill"></i></button>';
            $statusBadge = $record->status == 1 ? '<span class="badge bg-success-subtle text-success">Active</span>' : '<span class="badge bg-warning-subtle text-warning">Inactive</span>';

            $data_arr[] = [
                "id" => ++$sno,
                "name" => $record->name,
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

    public function getStateCityData(Request $request)
    {
        // dd($request->state_id);
        $data = City::where('state_id', $request->state_id)->where('status', 1)->with('state')->get();

        if (!$data) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data found',
            'data' => $data
        ], 200);
    }
    public function getCityAreaData(Request $request)
    {
        // dd($request->state_id);
        $data = Area::where('city_id', $request->city_id)->where('status', 1)->pluck('name', 'id');

        if (!$data) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data found',
            'data' => $data
        ], 200);
    }
    public function getStateCityAreaData(Request $request)
    {
        // dd($request->state_id);
        $data['states'] = State::where('status', 1)->pluck('name', 'id');

        foreach ($data['states'] as &$state) {
            $state['cities'] = City::where('state_id', $state['id'])->where('status', 1)->pluck('name', 'id');
            foreach ($data['cities'] as &$city) {
                $city['areas'] = Area::where('city_id', $city['id'])->where('status', 1)->pluck('name', 'id');
            }
        }

        if (!$data) {
            return response()->json([
                'status' => 'error',
                'message' => 'Data not found',
            ], 404);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data found',
            'data' => $data
        ], 200);
    }
}
