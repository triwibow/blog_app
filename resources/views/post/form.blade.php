@extends('main')

@section('title', 'Show filter')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{route('post.index')}}">Posts</a></li>
            <li class="breadcrumb-item active" aria-current="page">Create Post</li>
        </ol>
    </nav>

    <div class="row mb-3">
        <div class="col-md-12">
            <h2>Create Post</h2>
        </div>
    </div>

    <form method="post" action="{{route('post.save')}}">
        @csrf
        <div class="row">
            <div class="col-md-12">
                @if(session('status'))
                    <div class="alert-success p-3" id="success">
                        {{session('status')}}
                    </div>
                @endif
                <div class="form-group">
                    <label>Title</label>
                    <input type="text" class="form-control" name="title" value="{{$data->title}}">
                    @error('title')
                        <div class="error-message text-danger">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <label>Content</label>
                    <textarea class="form-control" name="content" id="konten">{!!$data->content!!}</textarea>
                    @error('content')
                        <div class="error-message text-danger">
                            {{$message}}
                        </div>
                    @enderror
                </div>
                <input type="hidden" name="id" value="{{$data->postid}}">
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
