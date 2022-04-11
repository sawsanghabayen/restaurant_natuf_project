<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <title>Restaurant Meals</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('front/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
<!--

TemplateMo 546 Sixteen Clothing

https://templatemo.com/tm-546-sixteen-clothing

-->

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{asset('front/assets/css/fontawesome.css')}}">
    <link rel="stylesheet" href="{{asset('front/assets/css/templatemo-sixteen.css')}}">
    <link rel="stylesheet" href="{{asset('front/assets/css/owl.css')}}">
    @yield('styles')

  </head>

  <body>
 

    <!-- ***** Preloader Start ***** 
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  -->
    <!-- ***** Preloader End ***** -->


    <!-- Header -->
    <header class="">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="index.html"><h2>Restaurant <em>Meals</em></h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
                <a class="nav-link" href="index.html">Home
                  <span class="sr-only">(current)</span>
                </a>
              </li> 
              <li class="nav-item">
                <a class="nav-link" href="products.html">Our Meals</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.html">About Us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.html">Contact Us</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <!-- Page Content -->
    <!-- Banner Starts Here -->
    <div class="banner header-text">
      <div class="owl-banner owl-carousel">
        <div class="banner-item-01">
          <div class="text-content">
            
            <h2>Best Meals</h2>
          </div>
        </div>
        <div class="banner-item-02">
          <div class="text-content">
            <h4>Flash Deals</h4>
            <h2>Get your best products</h2>
          </div>
        </div>
        <div class="banner-item-03">
          <div class="text-content">
            <h4>Last Minute</h4>
            <h2>Grab last minute deals</h2>
          </div>
        </div>
      </div>
    </div>
    @yield('content')
    <footer class="footer-48201">
      
        <div class="container">
          <div class="row">
            <div class="col-md-4 pr-md-5">
              <a href="#" class="footer-site-logo d-block mb-4">RESTAURANT MEALS</a>
              <p style="font-size: 14px; 	color: gray;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Eligendi quasi perferendis ratione perspiciatis accusantium.</p>
            </div>
            <div class="col-md">
              <ul class="list-unstyled nav-links">
                <li><a href="index.html">Home</a></li>
                <li><a href="about.html">About Us</a></li>
                
                <li><a href="products.html">Our Meals</a></li>
               
               
              </ul>
            </div>
            <div class="col-md">
              <ul class="list-unstyled nav-links">
                <li><a href="#">Sign in</a></li>
                <li><a href="#">Sign up</a></li>
                <li><a href="contact.html">Contact</a></li>
                
              </ul>
            </div>
            <div class="col-md">
              <ul class="list-unstyled nav-links">
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms &amp; Conditions</a></li>
                <li><a href="#">Partners</a></li>
              </ul>
            </div>
            <div class="col-md text-md-center">
              <p class=""><a href="contact.html" class="btn btn-tertiary">Contact Us</a></p>
            </div>
          </div> 
  
          <div class="row ">
            <div class="col-12 text-center">
              <div class="copyright mt-5 pt-5">
                <p><small>&copy; 2022-2023 All Rights Reserved.</small></p>
              </div>
            </div>
          </div> 
        </div>
        
      </footer>
  
      <!-- loader part  -->
    <div class="loader-container">
      <img src="{{asset('front/assets/images/loader.gif')}}" alt="">
    </div>
  
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
  
  
      <!-- Bootstrap core JavaScript -->
      <script src="{{asset('front/vendor/jquery/jquery.min.js')}}"></script>
      <script src="{{asset('front/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  
  
      <!-- Additional Scripts -->
      <script src="{{asset('front/assets/js/custom.js')}}"></script>
      <script src="{{asset('front/assets/js/owl.js')}}"></script>
      <script src="{{asset('front/assets/js/slick.js')}}"></script>
      <script src="{{asset('front/assets/js/isotope.js')}}"></script>
      <script src="{{asset('front/assets/js/accordions.js')}}"></script>
      <script src="{{asset('front/assets/js/script.js')}}"></script>
      @yield('scripts')
  
  
      <script language = "text/Javascript"> 
        cleared[0] = cleared[1] = cleared[2] = 0; //set a cleared flag for each field
        function clearField(t){                   //declaring the array outside of the
        if(! cleared[t.id]){                      // function makes it static and global
            cleared[t.id] = 1;  // you could use true and false, but that's more typing
            t.value='';         // with more chance of typos
            t.style.color='#fff';
            }
        }
      </script>
  
  
    </body>
  
  </html>
  