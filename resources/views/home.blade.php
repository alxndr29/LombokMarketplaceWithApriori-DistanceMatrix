@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

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
    <div class="row text-center p-3">
        <div class="col">
            <a class="btn btn-danger" href="{{route('seller.dashboard')}}"> Halaman Seller </a>
        </div>
    </div>
</div>
@endsection