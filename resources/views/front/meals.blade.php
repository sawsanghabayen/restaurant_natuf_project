@extends('front.parent')

@section('title',__('front.subcategories'))
@section('styles')
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
</style>

@endsection
@section('content')


<section class="dishes" id="dishes">
    <h3 class="sub-heading"> Our Meals </h3>
    <div class="box-container">
        @foreach ($meals as $meal)
        <div class="box">
            <a href="{{Route('favorites.store',['meal_id'=>$meal->id])}}" 
               
          @if($meal->is_favorite)
          style="background: var(--green);
              color: #fff;
              text-decoration: none;"
          @endif  class="fas fa-heart"></a>
            <img src="{{Storage::url($meal->image ?? '')}}" alt="">
            <h3>{{$meal->title}}</h3>
            <p>{{$meal->description}}</p>
            <span>{{$meal->price}}</span>
            @if(Auth::guard('user')->check())
            <a  onclick="performCartStore({{$meal->id }} ,{{$meal->price}})" class="btn">add to cart</a>
            @else
            <a href="{{route('cms.login','user')}}"  class="btn"class="btn">add to cart</a>
            @endif
        </div>
        
        @endforeach
        {{$meals->links()}}
        
    </section>
@endsection

<!-- menu section ends -->

<!-- review section starts  -->

<!-- review section ends -->


<!-- order section ends -->

<!-- footer section starts  -->
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
  @endsection