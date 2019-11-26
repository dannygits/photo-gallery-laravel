@extends('layouts/app')
@section('content')
<div class="container">
    <br>   
    <h3 class="text-center">Update Photo</h3>
    <br>
    <div class="container">
        {!!Form::open(['action' => ['PhotosController@update', $photo->id], 'method' => 'POST', 'enctype' => 'multipart/form-data'])!!}
            {{Form::file('photo')}}
            {{Form::hidden('album_id', $photo->album->id)}}
            {{Form::hidden('_method','PUT')}}  
            {{Form::submit('submit')}}
        {!! Form::close() !!}
    </div>
</div>
@endsection