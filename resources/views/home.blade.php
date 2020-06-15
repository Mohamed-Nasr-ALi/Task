@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{env('APP_NAME')}}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    Welcome
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        @include('layouts.aside')
    </div>
</div>
@endsection
<script src="{{ asset('js/main/main.js') }}"></script>

