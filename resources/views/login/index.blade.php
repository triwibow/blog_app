@extends('main')

@section('title', $title)

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Login</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <h2>Login</h2>
            <span>Please fill out the following fields to login:</span>
            @if(session('status'))
                <div class="alert-success p-3 mb-3" id="success">
                    {{session('status')}}
                </div>
            @endif
            <form method="post" action="{{route('login.validate')}}">
                @csrf
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password">
                </div>
                <button class="btn btn-primary">Login</button>
            </form>
        </div>
    </div>
</div>
@endsection
