
@extends('layouts.master')

@section('content')


    <div id="page-title" class="padding-tb-30px gradient-white">
        <div class="container">
            <ol class="breadcrumb opacity-5">
                <li><a href="#">Home</a></li>
                <li><a href="#">User</a></li>
                <li class="active">Register</li>
            </ol>
            <h3 class="font-weight-300"> Talent Register</h3>
        </div>
    </div>
<div class="container margin-bottom-100px">
        
        <div id="log-in" class="site-form log-in-form box-shadow border-radius-10">
            @if ($errors->any())
                    <div class=" alert alert-warning">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li> <i class="fa fa-exclamation-triangle"></i> {{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
              @endif
              @if (session()->has('success'))
            
                    <div class="alert alert-success">
                      
                        <i class="fa fa-check-circle-o"></i> {{session()->get('success')}}
                      
                  </div>
            @endif
                                    <div class="form-output">
                <form action="{{url('/user/doregister')}}" method="post"  enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group label-floating">

                        <label class="control-label">Talent ID</label>
                        <input class="form-control" value="{{App\User::max('tid')+1}}"  name="tid" readonly="" placeholder="" type="text">
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Your Name</label>
                        <input class="form-control" value="" required="" name="name" placeholder="" type="text">
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Your Email</label>
                        <input class="form-control" value="" required="" name="email" placeholder="" type="email">
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Your Password</label>
                        <input class="form-control" value="" required="" name="password" placeholder="" type="password">
                    </div>

                    <div class="form-group label-floating">
                        <label class="control-label">Your Counry</label>
                        <input class="form-control" value="" required="" name="country" placeholder="" type="text">
                    </div>

                    <div class="form-group label-floating">
                        <label class="control-label">Your Address</label>
                        <input class="form-control" value="" required="" name="address" placeholder="" type="text">
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Your Phone</label>
                        <input class="form-control" value="" required="" name="phone" placeholder="" type="text">
                    </div>
                    <div class="form-group label-floating">
                        <label class="control-label">Your Age</label>
                        <input class="form-control" value="" required="" name="age" placeholder="" type="text">
                    </div>

                    <div class="form-group label-floating">
                        <label class="control-label">Your Gender</label>
                        <select name="gender" class="form-control">
                            <option value="1">Male</option>
                            <option value="2">Femalale</option>
                        </select>
                    </div>
                    <div class="form-group label-floating">
                    <label class="control-label">Your Summary</label>
                    <textarea class="form-control"  required="" name="summary" placeholder="write your summary..." name="biography" id="exampleTextarea" style="height: 250px;"></textarea>
                   </div>
                   <div class="form-group label-floating">
                        <label><i class="far fa-images margin-right-10px"></i> Image </label>
                          <span class="btn btn-info btn-file" style="margin-bottom: 10px;">


                          <i class="fa fa-image"></i>Select Picture<input type="file" name="img" style=" opacity:0; height: 40px; width: 80px;">
                         
                          </span>
                    </div>

                    <button type="submit" class="btn btn-md btn-primary full-width">Register</button>

                    
                </form>
            </div>
        </div>
        <!--======= // log_in_page =======-->

    </div>


@endsection