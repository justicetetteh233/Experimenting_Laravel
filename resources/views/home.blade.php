@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Dashboard') }}

                    <div>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('positions.index') }}">{{ __('Register Position') }}</a>
                        </li>
                    </div>

                    <div>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('voters.index') }}">{{ __('Register Voter') }}</a>
                        </li>
                    </div>
                
                    <div>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('candidates.index') }}">{{ __('Register Candidate') }}</a>
                        </li>
                    </div>

                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>

            <div class="card">
                <div class="card-header">{{ __(Auth::user()->user_type) }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
