@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        Create Task
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("departments.update",$department) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label class="required" for="name">Name</label>
                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                 type="text" name="name" id="name" value="{{ old('name', $department->name) }}" required>
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
