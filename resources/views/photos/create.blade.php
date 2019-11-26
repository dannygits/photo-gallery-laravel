@extends('layouts/app')
@section('content')
<div class="container">
    <br>   
    <h3 class="text-center">Upload Photo</h3>
    <br>
    <div class="container">
        {!!Form::open(['action' => 'PhotosController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data',])!!}
            <input type="file" name="photo[]" id="photo" multiple>
            <br>
            {{Form::hidden('album_id', $album_id)}}  
            {{Form::submit('submit')}}
        {!! Form::close() !!}
    </div>
</div>
@endsection