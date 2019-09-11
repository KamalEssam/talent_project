@extends('layouts.master')

@section('content')

    <div id="page-title" class="padding-tb-30px gradient-white">
        <div class="container text-left">
            <ol class="breadcrumb opacity-5">
                <li><a href="{{url('/')}}">Home</a></li>
                <li class="active">Talents</li>
            </ol>
            <h1 class="font-weight-300"> Pending Talents</h1>
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

                    @foreach($talents as $talent)
                    <div class="blog-entry background-white border-1 border-grey-1 margin-bottom-35px box-shadow border-radius-10 overflow-hidden">
                        <div class="row no-gutters">
                            <div class="img-in col-lg-5"><a href="#"><img src="/assets/img/{{$talent->img}}" style="height: 270px;" alt=""></a></div>
                            <div class="col-lg-7">
                                <div class="padding-lr-25px padding-tb-50px">
                                    <a class="d-block h4  text-capitalize margin-bottom-8px" href="{{url('/talent/details',['id'=>$talent->id])}}">{{$talent->name}} </a>
                                    <div class="meta">
                                        <span class="margin-right-20px text-extra-small">By : <a href="{{url('/user/profile',['id'=>$talent->user_id])}}" class="text-main-color">{{App\User::find($talent->user_id)->name}}</a></span><br>
                                        <span class="margin-right-20px text-extra-small">Date :  <a href="{{url('/talent/details',['id'=>$talent->id])}}" class="text-main-color">{{$talent->created_at}}</a></span><br>
                                        <span class="text-extra-small">Category :  <a href="{{url('/talent/details',['id'=>$talent->id])}}" class="text-main-color">{{App\Category::where('id',$talent->category_id)->first()->name}}</a></span>
                                        <br>
                                        <span class="text-extra-small">Description :  <a href="{{url('/talent/details',['id'=>$talent->id])}}" class="text-main-color">{{$talent->description}}</a></span>
                                        

                                    </div>
                                    

                                    <a href="{{url('/accept/request',['id'=>$talent->id])}}" class="d-inline-block text-grey-2 text-up-small"><i class="far fa-file-alt"></i> Approve</a>
                                    <a href="{{url('/refuse/request',['id'=>$talent->id])}}" class="d-inline-block margin-lr-20px text-grey-2 text-up-small"><i class="far fa-window-close"></i> Block</a>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    @endforeach


                    

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