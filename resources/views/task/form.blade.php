@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        @if($edit)
                            <form action="{{ route('task.update',$model->id)}}" method="POST" class="form-horizontal">
                                <input type="hidden" value="put" name="_method">
                        @else
                            <form action="{{ route('task.store')}}" method="POST" class="form-horizontal">
                                @endif
                                {{ csrf_field() }}
                                <!-- Task Name -->
                                <div class="form-group">
                                    <label for="task-title" class="col-sm-2 control-label">Title</label>
                                    <div class="col-sm-9">
                                        <input type="text" name="title" id="task-title" class="form-control" value="{{ $edit ? $model->title : old('title') }}" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="task-description" class="col-sm-2 control-label">Description</label>
                                    <div class="col-sm-9">
                                        <textarea name="description" id="task-description" class="form-control" rows="5" required>{{ $edit ? $model->description : old('description') }}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="task-description" class="col-sm-2 control-label">Assigned by Admin:</label>
                                    <div class="col-sm-9">
                                        <select class="form-select" aria-label="Default select example" name="assigned_by_id" required>
                                            <option>Select Admin</option>
                                            @foreach($admins as $admin)
                                                <option value="{{ $admin->id }}" {{ ($edit && $model->assigned_by_id == $admin->id) ? 'selected' : '' }} >{{ $admin->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="task-description" class="col-sm-2 control-label">Assigned To</label>
                                    <div class="col-sm-9">
                                        <select class="form-select" aria-label="Default select example" name="assigned_to_id" required>
                                            <option>Select User</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{ ($edit && $model->assigned_to_id == $user->id) ? 'selected' : '' }} >{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <!-- Add Task Button -->
                                <div class="form-group mt-3">
                                    <div class="col-sm-offset-2 col-sm-9">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-btn fa-plus"></i> Submit
                                        </button>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
