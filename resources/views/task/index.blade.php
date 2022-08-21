@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Tasks') }}</div>
                    <div class="card-body">
                        <div class="container">
                            <h2>Tasks</h2>
                            <table class="table table-bordered" id="table">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Name</th>
                                    <th>Assigned To</th>
                                    <th>Assigned by</th>
                                    <th>Create At</th>
                                    <th>action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tasks as $task)
                                    <tr>
                                        <th>
                                            {{ $task->id }}
                                        </th>
                                        <th>
                                            {{ $task->title }}
                                        </th>
                                        <th>
                                            {{ $task->assignedTo->name }}
                                        </th>
                                        <th>
                                            {{ $task->assignedBy->name }}
                                        </th>
                                        <th>
                                            {{ $task->created_at }}
                                        </th>
                                        <th>
                                            <a class="btn btn-block btn-info mt-1" href="{{ route('task.edit',$task->id) }}">Edit</a>
                                            <form action="{{ route('task.destroy',$task->id) }}" method="Post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-block btn-danger mt-1">Delete</button>
                                            </form>
                                        </th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {!! $tasks->withQueryString()->links('pagination::bootstrap-5') !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
