
@extends('layouts.master')

@section('content')

<div id="page-title" class="padding-tb-30px gradient-white">
        <div class="container text-center">
            <ol class="breadcrumb opacity-5">
                <li><a href="#">Home</a></li>
                <li class="active">Contact US</li>
            </ol>
            <h1 class="font-weight-300">Contact US</h1>
        </div>
    </div>

    <div class="container margin-top-50px margin-bottom-100px">
        <div class="row">
            <div class="col-lg-6">
                @if ($errors->any())
                    <div class=" alert alert-warning">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li> <i class="fa fa-exclamation-triangle"></i> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                 @endif
                 @if (session()->has('error'))
                         
                                <div class=" alert alert-warning">
                                    <i class="fa fa-exclamation-triangle"></i> {{session()->get('error')}}
                                </div>
                    @endif
                    @if (session()->has('success'))
                         
                                <div class=" alert alert-success">
                                    <i class="fa fa-check"></i> {{session()->get('success')}}
                                </div>
                    @endif

               <form method="post" id="send_message" action="{{url('/send/message')}}">
                          {{csrf_field()}}
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Full Name</label>
                                <input type="text" name="name" class="form-control "  placeholder="Name">
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control"  placeholder="Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Subject</label>
                            <input type="text" class="form-control " name="subject"  placeholder="Subject">
                        </div>
                        <div class="form-group">
                            <label>Message</label>
                            <textarea class="form-control " name="body" rows="3"></textarea>
                        </div>
                        <a href="#" class="btn-sm btn-lg btn-block btn-info border-2 border-white text-white text-center font-weight-bold text-uppercase rounded-0 padding-15px " onclick="document.getElementById('send_message').submit();">Send</a>
                    </form>
            </div>

            <div class="col-lg-6">
                <div class="row">
                    <div class="col-12">
                        <p class="text-grey-2">Meet our registered talents so easy in our website enjoy talent kids shows. </p>
                    </div>
                    <div class="col-lg-6 col-md-6 margin-bottom-45px">
                        <div class="background-white text-center padding-30px box-shadow border-radius-10">
                            <i class="icon_mail_alt icon-large text-grey-2"></i>
                            <h6 class="font-weight-300 margin-top-15px">Email</h6>
                            <h5 class="font-2 ">talents@talents.dev</h5>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 margin-bottom-45px">
                        <div class="background-white text-center padding-30px box-shadow border-radius-10">
                            <i class="icon_map_alt icon-large text-grey-2"></i>
                            <h6 class="font-weight-300 margin-top-15px">Address</h6>
                            <h5 class="font-2 ">Riyadah, Saudi Arabia</h5>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 sm-mb-30px">
                        <div class="background-white text-center padding-30px box-shadow border-radius-10">
                            <i class="icon_link icon-large text-grey-2"></i>
                            <h6 class="font-weight-300 margin-top-15px">Website</h6>
                            <h5 class="font-2">KidsTalents.com</h5>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="background-white text-center padding-30px box-shadow border-radius-10">
                            <i class="icon_phone icon-large text-grey-2"></i>
                            <h6 class="font-weight-300 margin-top-15px">Telphone</h6>
                            <h5 class="font-2">+966581818181</h5>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="clearfix"></div>
    </div>





@endsection