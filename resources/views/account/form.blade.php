@extends('main')

@section('title', 'Show filter')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('blog.index')}}">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{route('account.index')}}">Account</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Account</li>
        </ol>
    </nav>

    <div class="row mb-3">
        <div class="col-md-12">
            <h2>Create Post</h2>
        </div>
    </div>

    <form method="post" action="{{route('account.save')}}">
        @csrf
        <div class="row">
            <div class="col-md-12">
                @if(session('status'))
                    <div class="alert-success p-3" id="success">
                        {{session('status')}}
                    </div>
                @endif
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" class="form-control" name="username" value="{{$data->username}}">
                    @error('username')
                        <div class="error-message text-danger">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password">
                    @error('password')
                        <div class="error-message text-danger">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" name="name" value="{{$data->name}}">
                    @error('name')
                        <div class="error-message text-danger">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Role</label>
                    <select name="role" id="role" class="form-control">
                        <option value="admin">Admin</option>
                        <option value="author">author</option>
                    </select>
                </div>
                <input type="hidden" name="id" value="{{$data->username}}">
                <button type="submit" class="btn btn-success mb-3">Save</button>
            </div>
        </div>
    </form>
    
    <script>
        $(document).ready(function(){
            CKEDITOR.replace( 'konten', {
                height:"700",
            } );
        });
    </script>
@endsection
