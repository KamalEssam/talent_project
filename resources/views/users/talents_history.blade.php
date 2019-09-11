
@extends('layouts.master')

@section('content')

<div id="page-title" class="padding-tb-30px gradient-white">
        <div class="container">
            <ol class="breadcrumb opacity-5">
                <li><a href="#">Home</a></li>
                <li class="active">Talens History</li>
            </ol>
            <h1 class="font-weight-300">Talents History</h1>
        </div>
    </div>


    <div class="margin-tb-30px">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
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
                    @foreach($talents as $talent)
                <div class="col-lg-6 col-md-6 sm-mb-45px" style="margin-bottom: 10px;">
                    <div class="background-white full-width thum-hover box-shadow hvr-float wow fadeInUp" data-wow-delay="0.2s">
                        <div class="item-thumbnail thum background-white">
                            <a href="{{url('/talent/details',['id'=>$talent->id])}}"><img src="/assets/img/{{$talent->img}}" style="height: 200px;" width="100%"  alt=""></a>
                        </div>
                        <div class="padding-30px">
                            <h5 class="margin-bottom-20px"><a class="text-dark" href="{{url('/talent/details',['id'=>$talent->id])}}">{{$talent->title}}</a></h5>
                            
                            <div class="rating clearfix">
                                <a href="{{url('/user/profile',['id'=>$talent->user_id])}}" class="float-left text-grey-2"><img src="/assets/img/{{App\User::find($talent->user_id)->img}}" class="height-30px border-radius-30 margin-right-15px" alt="">  {{App\User::find($talent->user_id)->name}}</a>
                                @if($talent->admin_status==1)
                              <span style="margin-left: 30px;" class="btn-sm btn-success"><i class="fa fa-check"></i></span>
                              @endif
                              @if($talent->admin_status==2)
                              <span style="margin-left: 30px;" class="btn-sm btn-danger"><i class="fa fa-ban"></i></span>
                              @endif
                              @if($talent->admin_status==0)
                              <span style="margin-left: 30px;" class="btn-sm btn-info"><i class="fa fa-spinner fa-spin"></i></span>
                              @endif
                            </div>

                        </div>
                        <div class="padding-lr-10px padding-tb-15px background-light-grey">
                            <div class="row no-gutters">
                                <div class="col-6 ">


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
                <div class="col-lg-4">

                    <div class="background-white border-radius-10 margin-bottom-45px">
                        <div class="padding-25px">
                            <h3 class="margin-lr-20px"><i class="fas fa-search margin-right-10px text-main-color"></i> Search Filter</h3>
                            <!-- Listing Search -->
                            <div class="listing-search">
                                 <form  id="search_form" method="post" action="{{url('/talents/search')}}">
                            {{csrf_field()}}
                                    <input type="hidden" name="cat_id" id="tcat">
                                    <div class="keywords margin-bottom-20px">
                                        <input class="listing-form first border-radius-10" name="title" type="text" placeholder="Keywords..." value="">
                                    </div>
                                    <div class="regions margin-bottom-20px">
                                        <input class="listing-form border-radius-10" type="text" name="country" placeholder="All Regions" value="">
                                    </div>

                                    <div class="categories dropdown margin-bottom-20px">
                                        <a class="listing-form d-block text-nowrap" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">All Categories</a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                 @foreach(App\Category::all() as $cat)
                                                  <button class="dropdown-item text-up-small" onclick="document.getElementById('dropdownMenu2').innerHTML='{{$cat->name}}';
                                                document.getElementById('tcat').value='{{$cat->id}}';" type="button">{{$cat->name}}</button>
                                                @endforeach
                                        </div>
                                    </div>
                                    <a onclick="document.getElementById('search_form').submit();" class="listing-bottom background-dark box-shadow border-radius-10" href="#">Search Now</a>
                                </form>
                            </div>
                            <!-- // Listing Search -->
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>


@endsection