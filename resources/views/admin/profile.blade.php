@extends('layouts.master')

@section('content')
<div id="page-title" class="padding-tb-30px gradient-white">
        <div class="container text-left">
            <ol class="breadcrumb opacity-5">
                <li><a href="{{url('/')}}">Home</a></li>
                <li class="active"> Admin Profile</li>
            </ol>

        </div>
    </div>

  <section>
  <div class="container" >
    <div class="row">
    <div class="col-lg-6 col-lg-offset-3 margin-left-100px">
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
                    
      <div class="panel panel-default margin-left-100px" style="padding: 10px;">
        <center><img src="/assets/img/{{$profile->img}}" style="border-radius: 50%;  height: 150px; width: 150px;"></center>
                        <label style="color: blue;">Name: </label>
                        {{$profile->name}}  <br>
                        <label style="color: blue;">Email : </label>
                        {{$profile->email}}  <br>
                        <label style="color: blue;">Address: </label>
                        {{$profile->address }}  <br> 
                        <label style="color: blue;">Phone: </label>
                        {{$profile->phone }}  <br> 

                        <label style="color: blue;">Summary: </label>
                        {{$profile->summary}}  <br>
                        <br>      
                        <a href="#" class="btn-sm btn-lg btn-block background-main-color text-white text-center font-weight-bold text-uppercase border-radius-10 padding-10px" data-toggle="modal"  data-target="#profile">Edit profile</a>
                       



        </div>
      </div>
    </div>  
  </div>
</div>
</section>

<div class="modal fade" id="profile" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title" id="myModalLabel">Edit Profile</h4>
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
      </div>
      <div class="modal-body">
        <form action="{{url('/admin/edit')}}" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
             
                   <input class="form-control" requiblue="" id="mo" value="{{$profile->id}}"  name="admin_id" type="hidden">

             <div class="form-group">
                <div class="col-md-12">
                <label class="mm" for="name">Name: </label>
                
                   <input class="form-control" value="{{$profile->name}}" requiblue=""  id="mo"  name="name" type="text">        
                 </div>
             </div>


             <div class="form-group">
                <div class="col-md-12">
                <label class="mm" for="name">Email: </label>
                
                   <input class="form-control" value="{{$profile->email}}" requiblue="" id="mo"  name="email" type="text">        
                 </div>
             </div>
             

             <div class="form-group">
                <div class="col-md-12">
                <label class="mm" for="password">Password: </label>
                
                   <input class="form-control" requiblue="" id="mo" name="password" type="password">        
                 </div>
             </div>

             <div class="form-group">
                <div class="col-md-12">
                <label class="mm" for="address">Address: </label>
                
                   <input class="form-control" value="{{$profile->address}}" requiblue="" id="mo"  name="address" type="text">        
                 </div>
             </div>

             <div class="form-group">
                <div class="col-md-12">
                <label class="mm" for="address">Phone: </label>
                
                   <input class="form-control" value="{{$profile->phone}}" requiblue="" id="mo"  name="phone" type="text">        
                 </div>
             </div>
             


             <div class="form-group">
                <div class="col-md-12">
                <label class="mm" for="img">Photo: </label>
                
                    <span class="btn btn-info btn-file" style="margin-bottom: 10px;">
                        <i class="fa fa-image"></i> Choose file <input type="file" style=" opacity:0; height: 10px; width: 50px;" name="img">
                    </span>
                 </div>
             </div>

             <div class="form-group">
                <div class="col-md-12">
                <label class="mm" for="summary">Summary: </label>
                
                   <textarea class="form-control" requiblue="" id="details" rows="4" name="summary">{{$profile->summary}}</textarea>   

                 </div>
             </div>
             
             <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-info">Save</button>
                
            </div>
            
         </form>
      </div>
      
    </div>
  </div>
</div>
@endsection