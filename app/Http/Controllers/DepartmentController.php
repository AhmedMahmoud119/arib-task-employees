<?php

namespace App\Http\Controllers;

use App\Http\Requests\DepartmentRequest;
use App\Models\Department;
use App\Models\User;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::withCount('employees')
            ->withSum('employees as total_salaries', 'salary')
            ->when(request()->name,function($q,$search){
                $q->where('name',$search);
            })->paginate(10);

        return view('department.index', compact('departments'));
    }

    public function create()
    {
        return view('department.create');
    }

    public function store(DepartmentRequest $request)
    {
        Department::create($request->all());

        return redirect()->route('departments.index');
    }

    public function edit(Department $department)
    {
        return view('department.edit', compact('department'));
    }


    public function update(Department $department, DepartmentRequest $request)
    {
        $department->update($request->all());

        return redirect()->route('departments.index');
    }

    public function destroy(Department $department)
    {
        if ($department->employees->isNotEmpty()) {
            return redirect()->route('departments.index')->with([
                'error' => 'Cant Delet it has many employees'
            ]);
        }
        $department->delete();

        return back();
    }
}
