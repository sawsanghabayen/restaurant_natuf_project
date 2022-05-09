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



<section class="menu" id="menu">

    <h3 class="sub-heading"> our SubCategories </h3>
    <h1 class="heading"> today's speciality </h1>

    <div class="box-container">
        @foreach ($subCategories as $subCategory)
        <div class="box">
            <div class="image">
              <img  src="{{Storage::url($subCategory->image ?? '')}}" />
            </div>
            <div class="content">
               
                <h3>{{$subCategory->title}}</h3>
                <a href="{{route('restmeals.index',['id'=>$subCategory->id])}}" class="btn">Show Meals...</a>
                {{-- <a href="{{route('meals.index',['id' => $subCategory->id])}}" class="btn">Show Meals...</a> --}}
            </div>
        </div>
        @endforeach
        {{$subCategories->links()}}
      
    </div>

</section>
@endsection

<!-- menu section ends -->

<!-- review section starts  -->

<!-- review section ends -->


<!-- order section ends -->

<!-- footer section starts  -->
@section('scripts')