@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Statistics') }}</div>

                    <div class="card-body">
                        <div class="container">
                            <h2>Statistics</h2>
                            <table class="table table-bordered" id="table">
                                <thead>
                                <tr>
                                    <th>Rank</th>
                                    <th>user</th>
                                    <th>count</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($topUsers as $key => $user)
                                    <tr>
                                        <th>
                                            {{ $key + 1 }}
                                        </th>
                                        <th>
                                            {{ $user->user->name }}
                                        </th>
                                        <th>
                                            {{ $user->count }}
                                        </th>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
