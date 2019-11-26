@extends('layouts/app')
@section('content')
    <div class="container text-center single-img">
        <img class="img-fluid img-responsive" src="/storage/photos/{{$photo->album_id}}/{{$photo->photo}}" alt="{{$photo->id}}">
    </div>
    <br><br>

    @if(!Auth::guest())
    <div class="container">
        <div class="control-buttons">
            {!!Form::open(['action' => ['PhotosController@destroy', $photo->id], 'method' => 'POST'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete Photo', ['class' => 'button alert'])}}
            {!!Form::close()!!}         
        </div>
        <hr>
        <a class="button" href="/photos/{{$photo->id}}/edit">edit photo</a>
        
        <small>Size: {{$photo->size}}</small>
    </div>
    @endif
@endsection