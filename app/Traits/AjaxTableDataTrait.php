<?php

namespace App\Traits;
use Illuminate\Http\Request;

trait AjaxTableDataTrait
{
    public function getTableData($model,$entity, Request $request, $callback)
    {
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page
        $searchValue = $request->get('search')['value'];

        // Total records
        $totalRecords = $model::count();

        // Query for filtered records
        $query = $model::query();
        if (!empty($searchValue)) {
            $query->where('name', 'LIKE', '%' . $searchValue . '%');
        }

        // Count of records after filter
        $totalRecordswithFilter = $query->count();

        // Sorting and pagination
        $query->orderBy('id', 'asc')->skip($start)->take($rowperpage);

        // Retrieve records
        $records = $query->get();

        // Use the callback to transform each record into the required format
        $data_arr = [];
        $sno = $start;

        foreach ($records as $record) {
            $record_data = $callback($record, ++$sno);         
            $data_arr[] = $record_data; 
        }

        return [
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr,
        ];
    }

    /**
     * Generate Edit Button
     *
     * @param int $id
     * @param string $entity
     * @return string
     */
    public function getEditButton($id, $entity)
    {
        return '<a class="link-success fs-15 me-2" onclick="addEditModal(\'' . $id . '\', \'' . $entity . '\', \'edit\', \'GET\')" data-bs-toggle="modal" data-bs-target="#' . $entity . '-add-edit" href="#"><i class="ri-edit-2-line"></i></a>';
    }

    /**
     * Generate Delete Button
     *
     * @param int $id
     * @param string $entity
     * @return string
     */
    public function getDeleteButton($id, $entity)
    {
        return '<a class="link-danger fs-15 me-2" href="#" onclick="deleteEntity(\'' . $id . '\', \'' . $entity . '\')"><i class="ri-delete-bin-line"></i></a>';
    }

    /**
     * Generate Status Badge
     *
     * @param int $status
     * @return string
     */
    public function getStatusBadge($status)
    {
        return $status == 1
            ? '<span class="badge bg-success-subtle text-success">Active</span>'
            : '<span class="badge bg-warning-subtle text-warning">Inactive</span>';
    }
}
