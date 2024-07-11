@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Create User
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("users.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label class="required" for="fname">First Name</label>
                <input class="form-control {{ $errors->has('fname') ? 'is-invalid' : '' }}"
                 type="text" name="fname" id="fname" value="{{ old('fname', '') }}" required>
            </div>

            <div class="form-group">
                <label class="required" for="lname">Last Name</label>
                <input class="form-control {{ $errors->has('lname') ? 'is-invalid' : '' }}"
                 type="text" name="lname" id="lname" value="{{ old('lname', '') }}" required>
            </div>

            <div class="form-group">
                <label class="required" for="email">Email</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                 type="text" name="email" id="email" value="{{ old('email', '') }}" required>
            </div>

            <div class="form-group">
                <label class="required" for="phone">Phone</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}"
                 type="text" name="phone" id="phone" value="{{ old('phone', '') }}" required>
            </div>

            <div class="row">
                <div class="col-6 form-group">
                    <label class="required" for="password">Password</label>
                    <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                    type="password" name="password" id="password" value="{{ old('password', '') }}" required>
                </div>

                <div class="col-6 form-group">
                    <label class="required" for="password_confirmation">Password Confirmation</label>
                    <input class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                    type="password" name="password_confirmation" id="password_confirmation" value="" required>
                </div>
            </div>

            <div class="row">
                    <div class="col-6 form-group">
                        <label class="required" for="salary">Salary</label>
                        <input class="form-control {{ $errors->has('salary') ? 'is-invalid' : '' }}"
                        type="number" name="salary" id="salary" value="{{ old('salary', '') }}" required>
                    </div>
                    <div class="col-6 form-group">
                        <label class="" for="image">Image</label>
                        <input class="form-control"
                        type="file" name="image" id="image" value="{{ old('image', '') }}">
                    </div>
            </div>

            <div class="row">
                <div class="col-6 form-group">
                    <label class="required" for="manager_id">Manager</label>
                    <select  class="form-control select2" name="manager_id">
                        <option value="">Select</option>
                        @foreach ($employees as $employee)
                            <option value="{{$employee->id}}">{{$employee->full_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-6 form-group">
                    <label class="required" for="department_id">Department</label>
                    <select  class="form-control select2" name="department_id">
                        <option value="">Select</option>
                        @foreach ($departments as $department)
                            <option value="{{$department->id}}">{{$department->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>



@endsection
