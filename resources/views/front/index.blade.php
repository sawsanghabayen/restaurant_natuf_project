
<!-- header section starts      -->
@extends('front.parent')

@section('title',__('front.home'))
{{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}

@section('styles')
<link rel="stylesheet" href="{{asset('cms/plugins/toastr/toastr.min.css')}}">

<style>

small, .small {
  font-size: 15px;
}
.text-muted {
  color: #6c757d !important;
}

.pagination {
  display: flex;
  padding-left: 0;
  list-style: none;
  font-size: 15px;  
}
.page-item:not(:first-child) .page-link {
  margin-left: -1px;
}
.page-item.active .page-link {
  z-index: 3;
  color: #fff;
  background-color: #27ae60;
  border-color: #27ae60;
}
.page-item.disabled .page-link {
  color: #6c757d;
  pointer-events: none;
  background-color: #fff;
  border-color: #dee2e6;
}

.page-link {
  padding: 8px 16px;;
}

.page-item:first-child .page-link {
  border-top-left-radius: 0.25rem;
  border-bottom-left-radius: 0.25rem;
}
.page-item:last-child .page-link {
  border-top-right-radius: 0.25rem;
  border-bottom-right-radius: 0.25rem;
}
.page-link {
  position: relative;
  display: block;
  color: rgba(8, 7, 7, 0.904);
  text-decoration: none;
  background-color: #fff;
  border: 1px solid #dee2e6;
  transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}
@media (prefers-reduced-motion: reduce) {
  .page-link {
    transition: none;
  }
}
.page-link:hover {
  z-index: 2;
  color: #fff;
  background-color: #27ae60;
  border-color: #dee2e6;
}
.page-link:focus {
  z-index: 3;
  color: #27ae60;
  background-color: #27ae60;
  outline: 0;
  box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
}

.pagination-lg .page-link {
  padding: 0.75rem 1.5rem;
  font-size: 1.25rem;
}
.pagination-lg .page-item:first-child .page-link {
  border-top-left-radius: 0.3rem;
  border-bottom-left-radius: 0.3rem;
}
.pagination-lg .page-item:last-child .page-link {
  border-top-right-radius: 0.3rem;
  border-bottom-right-radius: 0.3rem;
}

.pagination-sm .page-link {
  padding: 0.25rem 0.5rem;
  font-size: 0.875rem;
}
.pagination-sm .page-item:first-child .page-link {
  border-top-left-radius: 0.2rem;
  border-bottom-left-radius: 0.2rem;
}
.pagination-sm .page-item:last-child .page-link {
  border-top-right-radius: 0.2rem;
  border-bottom-right-radius: 0.2rem;
}
/* Style the form - display items horizontally */
/* .form-inline button {
  padding: 10px 20px;
  background-color: dodgerblue;
  border: 1px solid #ddd;
  color: white;
}

.form-inline button:hover {
  background-color: royalblue;
} */

/* Add responsiveness - display the form controls vertically instead of horizontally on screens that are less than 800px wide */
/* @media (max-width: 800px) {
  .form-inline input {
    margin: 10px 0;
  }

  .form-inline {
    flex-direction: column;
    align-items: stretch;
  } */
/* } */

/* search */

</style>


@endsection
@section('content')

<!-- home section ends -->

<!-- dishes section starts  -->

<section class="dishes" id="dishes">
<!-- Load icon library -->

<!-- The form -->
<h3 class="sub-heading"> Our Meals </h3>
<form class="example" action="{{route('resturants.index')}}" method="get">
  <input type="text" placeholder="Search.." name="name">
  <button type="submit"><i class="fa fa-search"></i></button>
</form>


    <a href="{{route('restmeals.index')}}" class="btn">Show More...</a>
    
    <div class="box-container">
      @foreach ($meals as $meal)
      <div class="box">
        @if(Auth::guard('user')->check())
        <a href="#" onclick="performFavoriteStore({{$meal->id}})"   class="fas fa-heart" 
          @if($meal->is_favorite)
          style="background: var(--green);
              color: #fff;
              text-decoration: none;"
          @endif  
         >
        </a>
        @else
        <a href="{{route('cms.login','user')}}"    class="fas fa-heart" ></a>
        @endif


          <img  src="{{Storage::url($meal->image ?? '')}}" />

            {{-- <img src="{{$meal->image}}" alt=""> --}}
            {{-- <img src="{{asset('front/images/dish-4.png')}}" alt=""> --}}
            <h3>{{$meal->title}}</h3>
            <p>{{$meal->description}}</p>
            <span>{{$meal->price}} $</span>
            {{-- <a href="#" class="btn">add to cart</a> --}}
        </div>
        
        @endforeach
        {{$meals->links()}}
    </section>

<!-- dishes section ends -->

<!-- about section starts  -->

<section class="about" id="about">

    <h3 class="sub-heading"> about us </h3>
    <h1 class="heading"> why choose us? </h1>

    <div class="row">

        <div class="image">
            <img src="{{asset('front/images/rest.jpg')}}" alt="">
        </div>

        <div class="content">
            <h3>best food in the country</h3>
            {{-- <p>{{$resturants->description}}</p> --}}
            <div class="icons-container">
                <div class="icons">
                    <i class="fas fa-shipping-fast"></i>
                    <span>free delivery</span>
                </div>
                <div class="icons">
                    <i class="fas fa-dollar-sign"></i>
                    <span>easy payments</span>
                </div>
                <div class="icons">
                    <i class="fas fa-headset"></i>
                    <span>24/7 service</span>
                </div>
            </div>
            <a href="#" class="btn">learn more</a>
        </div>

    </div>

</section>

<!-- about section ends -->

<!-- menu section starts  -->

<section class="dishes" id="dishes">

    <h3 class="sub-heading"> Our Menu </h3>
    
    {{-- <a href="{{route('rest.categories')}}" class="btn">Show More...</a> --}}
    
    <div class="box-container">
        @foreach ($categories as $category)
        <div class="box">
            {{-- <a href="#" class="fas fa-eye"></a> --}}
            {{-- <img src="{{$meal->image}}" alt=""> --}}
            <img  src="{{Storage::url($category->image ?? '')}}" />
            <h3>{{$category->name}}</h3>
            <p>{{$category->description}}</p>
             <a href="{{route('restsubcategories.index',['id'=>$category->id])}}"  class="btn">Show more subCategories...</a>
        </div>
        
        @endforeach
        {{$categories->links()}}
    </section>





<!-- menu section ends -->

<!-- review section starts  -->
<section class="review" id="review">

    <h3 class="sub-heading"> customer's review </h3>
    <h1 class="heading"> what they say </h1>

    <div class="swiper-container review-slider">

        <div class="swiper-wrapper">
          @foreach ($comments as $comment )
            
          
            <div class="swiper-slide slide">
                <i class="fas fa-quote-right"></i>
                <div class="user">
                    <img src="{{asset('front/images/avatar1.png')}}" alt="">
                    <div class="user-info">
                        <h3>{{$comment->first_name}} {{$comment->last_name}}</h3>
                    </div>
                </div>
                <p>{{$comment->comment}}</p>
            </div>
            @endforeach

          

        </div>

    </div>
    
</section>



<section class="order" id="order">

    <h3 class="sub-heading"> rate us  </h3>
    <h1 class="heading"> your opinion matters  </h1>

    <form id="review-form">

        <div class="inputBox">
            <div class="input">
                <span>your first name</span>
                <input type="text" placeholder="enter your name" id="first_name">
            </div>
            <div class="input">
                <span>your last name</span>
                <input type="text" placeholder="enter your name" id="last_name">
            </div>
            <div class="input">
                <span>your comment</span>
                <textarea id="comment" rows="4" cols="50"></textarea>
            </div>
        
        </div>

        <input type="submit" onclick="performStore()" value="comment" class="btn">

    </form>

</section>

{{-- Contact Us --}}
  <section class="order" id="order">

    <h3 class="sub-heading"> contact us  </h3>
    <h1 class="heading"> keep in touch  </h1>

    <form id="contact-form">

        <div class="inputBox">
            <div class="input">
                <span>your name</span>
                <input type="text" placeholder="enter your name" id="name">
            </div>
            <div class="input">
                <span>your email</span>
                <input type="email" placeholder="enter your email" id="email">
            </div>
            <div class="input">
                <span>mobile</span>
                <input type="text" placeholder="enter your mobile" id="mobile">
            </div>
            <div class="input">
              <span>subject</span>
              <input type="text" placeholder="enter your subject" id="subject">
          </div>
            <div class="input">
                <span>your message</span>
                <textarea id="message" rows="4" cols="50"></textarea>
            </div>
        
        </div>

        <input type="submit" onclick="performStoreContact()" value="contact" class="btn">

    </form>

</section>
</section>
@endsection

@section('scripts')

  <!-- jQuery -->
  <script src="{{asset('cms/plugins/jquery/jquery.min.js')}}"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('cms/dist/js/adminlte.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://unpkg.com/axios@0.27.2/dist/axios.min.js"></script>
<script src="{{asset('cms/plugins/toastr/toastr.min.js')}}"></script>


<script>



  function performDelete(id) {
        
        axios.delete('/rest/favorites/'+id)
        .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            window.location.href = '/rest/index';
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });
    }
    
    function performFavoriteStore(id) {
        axios.post('/rest/favorites',{
              meal_id:  id,
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

  
      function performStore() {
        axios.post('/rest/comments', {
            first_name: document.getElementById('first_name').value,
            last_name: document.getElementById('last_name').value,
            comment: document.getElementById('comment').value,
        })
        .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            document.getElementById('review-form').reset();

            window.location.href = '/rest/index';
        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });
    }

    function performStoreContact() {
      axios.post('/rest/contacts', {
            name: document.getElementById('name').value,
            email: document.getElementById('email').value,
            mobile: document.getElementById('mobile').value,
            subject: document.getElementById('subject').value,
            message: document.getElementById('message').value,

        })
      .then(function (response) {
            console.log(response);
            toastr.success(response.data.message);
            document.getElementById('contact-form').reset();
            // window.location.href = '/rest/home';

        })
        .catch(function (error) {
            console.log(error.response);
            toastr.error(error.response.data.message);
        });

    }
 </script>


@endsection


<!-- order section ends -->

<!-- footer section starts  -->

<!-- footer section ends -->

















