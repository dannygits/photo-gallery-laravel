@extends('layouts/app')
@section('content')
<div class="container">
    <br>   
    <h3 class="text-center">Update Cover Photo</h3>
    <br>
    <div class="container">
        {!!Form::open(['action' => ['AlbumsController@update', $album->id], 'method' => 'POST', 'enctype' => 'multipart/form-data'])!!}
            {{Form::text('name','',['placeholder' => 'Album Name'])}}<br><hr>
            {{Form::textarea('description','',['placeholder' => 'Album Description'])}}<br><hr>
            {{Form::file('cover_image')}}<br><hr> 
            {{Form::hidden('_method','PUT')}}  
            {{Form::submit('submit')}}
        {!! Form::close() !!}
    </div>
</div>
@endsection