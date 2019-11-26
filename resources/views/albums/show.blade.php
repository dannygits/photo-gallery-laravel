@extends('layouts.app')

@section('content')
  <h1 class="container jumbotron text-center">{{$album->name}}</h1>
  @if(!Auth::guest())
    <div class="container">
        <a class="button secondary" href="/">Go Back</a>
        <a class="button" href="/photos/create/{{$album->id}}">Upload Photo To Album</a>
        <br>

        <a class="button" href="/albums/{{$album->id}}/edit">Edit Album photo</a>
    </div>
  @endif
  <hr>
  <div class="container-fluid photo">
    @if(count($album->photos) > 0)
    <?php
      $colcount = count($album->photos);
  	  $i = 1;
    ?>
    <div id="photos">
      <div class="row text-center">
        @foreach($album->photos as $photo)
          @if($i == $colcount)
            <div class='animated fadeIn gallery_product col-lg-6 col-md-6 column end'>
             <a href="/photos/{{$photo->id}}">
                <img class="thumbnail img-fluid image-size" src="/storage/photos/{{$photo->album_id}}/{{$photo->photo}}" alt="{{$photo->id}}">
              </a>
             <br>
          @else
            <div class='animated fadeIn gallery_product col-lg-6 col-md-6 column'>
              <a href="/photos/{{$photo->id}}">
                 <img class="thumbnail img-fluid image-size" src="/storage/photos/{{$photo->album_id}}/{{$photo->photo}}" alt="{{$photo->id}}">
               </a>
              <br>
          @endif
        	@if($i % 2 == 0)
          </div></div><div class="row text-center">
        	@else
            </div>
          @endif
        	<?php $i++; ?>
        @endforeach
      </div>
    </div>
  @else
    <p class="message text-center">No Photos To Display</p>
  @endif
  </div>
  <hr>

  @if(!Auth::guest())
    <div class="container">
      {!!Form::open(['action' => ['AlbumsController@destroy', $album->id], 'method' => 'POST'])!!}
          {{Form::hidden('_method', 'DELETE')}}
          {{Form::submit('Delete Album', ['class' => 'button alert'])}}
      {!!Form::close()!!}
    </div>
  @endif
@endsection
