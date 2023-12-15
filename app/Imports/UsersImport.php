<?php

namespace App\Imports;
use App\Models\ModuleMasterNew;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class UsersImport implements ToModel, WithHeadingRow
{

   
      /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        //  dd($row);
        return new ModuleMasterNew([
        'module_name' => $row['module_name'],
        'EmployeeID' => $row['employeeid'],
        'level' => $row['level'],
        'l1empid' => $row['l1empid'],
        'l1empid' => $row['l1name'],
        'l2empid' => $row['l2empid'],
        'l2name' => $row['l2name'],
          $createBy = Session::get('EmployeeID'),
        ]);
    }
}
