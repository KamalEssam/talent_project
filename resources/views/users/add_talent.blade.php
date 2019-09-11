
@extends('layouts.master')

@section('content')

<div id="page-title" class="padding-tb-10px gradient-white">
        <div class="container">
            <ol class="breadcrumb opacity-5">
                <li><a href="{{url('/')}}">Home</a></li>
                <li class="active"><a href="">Add Talent</a></li>
            </ol>
            <h1 class="font-weight-300">Add Talent</h1>
        </div>
    </div>

    <div class="container">
        <div class="row">
    <div class="col-sm-10 " style="padding-left: 200px;">
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

        <div class="margin-tb-30px full-width">
            <h4 class="padding-lr-30px padding-tb-20px background-white box-shadow border-radius-10"><i class="far fa-list-alt margin-right-10px text-main-color"></i>Talent Information</h4>
            <div class="padding-30px padding-bottom-10px background-white border-radius-10">
                <form action="{{url('/talent/save')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group margin-bottom-20px">
                        <label><i class="far fa-list-alt margin-right-10px"></i> Talent Title</label>
                        <input type="text" required="" class="form-control form-control-sm" name="name" id="ListingTitle" placeholder="Talent Title">
                    </div>

                    <div class="form-group margin-bottom-20px">
                        <div class="row">
                            <div class="col-md-6">
                                <label><i class="far fa-folder-open margin-right-10px"></i> Category</label>
                                <select class="form-control form-control-sm" name="category_id">
                                    @foreach(App\Category::all() as $cat)
                                    <option value="{{$cat->id}}">{{$cat->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>
                    </div>
                    <div class="margin-bottom-45px full-width">
                    <label><i class="far fa-list-alt margin-right-10px"></i> Description</label>
                <div class="margin-bottom-20px">
                    <textarea class="form-control" required="" name="description" placeholder="Talent description" name="details" id="exampleTextarea" rows="4"></textarea>
                </div>
                <div class="row">
                    <div class="col-md-12 margin-bottom-20px">
                        <label><i class="fas fa-video margin-right-10px"></i> Video URL</label>
                        <input type="text" name="v_url" required="" class="form-control form-control-sm" placeholder="http://www./">
                    </div>
                    
                </div>

                <div class="row">

                    <div class="col-md-6 margin-bottom-10px">
                        <label><i class="far fa-images margin-right-10px"></i> Image</label><br>
              <span class="btn btn-info btn-file" style="margin-bottom: 10px;">
              <i class="fa fa-image"></i>select Photo<input type="file" name="img" style=" opacity:0; height: 10px; width: 50px;">
              </span>
                    </div>
                </div>


            </div>
        </div>
        <button type="submit" class="btn btn-md btn-primary full-width">Save</button>

                </form>
        </div>

        
</div>
</div>
    </div>



@endsection