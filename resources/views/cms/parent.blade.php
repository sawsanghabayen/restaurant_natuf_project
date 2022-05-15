<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Resturant | @yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('cms/plugins/fontawesome-free/css/all.min.css')}}">
  <script src="https://kit.fontawesome.com/0866ae2c30.js" crossorigin="anonymous"></script>

  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('cms/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{asset('cms/plugins/toastr/toastr.min.css')}}">

  @yield('styles')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('dashboards.index')}}" class="nav-link">Home</a>
      </li>
      
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-comments"></i>
          <span class="badge badge-danger navbar-badge">{{Auth()->user()->notifications()->where('type','=','App\Notifications\NewMessageNotification')->where('read_at','!=','null')->count()}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <!-- Message Start -->
          @foreach (Auth()->user()->notifications()->where('type','=','App\Notifications\NewMessageNotification')->get() as $notificationContact)
          {{-- <a href="#" class="dropdown-item"> --}}
          <a href="{{route('notificationscontact.show',$notificationContact->id)}}" class="dropdown-item">
            <div class="media">
              <img src="{{asset('front/images/avatar1.png')}}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 style="font-weight: bold;" class="dropdown-item-title">
                  {{$notificationContact->data['name']}}
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <h3  style="font-weight: bold;" class="dropdown-item-title">
                  Subject:
                </h3>
                <h3 class="dropdown-item-title">
                  {{$notificationContact->data['subject']}}
                </h3>
                <h3  style="font-weight: bold;" class="dropdown-item-title">
                  Message:
                </h3>
                <p class="text-sm">{{$notificationContact->data['message']}}</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{$notificationContact->created_at->diffForHumans()}}</p>
              </div>
            </div>
            @endforeach
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
          
    
          <a href="{{route('notificationscontact.index')}}" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-bell"></i>
          <span class="badge badge-warning navbar-badge">{{Auth()->user()->notifications()->where('type','=','App\Notifications\NewOrderNotification')->where('read_at','!=','null')->count()}}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          @foreach (Auth()->user()->notifications()->where('type','=','App\Notifications\NewOrderNotification')->get() as $notificationOrder)
          <a href="#" class="dropdown-item">
           <a href="#" class="dropdown-item"> 
           <a href="{{route('notificationsorder.show',$notificationOrder->id)}}" class="dropdown-item">
            <div class="media">
              <div class="media-body">
                <h3 style="font-weight: bold;" class="dropdown-item-title">
                  Order #:{{$notificationOrder->data['order_id']}}
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>

                <h3 class="dropdown-item-title">
                  Name:{{$notificationOrder->data['fname']}} {{$notificationOrder->data['lname']}}
                </h3>
                <p class="text-sm">Total Price: {{$notificationOrder->data['total']}}$</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i>Date:{{$notificationOrder->data['date']}}</p>
              </div>
            </div>
            @endforeach
          <div class="dropdown-divider"></div>
          <a href="{{route('admin.orders')}}" class="dropdown-item dropdown-footer">See All Orders</a>
        </div>
      </li> 
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
     
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
  

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->


      <li class="dropdown">
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('cms/dist/img/user4-128x128.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{auth()->user()->name}}</a>
          <ul class="dropdown-menu">
            <li><a href="#"><i class="fa fa-user-o"></i> Profile</a></li>
            <li><a href="#"><i class="fa fa-calendar-o"></i> Calendar</a></li>
            <li><a href="#"><i class="fa fa-sliders"></i> Settings</a></li>
            <li class="divider"></li>
            <li><a href="#"><i class="material-icons">&#xE8AC;</i> Logout</a></li>
          </ul>
        </div>
      </div>
    </li>
      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Starter Pages
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

            <ul class="nav nav-treeview">
              @canany(['Create-Admin','Read-Users','Read-Admins'])
                <li class="nav-header">{{__('cms.hr')}}</li>
                @canany(['Create-Admin','Read-Admins'])
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon far fa-envelope"></i>

                    <p>
                      {{__('cms.admins')}}
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview" style="display: none;">
                   
                    <li class="nav-item">
                      <a href="{{route('admins.index')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{__('cms.index')}}</p>
                      </a>
                    </li>
                  
                    <li class="nav-item">
                      <a href="{{route('admins.create')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{__('cms.create')}}</p>
                      </a>
                    </li>
                   
                  </ul>
                </li>
                @endcanany
                @can(['Read-Users'])
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon far fa-envelope"></i>
                    <p>
                      {{__('cms.users')}}
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview" style="display: none;">
                   
                    <li class="nav-item">
                      <a href="{{route('users.index')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>{{__('cms.index')}}</p>
                      </a>
                    </li>
                  </ul>
                </li>
                @endcan
       
              @endcanany

             @canany(['Create-Category','Create-SubCategory','Create-Meal','Read-Categories','Read-SubCategories','Read-Meals'])

              <li class="nav-header">{{__('cms.content_management')}}</li>

                       {{-- @can(['Read-Contacts']) --}}
                       <li class="nav-item">
                        <a href="#" class="nav-link">
                          <i class="nav-icon far fa-envelope"></i>
                          <p>
                            {{__('cms.contacts')}}
                            <i class="fas fa-angle-left right"></i>
                          </p>
                        </a>
                        <ul class="nav nav-treeview" style="display: none;">
                         
                          <li class="nav-item">
                            <a href="{{route('notificationscontact.index')}}" class="nav-link">
                              <i class="far fa-circle nav-icon"></i>
                              <p>{{__('cms.index')}}</p>
                            </a>
                          </li>
                        </ul>
                      </li>
                      {{-- @endcan --}}
              @canany(['Create-Category','Read-Categories'])
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon far fa-envelope"></i>
                  <p>
                    {{__('cms.categories')}}
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
               

                <ul class="nav nav-treeview" style="display: none;">
                  <li class="nav-item">
                    <a href="{{route('categories.index')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>{{__('cms.index')}}</p>
                    </a>
                  </li>
                 
                  <li class="nav-item">
                    <a href="{{route('categories.create')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>{{__('cms.create')}}</p>
                    </a>
                  </li>
                  
                </ul>
              </li>
              @endcanany
              @canany(['Create-SubCategory','Read-SubCategories'])

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon far fa-envelope"></i>
                  <p>
                    {{__('cms.sub_categories')}}
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                  <li class="nav-item">
                    <a href="{{route('subCategories.index')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>{{__('cms.index')}}</p>
                    </a>
                  </li>
                 
                  <li class="nav-item">
                    <a href="{{route('subCategories.create')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>{{__('cms.create')}}</p>
                    </a>
                  </li>
                  
                </ul>
              </li>
              @endcanany
              @canany(['Create-Meal','Read-Meals'])

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon far fa-envelope"></i>
                  <p>
                    {{__('cms.meals')}}
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                  <li class="nav-item">
                    <a href="{{route('meals.index')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>{{__('cms.index')}}</p>
                    </a>
                  </li>
                 
                  <li class="nav-item">
                    <a href="{{route('meals.create')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>{{__('cms.create')}}</p>
                    </a>
                  </li>
                  
                </ul>
              </li>
              @endcanany

              {{-- @canany(['Create-Meal','Read-Meals']) --}}

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon far fa-envelope"></i>
                  <p>
                    {{__('cms.orders')}}
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview" style="display: none;">
                  <li class="nav-item">
                    <a href="{{route('admin.orders')}}" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>{{__('cms.index')}}</p>
                    </a>
                  </li>
                </ul>
              </li>
              {{-- @endcanany --}}
              @endcanany
              

              <li class="nav-header">{{__('cms.settings')}}</li>
              <li class="nav-item">
                <a href="{{route('password.edit')}}" class="nav-link">
                  <i class="nav-icon far fa-circle text-danger"></i>
                  <p class="text">{{__('cms.edit_password')}}</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link"  href="{{route('cms.logout')}}" role="button">
                  <i class="fa-solid fa-right-from-bracket"></i>
                  <p class="text">{{__('cms.logout')}}</p>
                </a>
              </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Simple Link
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">@yield('page_lg')</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              {{-- <a href="#">@yield('main_page_md')</a> --}}
              <li class="breadcrumb-item">@yield('main_page_md')</li>
              <li class="breadcrumb-item active">@yield('page_sm')</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
@yield('content')

    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2022 <a href="https://adminlte.io">Sawsan Restaurant</a>.</strong> All rights reserved.
  </footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('cms/plugins/jquery/jquery.min.js')}}"></script>
<script src="{{asset('cms/dist/js/demo.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('cms/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('cms/dist/js/adminlte.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="{{asset('cms/plugins/toastr/toastr.min.js')}}"></script>
@yield('scripts')
</body>
</html>
