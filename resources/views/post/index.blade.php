@extends('main')

@section('title', $title)

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Beranda</a></li>
            <li class="breadcrumb-item active" aria-current="page">Posts</li>
        </ol>
    </nav>

    <div class="row mb-3">
        <div class="col-md-12">
            <h2>Posts</h2>
            <a class="btn btn-success" href="{{route('post.add')}}">
                Create Post
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            @if(session('status'))
                <div class="alert-success p-3" id="success">
                    {{session('status')}}
                </div>
            @endif
            <table class="table table-bordered mt-4">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Content</th>
                        <th scope="col">Date</th>
                        <th scope="col">Username</th>
                    </tr>
                </thead>
                <tbody>
                    @if(count($data) > 0)
                    @foreach($data as $key => $item)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{$item->title}}</td>
                        <td>{!!$item->content!!}</td>
                        <td>{{$item->date}}</td>
                        <td>{{$item->username}}</td>
                        <td>
                            <a class="btn btn-warning" href="{{route('post.add', ['id' => $item->idpost])}}">ubah</a>
                            <a onclick="alert('Apakah yakin untuk menghapus data ?')" href="{{route('post.delete', ['id' => $item->idpost])}}" class="btn btn-danger">Hapus</a>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td class="text-center" colspan="5">Tidak ada data</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
