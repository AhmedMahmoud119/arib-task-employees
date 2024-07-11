@extends('layouts.admin')
@section('content')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('users.create') }}">
            Add Employee
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        List Employees
    </div>

    <div class="card-body">
        <div style="margin-bottom: 10px" class="">
            <form action="{{ route('users.index') }}">
                @csrf

                <div class="row">

                    <div class="form-group col-lg-3">
                        <label class="" for="name">name</label>
                        <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                            type="text" name="name" id="name" value="{{ request()->name }}">
                    </div>
                    <div class="form-group col-lg-3">
                        <label class="" for="email">email</label>
                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                            type="text" name="email" id="email" value="{{ request()->email }}">
                    </div>
                    <div class="form-group col-lg-3">
                        <label class="" for="date">Department</label>
                        <select class="form-control select2" name="department_id">
                            <option value="">Select</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->id }}" {{ request('department_id') == $department->id? 'selected' : '' }}>
                                    {{ $department->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                </div>

                <button name="search"
                    class="btn btn-primary" type="submit">
                    Search
                </button>

            </form>
        </div>

        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>
                        Id
                    </th>
                    <th>
                        Full Name
                    </th>
                    <th>
                        Email
                    </th>
                    <th>
                        Salary
                    </th>
                    <th>
                        Image
                    </th>
                    <th>
                        Manager
                    </th>
                    <th>
                        Department
                    </th>

                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>

            <thead>
                @foreach ($users as $user)
                    <tr>
                        <td>
                            {{ $user->id }}
                        </td>
                        <td>
                            {{ $user->full_name }}
                        </td>
                        <td>
                            {{ $user->email }}
                        </td>
                        <td>
                            {{ $user->salary }}
                        </td>
                        <td>
                            @if($user->image)
                                <img width="100px" height="100px" src="{{ asset('storage/images/'.$user->image) }}">
                            @endif
                        </td>
                        <td>
                            {{ $user->manager->full_name ?? '' }}
                        </td>
                        <td>
                            {{ $user->department->name ?? '' }}
                        </td>
                        <td>
                            <a class="btn btn-xs btn-primary" href="{{ route('users.edit', $user->id) }}">
                                edit
                            </a>

                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are u sure?');" style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-xs btn-danger" value="delete">
                            </form>

                        </td>
                    </tr>
                @endforeach

            </thead>

        </table>

        {{ $users->links('pagination::bootstrap-4') }}

    </div>
</div>



@endsection

@section('scripts')
@parent

@endsection
