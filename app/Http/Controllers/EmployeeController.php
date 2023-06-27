<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Employee;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::OrderBy('id', 'desc')->paginate(5);
        return view('employee.index', compact('employees'));
    }
    
    public function indexadmin()
    {
        $employees = Employee::OrderBy('id', 'desc')->paginate(5);
        return view('employee.admin.dashboard', compact('employees'));
    }

    public function indexmanager()
    {
        $employees = Employee::OrderBy('id', 'desc')->paginate(5);
        return view('employee.manager.dashboard', compact('employees'));
    }

    public function indexcashier()
    {
        $employees = Employee::OrderBy('id', 'desc')->paginate(5);
        return view('employee.cashier.dashboard', compact('employees'));
    }

    
    public function search(Request $request)
    {
        $search = $request->get('search');
        $employees = DB::table('employees')->where('employee_name', 'like', '%' . $search . '%')->paginate(5);
        return view('employee.index', ['employees' => $employees]);
    }



}
