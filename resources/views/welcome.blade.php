@extends('layouts.libraryonly')
@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-primary" href="{{ url('/signin') }}">Masuk</a>
        </div>
    </div>
</div>
@endsection