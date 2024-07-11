@extends('layouts.admin')
@section('content')
<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('departments.create') }}">
            Add department
        </a>
    </div>
</div>

<div class="card">
    <div class="card-header">
        List departments
    </div>

    <div class="card-body">
        <form action="{{ route('departments.index') }}">
            @csrf

            <div class="row">

                <div class="form-group col-lg-3">
                    <label class="" for="name">name</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                        type="text" name="name" id="name" value="{{ request()->name }}">
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
                        Emp Count
                    </th>
                    <th>
                        Sum Salary
                    </th>
                    <th>
                        &nbsp;
                    </th>
                </tr>
            </thead>

            <thead>
                @foreach ($departments as $department)
                    <tr>
                        <td>
                            {{ $department->id }}
                        </td>
                        <td>
                            {{ $department->name }}
                        </td>
                        <td>
                            {{ $department->employees_count }}
                        </td>
                        <td>
                            {{ $department->total_salaries }}
                        </td>
                        <td>
                            <a class="btn btn-xs btn-primary" href="{{ route('departments.edit', $department->id) }}">
                                edit
                            </a>

                            <form action="{{ route('departments.destroy', $department->id) }}" method="POST" onsubmit="return confirm('Are u sure?');" style="display: inline-block;">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-xs btn-danger" value="delete">
                            </form>

                        </td>
                    </tr>
                @endforeach

            </thead>

        </table>

        {{ $departments->links('pagination::bootstrap-4') }}

    </div>
</div>



@endsection

@section('scripts')
@parent

@endsection
