<header class="background-white box-shadow">
        <div class="container header-in">
        
                
 
                <div class="row">
                    <div class="col-lg-2 col-md-12">
                        <a id="logo" href="{{url('/')}}" class="d-inline-block margin-tb-15px"><img src="/assets/img/logo-1.png" style="height: 60px;" alt=""></a>
                        <a class="mobile-toggle padding-10px background-main-color" href="{{url('/')}}"><i class="fas fa-bars"></i></a>
                    </div>
                           @if(auth()->guard('admin')->user())
                            <div class="col-lg-9 col-md-12 position-inherit">

                            @else
                    <div class="col-lg-7 col-md-12 position-inherit">
                        @endif
                        <ul id="menu-main" class="nav-menu float-lg-right link-padding-tb-20px">
                            <li><a href="{{url('/')}}">Home</a></li>
                            <li><a href="{{url('/user/talents')}}">Talents</a></li>
                            @if(!auth()->guard('admin')->user())
                                <li class="has-dropdown"><a href="">Categories</a>
                                 
                                
                                    <ul class="sub-menu text-left">
                                        @foreach(App\Category::all() as $cat)
                                        <li><a href="{{url('/talents/cat',['id'=>$cat->id])}}">{{$cat->name}} </a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endif
                                @if(auth()->guard('admin')->user())
                            <li><a href="{{url('/admin/requests')}}">Requests</a></li>
                            <li><a href="{{url('/category/add')}}">Add category</a></li>
                            <li><a href="{{url('/admin/messages')}}">Messages</a></li>
                            @endif
                            <li><a href="{{url('/about')}}">About Us</a></li>
                            @if(!auth()->guard('admin')->user())
                            <li><a href="{{url('/contact')}}">Contact Us</a></li>
                            @endif
                             @if(auth()->guard('admin')->user())
                                <li class="has-dropdown"><a href="#"> <img src="/assets/img/{{auth()->guard('admin')->user()->img}}" class="height-30px border-radius-30 margin-right-0px" alt="">
                               {{auth()->guard('admin')->user()->name}}</a><span class="caret"></span>
                                    <ul class="sub-menu text-left">
                                          <li><a href="{{url('/admin/profile',['id'=>auth()->guard('admin')->user()->id])}}">My Profile </a></li>
                                          <li><a href="{{url('/admin/logout')}}">Logout</a></li>
                                    </ul>
                                </li>
                               @endif
                            @if(auth()->guard('user')->user())
                                <li class="has-dropdown"><a href="#"> <img src="/assets/img/{{auth()->guard('user')->user()->img}}" class="height-30px border-radius-30 margin-right-15px" alt="">{{auth()->guard('user')->user()->name}}<span class="caret"></span></a>
                                    <ul class="sub-menu text-left">
                                          <li><a href="{{url('/user/likes')}}"> My Likes </a></li>
                                          <li><a href="{{url('/history/talents')}}"> My Talents </a></li>
                                          <li><a href="{{url('/user/profile',['id'=>auth()->guard('user')->user()->id])}}"> My Profile  </a></li>
                                          <li><a href="{{url('/user/logout')}}"> Logout  </a></li>
                                    </ul>
                                </li>
                               @endif 
                               @if(!auth()->guard('admin')->user()&&!auth()->guard('user')->user())
                            <li><a href="{{url('/user/register')}}">Register</a></li>
                            @endif
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-12">
                        <hr class="margin-bottom-0px d-block d-sm-none">
                        @if(!auth()->guard('admin')->user())
                        <a href="{{url('/talent/add')}}" class="btn btn-sm border-radius-30 margin-tb-10px text-white background-second-color  box-shadow float-right padding-lr-20px margin-left-30px">
                          <i class="fas fa-plus-circle"></i>Talent
                        </a>
                        @endif
                        @if(!auth()->guard('admin')->user()&&!auth()->guard('user')->user())
                        <a href="{{url('/user/login')}}" class="margin-tb-20px d-inline-block text-up-small float-left float-lg-right"><i class="far fa-user"></i>  Login</a>
                        @endif
                    </div>
                </div>
           
            </div>
    </header>