@extends('layouts.admin')

@section('title', 'Contact')

@section('content')
    <div class="card">
        <div class="card-header">
            <h6 class="card-title">@yield('title')</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    {{ $dataTable->table() }}
                </div>
            </diV>
        </div>
    </div>
@endsection

@push('scripts')
    {{$dataTable->scripts()}}
@endpush