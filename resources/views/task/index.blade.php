@extends('layouts.admin')
@section('content')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('tasks.create') }}">
            Add Task
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        List Tasks
    </div>

    <div class="card-body">
        <form action="{{ route('tasks.index') }}">
            @csrf

            <div class="row">
                <div class="form-group col-lg-3">
                    <label class="" for="name">name</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                        type="text" name="name" id="name" value="{{ request()->name }}">
                </div>
                <div class="form-group col-lg-3">
                    <label class="required" for="status">Status</label>
                    <select  class="form-control select2" name="status">
                        <option value="">Select</option>
                        @foreach ($statuses as $status)
                            <option {{ $status == request('status') ? 'selected' : ''}} value="{{$status}}">{{$status}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <button name="search"
                class="btn btn-primary" type="submit">
                Search
            </button>

        </form>

        <br>

        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>
                        Id
                    </th>
                    <th>
                        Name
                    </th>
                    <th>
                        Description
                    </th>
                    <th>
                        Status
                    </th>
                    <th>
                        Assigned Employee
                    </th>
                    <th>
                        Created Employee
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>

            <thead>
                @foreach ($tasks as $task)
                    <tr>
                        <td>
                            {{ $task->id }}
                        </td>
                        <td>
                            {{ $task->name }}
                        </td>
                        <td>
                            {{ $task->description }}
                        </td>
                        <td>
                            <form action="{{ route('tasks.changeStatus', $task->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="form-control" onchange="this.form.submit()">
                                    @foreach ($statuses as $status)
                                        <option value="{{ $status }}" {{ $task->status == $status ? 'selected' : '' }}>
                                            {{ ucfirst($status) }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </td>
                        <td>
                            {{ $task->assignedEmployee->full_name }}
                        </td>
                        <td>
                            {{ $task->createdEmployee->full_name }}
                        </td>
                        <td>
                            @can('update', $task)
                                <a class="btn btn-xs btn-primary" href="{{ route('tasks.edit', $task->id) }}">
                                    edit
                                </a>
                            @endcan
                        </td>
                    </tr>
                @endforeach

            </thead>

        </table>

        {{ $tasks->links('pagination::bootstrap-4') }}

    </div>
</div>



@endsection

@section('scripts')
@parent

@endsection
