<section class="banner padding-tb-200px sm-ptb-80px background-overlay" style=" height: 400px; background-image: url('/assets/img/banner_3.jpg');">
        <div class="container z-index-2 position-relative">
            <div class="title text-center" >
                <h1 class="text-title-large text-main-color font-weight-300 margin-bottom-15px" >Talent kids website</h1>
                
            </div>
            <div class="row justify-content-center margin-tb-20px">
                <div class="col-lg-8">
                    <div class="listing-search">
                        <form class="row no-gutters" id="search_form" method="post" action="{{url('/talents/search')}}">
                            {{csrf_field()}}
                            <div class="col-md-3">
                                <div class="keywords">
                                    <input class="listing-form first" name="title" type="text" placeholder="Keywords..." value="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="regions">
                                    <input class="listing-form" type="text" name="country" placeholder="All Regions" value="">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <input  type="hidden" id="tcat" name="cat_id" value="0">
                                <div class="categories dropdown">
                                            <a class="listing-form d-block text-nowrap" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">All Categories</a>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                                 @foreach(App\Category::all() as $cat)
                                                  <button class="dropdown-item text-up-small" onclick="document.getElementById('dropdownMenu2').innerHTML='{{$cat->name}}';
                                                document.getElementById('tcat').value='{{$cat->id}}';" type="button">{{$cat->name}}</button>
                                                @endforeach
                                               
                                                
                                                
                                            </div>
                                        </div>
                            </div>
                            <div class="col-md-3">
                                <a onclick="document.getElementById('search_form').submit();" class="listing-bottom background-second-color box-shadow" href="#">Search Now</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </section>