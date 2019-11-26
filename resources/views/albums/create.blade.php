@extends('layouts/app')
@section('content')
<div class="container">    
    <br>
    <h3>Create Album</h3>
    {!!Form::open(['action' => 'AlbumsController@store','method' => 'POST', 'enctype' => 'multipart/form-data'])!!}
        {{Form::text('name','',['placeholder' => 'Album Name'])}}<br><hr>
        {{Form::text('type','',['placeholder' => 'Album Type'])}}
        {{Form::textarea('description','',['placeholder' => 'Album Description'])}}<br><hr>
        {{Form::file('cover_image')}}<br><hr>   
        {{Form::submit('submit')}}
    {!! Form::close() !!}
</div>
@endsection