
@extends('layouts.master')

@section('content')
@include('layouts.carousel')

    <section class="padding-tb-100px">
        <div class="container">
            <div class="row justify-content-center margin-bottom-45px">
                <div class="col-lg-10">
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
                    <div class="row">
                        <div class="col-md-4 wow fadeInUp">
                            <h1 class="text-second-color font-weight-300 text-sm-center text-lg-right margin-tb-15px">Popular Talents</h1>
                        </div>
                        
                        <div class="col-md-2 wow fadeInUp" data-wow-delay="0.4s">
                            <a href="{{url('/user/talents')}}" class="text-main-color margin-tb-15px d-inline-block"><span class="d-block float-left margin-right-10px margin-top-5px">Show All</span> <i class="far fa-arrow-alt-circle-right text-large margin-top-7px"></i></a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">

                @foreach($talents as $talent)
                <div class="col-lg-4 col-md-6 sm-mb-45px">
                    <div class="background-white full-width thum-hover box-shadow hvr-float wow fadeInUp" data-wow-delay="0.2s">
                        <div class="item-thumbnail thum background-white">
                            <a href="{{url('/talent/details',['id'=>$talent->id])}}"><img src="/assets/img/{{$talent->img}}" style="height: 200px;" width="100%"  alt=""></a>
                        </div>
                        <div class="padding-30px">
                            <h5 class="margin-bottom-20px"><a class="text-dark" href="{{url('/talent/details',['id'=>$talent->id])}}">{{$talent->title}}</a></h5>
                            <div class="rating clearfix">
                                <a href="{{url('/user/profile',['id'=>$talent->user_id])}}" class="float-left text-grey-2"><img src="/assets/img/{{App\User::find($talent->user_id)->img}}" class="height-30px border-radius-30 margin-right-15px" alt="">  {{App\User::find($talent->user_id)->name}}</a>
                                
                            </div>
                        </div>
                        <div class="padding-lr-10px padding-tb-15px background-light-grey">
                            <div class="row no-gutters">
                                <div class="col-6 "><a href="#" class="text-red">
                                    @if(!auth()->guard('admin')->user()&&auth()->guard('user')->user()&&auth()->guard('user')->user()->id!=$talent->user_id)
                                        <a href="{{url('/talent/like',['id'=>$talent->id])}}" class="text-red"><i class="far fa-heart"></i> Like</a>

                                        @endif
                                    <span class="text-right" style=" padding-left:5px;color: red;">
                                        {{App\Like::where('talent_id',$talent->id)->count()}} Likes</span></div>

                                <div class="col-6"><a href="{{url('/talent/details',['id'=>$talent->id])}}" class="text-lime"><i class="far fa-comment"></i> Comment({{App\Comment::where('talent_id',$talent->id)->count()}})</a></div>

                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>

        </div>
    </section>



@endsection