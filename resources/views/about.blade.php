
@extends('layouts.master')

@section('content')

<div id="page-title" class="padding-tb-30px gradient-white">
        <div class="container text-center">
            <ol class="breadcrumb opacity-5">
                <li><a href="#">Home</a></li>
                <li class="active">About</li>
            </ol>
            <h1 class="font-weight-300">About Us</h1>
        </div>
    </div>

    <section class="margin-tb-100px">
        <div class="container">

            <div class="row">

                <div class="col-lg-4 col-md-6 sm-mb-30px wow fadeInUp">
                    <div class="service text-center opacity-hover-7 hvr-bob">
                        <div class="icon margin-bottom-10px">
                            <img src="assets/img/icon/service-1.png" alt="">
                        </div>
                        <h3 class="text-second-color">Reliable Places</h3>
                        <p class="text-grey-2">Find all talents from diffren countries in our website.</p>
                    </div>
                </div>


                <div class="col-lg-4 col-md-6 sm-mb-30px wow fadeInUp" data-wow-delay="0.4s">
                    <div class="service text-center opacity-hover-7 hvr-bob">
                        <div class="icon margin-bottom-10px">
                            <img src="assets/img/icon/service-3.png" alt="">
                        </div>
                        <h3 class="text-second-color">Quick search</h3>
                        <p class="text-grey-2">You can make search critrea easily by places and talent category our using description keywords.</p>
                    </div>
                </div>


                <div class="col-lg-4 col-md-6 sm-mb-30px wow fadeInUp" data-wow-delay="0.6s">
                    <div class="service text-center opacity-hover-7 hvr-bob">
                        <div class="icon margin-bottom-10px">
                            <img src="assets/img/icon/service-4.png" alt="">
                        </div>
                        <h3 class="text-second-color">Know better</h3>
                        <p class="text-grey-2">Know better information abou kids and their talents only in our wesite.</p>
                    </div>
                </div>

            </div>

        </div>
    </section>


@endsection