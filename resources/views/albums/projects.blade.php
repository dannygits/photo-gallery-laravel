@extends('layouts.app')

@section('content')
<br>
<br>
  <div class="container-fluid">
    @if(count($albums) > 0)
    <?php
      $colcount = count($albums);
  	  $i = 1;
    ?>
    <div id="main">
    <div class="albums">
      <div class="row text-center">
        @foreach($albums as $album)
          @if($i == $colcount)
             <div class='animated fadeIn gallery_product {{$album->type}} col-lg-6 col-md-6 column end'>
               <a href="/albums/{{$album->id}}">
                  <img class="thumbnail img-fluid img-responsive image-size" src="storage/album_covers/{{$album->cover_image}}" alt="{{$album->name}}">
                  <div class="caption">
                    <div class="descriptions">
                      <h1>{{$album->name}}</h1>
                      <p>{{$album->description}}</p>
                    </div>
                  </div>
                </a>
            @else
            <div class='animated fadeIn gallery_product {{$album->type}} col-lg-6 col-md-6 column'>
              <a href="/albums/{{$album->id}}">
                <img class="thumbnail img-fluid img-responsive image-size" src="storage/album_covers/{{$album->cover_image}}" alt="{{$album->name}}">
                  <div class="caption">
                    <div class="descriptions">
                      <h1>{{$album->name}}</h1>
                      <p>{{$album->description}}</p>
                    </div>
                  </div>
                </a>
              @endif
        	  @if($i % 2 == 0)
          </div>
        </div>
          <div class="row text-center">
        	  @else
          </div>
            @endif
        @endforeach
      </div>
    </div>
  @else
    <p class="text-center">No Albums To Display</p>
  @endif
</div>
</div>
@endsection
