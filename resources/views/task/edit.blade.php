@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Create Task
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("tasks.update",$task) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">Name</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                 type="text" name="name" id="name" value="{{ old('name', $task->name) }}" required>
            </div>
            <div class="form-group">
                <label class="required" for="description">Description</label>
                <input class="form-control {{ $errors->has('description') ? 'is-invalid' : '' }}"
                 type="text" name="description" id="description" value="{{ old('description', $task->name) }}" required>
            </div>
            <div class="form-group">
                <label class="required" for="status">Status</label>
                <select  class="form-control select2" name="status">
                    <option value="">Select</option>
                    @foreach ($statuses as $status)
                        <option {{ $task->status == $status? 'selected':'' }}  value="{{$status}}">{{$status}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="required" for="asssigned_user_id">employee</label>
                <select  class="form-control select2" name="asssigned_user_id">
                    <option value="">Select</option>
                    @foreach ($employees as $employee)
                        <option {{ $task->asssigned_user_id == $employee->id? 'selected':'' }} value="{{$employee->id}}">{{$employee->full_name}}</option>
                    @endforeach
                </select>
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
