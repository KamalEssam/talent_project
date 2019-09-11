@extends('layouts.master')

@section('content')
<div id="page-title" class="padding-tb-30px gradient-white">
        <div class="container text-left">
            <ol class="breadcrumb opacity-5">
                <li><a href="{{url('/')}}">Home</a></li>
                <li class="active"> admin messages</li>
            </ol>
            <h1 class="font-weight-300"> Messages</h1>

        </div>
    </div>

  <section>
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
                    @foreach($messages as $message)
                        <div class="panel panel-default margin-left-100px" style="padding: 10px;">

                            <label style="color: red;">Name: </label>
                            {{$message->name}}  <br>
                            <label style="color: red;">Email : </label>
                            {{$message->email}}  <br>
                            <label style="color: red;">Subject: </label>
                            {{$message->subject }}  <br> 
                            <label style="color: red;">body: </label>
                            {{$message->content}}  <br>
                            <br>      
             
                       </div>
                       <hr>
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

</section>

@endsection