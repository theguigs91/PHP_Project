@extends('layouts.app')

@section('content')
    <div class="section no-pad-bot red" id="index-banner">
        <div class="container">
            <br><br>

            <h1 class="header center white-text">Améliorer votre organisation</h1>
            <div class="row center">
                <h5 class="header col s12 light white-text">Asana est le moyen le plus simple d'organiser une équipe et
                d'obtenir des résultats rapidement</h5>
            </div>
            <div class="row center">
                <a href="#SignInModal" id="download-button" class="btn-large waves-effect waves-light purple darken-4 pulse">J'y vais</a>
            </div>
            <br><br>
        </div>
    </div>


    <div class="container">
        <div class="section">
            <div class="row">
                <div class="col s12 m4">
                    <div class="icon-block">
                        <h2 class="center purple-text text-darken-4"><i class="material-icons">flash_on</i></h2>
                        <h5 class="center">Speeds up development</h5>

                        <p class="light">We did most of the heavy lifting for you to provide a default stylings that incorporate our custom components. Additionally, we refined animations and transitions to provide a smoother experience for developers.</p>
                    </div>
                </div>

                <div class="col s12 m4">
                    <div class="icon-block">
                        <h2 class="center purple-text text-darken-4"><i class="material-icons">group</i></h2>
                        <h5 class="center">User Experience Focused</h5>

                        <p class="light">By utilizing elements and principles of Material Design, we were able to create a framework that incorporates components and animations that provide more feedback to users. Additionally, a single underlying responsive system across all platforms allow for a more unified user experience.</p>
                    </div>
                </div>

                <div class="col s12 m4">
                    <div class="icon-block">
                        <h2 class="center purple-text text-darken-4"><i class="material-icons">settings</i></h2>
                        <h5 class="center">Easy to work with</h5>

                        <p class="light">We have provided detailed documentation as well as specific code examples to help new users get started. We are also always open to feedback and can answer any questions a user may have about Materialize.</p>
                    </div>
                </div>
            </div>

        </div>
        <br><br>
    </div>

    <div class="section">
        <div class="row">
            <div id="videoContainer-home" data-name="Watch the video" class="video-vimeo-with-bg background-cover active" style="height: 1071.56px;">
                <video id="homepageVideo" class="html-vid" loop autoplay="">
                    <!-- <source src="https://d1gwm4cf8hecp4.cloudfront.net/vid/home/giantant2.ogg" type="video/ogg"> -->
                    <source src="https://d1gwm4cf8hecp4.cloudfront.net/vid/home/giantant2.mp4" type="video/mp4">
                    <source src="https://d1gwm4cf8hecp4.cloudfront.net/vid/home/giantant2.webm" type="video/webm">

                    <img src="https://luna1.co/55f3a1.jpg" class="video-poster" alt="Watch the video" title="Watch the video">
                </video>
            </div>
        </div>
    </div>

    <section class="pageSection section--customers-heart">
        <div class="container">
            <div class="row">
                <div class="innerContent">
                    <h2 class="center">Great teams get great results with Asana</h2>
                    <p class="center">From companies with <nobr>off-the-charts</nobr> growth to local businesses and non-profits, teams love Asana.</p>
                </div>
            </div>
        </div>
    </section>

@endsection