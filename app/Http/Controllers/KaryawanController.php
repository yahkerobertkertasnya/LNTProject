<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Contracts\Service\Attribute\Required;

class KaryawanController extends Controller
{
    public function getEmployee(){

        $karyawan = DB::table('karyawans')->paginate(15);

        return view('/homepage', compact('karyawan'));
    }

    public function getFilteredEmployee(Request $request){

        $karyawan = DB::table('karyawans')->where('KaryawanName', 'like', '%' . $request->search . '%')->paginate(50    );

        return view('/homepage', compact('karyawan'));
//        return view('/homepage', compact('karyawan'));
    }

    public function deleteEmployee(Request $request){
        DB::table('karyawans')->where('id', $request->EmployeeId)->delete();

        return redirect('/');
    }

    public function addEmployee(Request $request){

        $validated = $request->validate([
            "EmployeeName" => "required|min:5|max:20",
            "EmployeeAge" => "required|numeric|min:21",
            "EmployeeAddress" => "required|min:10|max:40",
            "EmployeePhoneNumber" => "required|regex:/^08/|min:9|max:12"
        ]);

        DB::table('karyawans')->insert([
            'KaryawanName' => $request->EmployeeName,
            'KaryawanAge' => $request->EmployeeAge,
            'KaryawanAddress' => $request->EmployeeAddress,
            'KaryawanPhoneNo' => $request->EmployeePhoneNumber
        ]);

        return back()->withErrors(["status" => "Created new Employee named " . $request->EmployeeName ]);
    }

    public function updateEmployee(Request $request){

        $validated = $request->validate([
            "EmployeeName" => "required|min:5|max:20",
            "EmployeeAge" => "required|numeric|min:21",
            "EmployeeAddress" => "required|min:10|max:40",
            "EmployeePhoneNumber" => "required|regex:/^08/|min:9|max:12"
        ]);

        DB::table('karyawans')->where('id', '=', $request->EmployeeId)->update([
            'KaryawanName' => $request->EmployeeName,
            'KaryawanAge' => $request->EmployeeAge,
            'KaryawanAddress' => $request->EmployeeAddress,
            'KaryawanPhoneNo' => $request->EmployeePhoneNumber
        ]);

        return back()->withErrors(["status" => "Updated Employee Data!" ]);

    }
}
