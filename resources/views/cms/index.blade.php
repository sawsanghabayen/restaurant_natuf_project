@extends('cms.parent')
@section('title',__('cms.dashboard'))
@section('page_lg',__('cms.dashboard'))
@section('main_page_md')
<a href="{{route('dashboards.index')}}">Home</a>
@endsection
@section('page_sm',__('cms.dashboard'))
@section('styles')

     <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endsection
@section('content')
 <!-- Main content -->
 <section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{$orders_count}}</h3>
            <p>Number Orders</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="{{route('admin.orders')}}" class="small-box-footer">More info<i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{$admins_count}}</h3>
            <p>Admins Count</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="{{route('admins.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{$users_count}}</h3>

            <p>User Registrations</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="{{route('users.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>

      {{-- <div class="row">
        @foreach($favorites as $favorite)
        <div   class="col-12 col-sm-6 ">
          <div style="width: 70%;" class="info-box mb-3">
          <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>
          <div class="info-box-content">
          <span class="info-box-text"># Of Users Favorite {{$favorite->meal->title}}</span>
          <span class="info-box-number">{{$favorite->user_count}}</span>
          </div>
          </div>
          </div>
          @endforeach
          @foreach($meals as $meal)
          @if(!$meal->is_favorite)
          <div   class="col-12 col-sm-6 ">
            <div style="width: 70%;" class="info-box mb-3">
            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-thumbs-up"></i></span>
            <div class="info-box-content">
            <span class="info-box-text"># Of Users Favorite {{$meal->title}}</span>
            <span class="info-box-number">{{0}}</span>
            </div>
            </div>
            </div>
            @endif
    
          @endforeach
        </div>  --}}
</section>
     
     
    <!-- /.row -->
    <!-- Main row -->


 
    
    
      {{-- <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            <!-- AREA CHART -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Area Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- DONUT CHART -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Donut Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="donutChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <!-- PIE CHART -->
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Pie Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col (LEFT) -->
          <div class="col-md-6">
            <!-- LINE CHART -->
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Line Chart</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

         

            <!-- STACKED BAR CHART -->
    
            <!-- /.card -->

          </div>
          <!-- /.col (RIGHT) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
  
    </section>
    <!-- /.content -->
    {{--  --}}
 


@endsection
@section('scripts')
{{-- <script src="{{asset('cms/plugins/chart.js/Chart.min.js')}}"></script> --}}
<script src="{{asset('cms/plugins/jquery/jquery.min.js')}}"></script>

<script>
//  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
  //   var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

  //   var areaChartData = {
  //     labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
  //     datasets: [
  //       {
  //         label               : 'Digital Goods',
  //         backgroundColor     : 'rgba(60,141,188,0.9)',
  //         borderColor         : 'rgba(60,141,188,0.8)',
  //         pointRadius          : false,
  //         pointColor          : '#3b8bba',
  //         pointStrokeColor    : 'rgba(60,141,188,1)',
  //         pointHighlightFill  : '#fff',
  //         pointHighlightStroke: 'rgba(60,141,188,1)',
  //         data                : [28, 48, 40, 19, 86, 27, 90]
  //       },
  //       {
  //         label               : 'Electronics',
  //         backgroundColor     : 'rgba(210, 214, 222, 1)',
  //         borderColor         : 'rgba(210, 214, 222, 1)',
  //         pointRadius         : false,
  //         pointColor          : 'rgba(210, 214, 222, 1)',
  //         pointStrokeColor    : '#c1c7d1',
  //         pointHighlightFill  : '#fff',
  //         pointHighlightStroke: 'rgba(220,220,220,1)',
  //         data                : [65, 59, 80, 81, 56, 55, 40]
  //       },
  //     ]
  //   }

  //   var areaChartOptions = {
  //     maintainAspectRatio : false,
  //     responsive : true,
  //     legend: {
  //       display: false
  //     },
  //     scales: {
  //       xAxes: [{
  //         gridLines : {
  //           display : false,
  //         }
  //       }],
  //       yAxes: [{
  //         gridLines : {
  //           display : false,
  //         }
  //       }]
  //     }
  //   }

  //   // This will get the first returned node in the jQuery collection.
  //   new Chart(areaChartCanvas, {
  //     type: 'line',
  //     data: areaChartData,
  //     options: areaChartOptions
  //   })

  //   //-------------
  //   //- LINE CHART -
  //   //--------------
  //   var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
  //   var lineChartOptions = $.extend(true, {}, areaChartOptions)
  //   var lineChartData = $.extend(true, {}, areaChartData)
  //   lineChartData.datasets[0].fill = false;
  //   lineChartData.datasets[1].fill = false;
  //   lineChartOptions.datasetFill = false

  //   var lineChart = new Chart(lineChartCanvas, {
  //     type: 'line',
  //     data: lineChartData,
  //     options: lineChartOptions
  //   })

  //   //-------------
  //   //- DONUT CHART -
  //   //-------------
  //   // Get context with jQuery - using jQuery's .get() method.
  //   var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
  //   var donutData        = {
      
  //     labels:   $mealsname,

  //     // [
  //     //     'Chrome',
  //     //     'IE',
  //     //     'FireFox',
  //     //     'Safari',
  //     //     'Opera',
  //     //     'Navigator',
  //     // ]
      
  //     datasets: [
  //       {
  //         data: $userfavmeal_count,
  //         backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
  //       }
  //     ]
  //   }
  //   var donutOptions     = {
  //     maintainAspectRatio : false,
  //     responsive : true,
  //   }
  //   //Create pie or douhnut chart
  //   // You can switch between pie and douhnut using the method below.
  //   new Chart(donutChartCanvas, {
  //     type: 'doughnut',
  //     data: donutData,
  //     options: donutOptions
  //   })

  //   //-------------
  //   //- PIE CHART -
  //   //-------------
  //   // Get context with jQuery - using jQuery's .get() method.
  //   var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
  //   var pieData        = donutData;
  //   var pieOptions     = {
  //     maintainAspectRatio : false,
  //     responsive : true,
  //   }
  //   //Create pie or douhnut chart
  //   // You can switch between pie and douhnut using the method below.
  //   new Chart(pieChartCanvas, {
  //     type: 'pie',
  //     data: pieData,
  //     options: pieOptions
  //   })

  //   //-------------
  //   //- BAR CHART -
  //   //-------------
  //   var barChartCanvas = $('#barChart').get(0).getContext('2d')
  //   var barChartData = $.extend(true, {}, areaChartData)
  //   var temp0 = areaChartData.datasets[0]
  //   var temp1 = areaChartData.datasets[1]
  //   barChartData.datasets[0] = temp1
  //   barChartData.datasets[1] = temp0

  //   var barChartOptions = {
  //     responsive              : true,
  //     maintainAspectRatio     : false,
  //     datasetFill             : false
  //   }

  //   new Chart(barChartCanvas, {
  //     type: 'bar',
  //     data: barChartData,
  //     options: barChartOptions
  //   })

  //   //---------------------
  //   //- STACKED BAR CHART -
  //   //---------------------
  //   var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
  //   var stackedBarChartData = $.extend(true, {}, barChartData)

  //   var stackedBarChartOptions = {
  //     responsive              : true,
  //     maintainAspectRatio     : false,
  //     scales: {
  //       xAxes: [{
  //         stacked: true,
  //       }],
  //       yAxes: [{
  //         stacked: true
  //       }]
  //     }
  //   }

  //   new Chart(stackedBarChartCanvas, {
  //     type: 'bar',
  //     data: stackedBarChartData,
  //     options: stackedBarChartOptions
  //   })
  // })
  </script>

@endsection
   