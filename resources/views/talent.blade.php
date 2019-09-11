
@extends('layouts.master')

@section('content')


<div id="page-title" class="padding-tb-30px gradient-white">
        <div class="container">
            <ol class="breadcrumb opacity-5">
                <li><a href="#">Home</a></li>
                <li><a href="#">Talent</a></li>
                <li class="active">Details</li>
            </ol>
            <h1 class="font-weight-300"> Talent Details</h1>
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
                    <div class="margin-bottom-30px box-shadow">
                        <img src="/assets/img/{{$talent->img}}" alt="" width="100%">
                        <div class="padding-30px background-white">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="rating clearfix">
                                        <span class="float-left text-title-large text-main-color"><h3>{{$talent->title}}.</h3> </span>
                                        
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row no-gutters">
                                        @if(!auth()->guard('admin')->user()&&auth()->guard('user')->user()&&auth()->guard('user')->user()->id!=$talent->user_id)
                                        <div class="col-6 text-right"><a href="{{url('/talent/like',['id'=>$talent->id])}}" class="text-red"><i class="far fa-heart"></i> Like</a></div>

                                        @endif

                                       <span class="text-right" style=" padding-left:20px;color: red;">
                                        {{App\Like::where('talent_id',$talent->id)->count()}} Likes</span>

                                        
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="rating clearfix">
                                         <a href="{{url('/user/profile',['id'=>$talent->user_id])}}" class="float-left text-grey-2"><img src="/assets/img/{{App\User::find($talent->user_id)->img}}" class="height-30px border-radius-30 margin-right-15px" alt="">  {{App\User::find($talent->user_id)->name}}</a>
                                        
                                    </div>
                                </div>
                               

                            </div>
                        </div>
                    </div>


                    <div class="margin-bottom-30px box-shadow">
                        <div class="padding-30px background-white">
                            <h3><i class="far fa-list-alt margin-right-10px"></i> Description</h3>
                            <hr>
                            <p class="text-grey-2">{{$talent->description}}</p>
                        </div>
                    </div>

                    <div class="margin-bottom-30px box-shadow">
                        <div class="padding-30px background-white">
                            <h3><i class="far fa-comment margin-right-10px text-main-color"></i>({{App\Comment::where('talent_id',$talent->id)->count()}}) Comments</h3>
                            <hr>

                            <ul class="commentlist padding-0px margin-0px list-unstyled text-grey-3">
                                @foreach(App\Comment::where('talent_id',$talent->id)->get() as $comment)
                                <li class="border-bottom-1 border-grey-1 margin-bottom-20px">
                                    <img src="/assets/img/{{App\User::find($comment->user_id)->img}}" class="float-left margin-right-20px border-radius-60 margin-bottom-20px" alt="" style="width: 70px; height: 70px;">
                                    <div class="margin-left-85px">
                                        <a class="d-inline-block text-dark text-medium margin-right-20px" href="{{url('/user/profile',['id'=>$talent->user_id])}}">{{App\User::find($comment->user_id)->name}}</a>
                                        <span class="text-extra-small">Date :  <a href="#" class="text-main-color">{{$comment->created_at}}</a></span>
                                        <div class="rating">
                                            
                                        <p class="margin-top-15px text-grey-2">{{$comment->comment}}. </p>
                                    </div>
                                </li>
                                @endforeach
                               
                            </ul>
                            @if(auth()->guard('user')->user())
                            <form id="comment_form" method="post" action="{{url('/comment/add')}}">
                                   {{csrf_field()}}
                                   <input type="hidden" name="talent_id" value="{{$talent->id}}">
                                <div class="form-group">
                                    <textarea class="form-control" name="comment" id="exampleFormControlTextarea1" rows="3" placeholder="Comment"></textarea>
                                </div>
                                <a href="#" onclick="document.getElementById('comment_form').submit();" class="btn-sm btn-lg btn-block background-main-color text-white text-center font-weight-bold text-uppercase border-radius-10 padding-10px">Add Now</a>
                            </form>
                            @endif
                            
                        </div>
                    </div>
                    @if(!auth()->guard('admin')->user()&&!auth()->guard('user')->user())
                    <script type="text/javascript">
                        alert('Please login to be able to comment and like talents..');
                    </script>
                    @endif


                </div>
                <div class="col-lg-4">

                    <div class="background-white border-radius-10 margin-bottom-45px">
                        <div class="padding-25px">
                            <h3 class="margin-lr-20px"><i class="fas fa-search margin-right-10px text-main-color"></i> Search Filter</h3>
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
                        </div>
                    </div>

                    <div class="widget widget_categories">
                        <div class="margin-bottom-30px">
                            <h4 class="padding-lr-30px padding-tb-20px background-white box-shadow border-radius-10"><i class="far fa-folder-open margin-right-10px text-main-color"></i> Categories</h4>
                            <div class="padding-30px padding-bottom-30px background-white border-radius-10">
                                <ul>
                                    @foreach(App\Category::all() as $cat)
                                    <li><a href="{{url('/talents/cat',['id'=>$cat->id])}}">{{$cat->name}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>


@endsection