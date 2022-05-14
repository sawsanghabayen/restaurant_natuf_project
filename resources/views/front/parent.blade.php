<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sawsan Resturant |@yield('title')</title>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="{{asset('cms/plugins/toastr/toastr.min.css')}}">


    <!-- custom css file link  -->
    <link rel="stylesheet" href="{{asset('front/css/style.css')}}">
    <style>
        .dropbtn {
  display: inline-block;
  color: white;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
}

a:hover, .dropdown:hover .dropbtn {
  background-color: #27ae60;
  transition: all 0.5s;

}

li.dropdown {
  display: inline-block;
}
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {background-color: #f1f1f1;}

.dropdown:hover .dropdown-content {
  display: block;
}
    </style>
    
    @yield('styles')
</head>
<body>
    
<!-- header section starts      -->

<header>
    <a href="#" class="logo"><i class="fas fa-utensils"></i>{{$resturants[0]->rest_name}}</a>
    <a href="#" class="logo"><i class="fas fa-utensils"></i></a>

    <nav class="navbar">
        <a href="{{route('resturants.index')}}">home</a>
        <a href="{{route('restmeals.index')}}">meals</a>
        <a href="{{route('restcategories.index')}}">menu</a>
        <a href="#about">about</a>
        <a href="#order">review</a>
        <a href="#order">contact us</a>
    </nav>
 
     
    <nav class="navbar">
        @if(Auth::guard('user')->check())
        <li class="nav-item dropdown">
            <a href="javascript:void(0)" class="dropbtn">{{Auth::guard('user')->user()->first_name}} {{Auth::guard('user')->user()->last_name}}</a></a>
            <div class="dropdown-content">
              <a href="{{route('users.edit',Auth::guard('user')->user()->id)}}" >
                <i class="fa-solid fa-right-from-bracket"></i> Profile Info
              </a> 
             <a href="{{route('password.edit')}}" >
                <i class="fa-solid fa-right-from-bracket"></i> Change Password
              </a> 
              <a href="{{route('user.orders')}}">
                <i class="fas fa-shopping-cart"></i> My Order
              </a> 
             <a href="{{route('cms.logoutuser')}}" >
                <i class="fa-solid fa-right-from-bracket"></i> Logout
              </a> 
            </div>
          </li>
     
        {{-- <a href="{{route('users.edit',Auth::guard('user')->user()->id)}}">{{Auth::guard('user')->user()->first_name}} {{Auth::guard('user')->user()->last_name}}</a> --}}
        <a class="nav-link" href="{{route('carts.index')}}"><i class="fas fa-shopping-cart"></i>
          Cart</a>
        <a href="{{route('favorites.index')}}" class="fas fa-heart"></a>
        

        
        @else
        <a href="{{route('cms.login','user')}}">sign in</a>
        <a href="{{route('cms.register')}}">sign up</a>
        @endif
      </nav>
      {{-- <div class="icons">
        <i class="fas fa-search" id="search-icon"></i>
     </div>  --}}
</header>


<section class="home" id="home">

    <div class="swiper-container home-slider">

        <div class="swiper-wrapper wrapper">
            @foreach ($latestmeals as $latestmeal )
                
            
            <div class="swiper-slide slide">
                <div class="content">
                    <span>Latest Meals</span>
                    {{-- <span>Latest Meals</span> --}}
                    <h3>{{$latestmeal->title}}</h3>
                    <p>{{$latestmeal->description}}</p>
                    <a href="#" class="btn">order now</a>
                </div>
                <div class="image">
                    <img style="width:300px;  border-radius: 50%;" src="{{Storage::url($latestmeal->image ?? '')}}" alt="">
                    {{-- <img src="{{$latestmeal->imge}}" alt=""> --}}
                </div>
            </div>
            
            @endforeach
        </div>
        
        
        {{-- <div  class="swiper-pagination"></div> --}}

    </div>

</section>

<!-- home section ends -->













{{-- @endforeach --}}

@yield('content')

<section class="footer">

    <div class="box-container">

        <div class="box">
            <h3>locations</h3>
            <a href="#">{{$resturants[0]->address}}</a>
        </div>

        <div class="box">
            <h3>quick links</h3>
            <a href="#">home</a>
            <a href="#">meals</a>
            <a href="#">about</a>
            <a href="#">menu</a>
            <a href="#">reivew</a>
            <a href="#">order</a>
        </div>
            <div class="box">
            <h3>contact info</h3>
            <a href="#">{{$resturants[0]->mobile}}</a>
            <a href="#">{{$resturants[0]->telephone}}</a>
            <a href="#">{{$resturants[0]->email}}</a>
            
        </div>

        <div class="box">
            <h3>follow us</h3>
            <a href="#">facebook</a>
            <a href="#">twitter</a>
            <a href="#">instagram</a>
            <a href="#">linkedin</a>
        </div>

    </div>

    <div class="credit"> copyright @ 2022 by <span>{{$resturants[0]->rest_name}} </span> </div>

</section>

<!-- footer section ends -->

<script src="{{asset('cms/plugins/jquery/jquery.min.js')}}"></script>

<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('cms/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('cms/plugins/toastr/toastr.min.js')}}"></script>


<!-- custom js file link  -->
<script src="{{asset('front/js/script.js')}}"></script>
<script>
function performCartStore(id ,mealprice ) {
  axios.post('/rest/carts',{
        meal_id:  id,
        quantity :1,
        price:mealprice,

  })
  .then(function (response) {
      console.log(response);
      toastr.success(response.data.message);
      // window.location.href = '/rest/index';
  })
  .catch(function (error) {
      console.log(error.response);
      toastr.error(error.response.data.message);
  });
}
</script>
@yield('scripts')

</body>
</html>