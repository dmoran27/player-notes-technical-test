@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Welcome') }}</div>

                <div class="card-body">
                    {{ __('Welcome to the Player Notes Application! Please log in to manage your player notes.') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection