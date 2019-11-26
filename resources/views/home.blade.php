@extends('layouts/app')
@section('content')
<div id="myimageslider" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
    <li data-target="#myimageslider" data-slide-to="0" class="active"></li>
    <li data-target="#myimageslider" data-slide-to="1"></li>
    <li data-target="#myimageslider" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
    <div class="carousel-item active">
        <div class="carousel-caption d-none d-md-block">
            <span class="border">
            shaping concepts
            </span>
        </div>
        <img class="d-block w-100" src="/prolific studios/Residentials/SAOTA_NG_Moor-1.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
        <div class="carousel-caption d-none d-md-block">
            <span class="border">
            architectural analysis
            </span>
        </div>
        <img class="d-block w-100" src="/prolific studios/New folder/SAOTA_GN_HotelConakry_3.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
        <div class="carousel-caption d-none d-md-block">
            <span class="border">
            revolutionizing designs
            </span>
        </div>
        <img class="d-block w-100" src="/prolific studios/Interiors/sliders/Capture4.png" alt="Third slide">
    </div>
    </div>
    <a class="carousel-control-prev" href="#myimageslider" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myimageslider" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
    </a>
</div>

<div class="gallery">
    <div class="heading-text">
        <h1 class="jumbotron text-center">
                portfolio examples
        </h1>
    </div>
    <section class="awesome-gallery">
        <div class="photo">
            @if(count($photo) > 0)
            <?php
            $colcount = count($photo);
            $i = 1;
            ?>
            <div id="photos">
                <div class="row text-center">
                    @foreach($photo as $photo)
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
    </section>
</div>

<div class="animated fadeIn footer-contacts container">
    <div class="row">
        <div class="company-details col-lg-6 col-md-6 col-xs-12">
            <div class="company-name">prolific studios</div>
            <div class="company-contacts">tel 1: 0722178901</div>
            <div class="company-contacts">tel 2: 0710760317</div>
            <div class="company-address">Address 25271-00100</div>
            <div class="company-location">upperhill <br>Nairobi</div>
            <div class="portfolio">
                <a href="/prolific studios/Prolific.pdf"><button class="btn">portfolio</button></a>
            </div>
        </div>
        <div class="location col-lg-6 col-md-6 col-xs-12">
            <iframe class="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.7854080577767!2d36.817807614449706!3d-1.3037735360124847!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x182f10fb549d77a7%3A0x27c6220a2205f671!2sKiambere+Rd%2C+Nairobi!5e0!3m2!1sen!2ske!4v1544014931201" frameborder="0" style="border:0"></iframe>
        </div>
    </div>
</div>
@include('inc/footer')
@endsection