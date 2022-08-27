@extends('main')

@section('title', $title)

@section('content')
    <div class="container">
        <h3>{{$data->title}}</h3>
        <small>{{$data->username}}</small>
        <br>
        <small>{{$data->date}}</small>
        <p>{!! $data->content !!}</p>
    </div>
@endsection
