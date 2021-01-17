@extends('admin_master')
@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Admin Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <div class="card">
          <form action="{{route('admindashboardFilter')}}" method="post">
            @csrf
            <div class="row">

              <div class="col-10"> 
                <div class="p-4 ml-3">                    
                  <label class="mt-3 mb-3 d-block form-check-label">Choose Restaurant</label>
                  <select class="form-select form-select-lg mb-3 form-control" aria-label=".form-select-lg example" name="restaurant_id" id="restaurant">
                    <option selected>Choose Restaurant</option>
                    @foreach($restaurants as $restaurant)
                      <option value="{{$restaurant->id}}">{{$restaurant->name}}</option>
                    @endforeach
                  </select>                     
                </div>
              </div> 

              <div class="col-2">
                <div style="margin-top: 85px;"> 
                  <button class="btn-info" type="submit"><i class="fa fa-th-large mr-2"></i>Display</button>
                </div>
              </div>
            </div>
        </form>

        <div class="row p-3">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">

                @php $totalSale = 0; @endphp
                @foreach($orders as $order)
                  @if($order->table->restaurant_id == $restaurantid)
                    @php $totalSale += $order->total; @endphp
                  @endif
                @endforeach

                <h3>{{number_format($totalSale)}} Ks</h3>

                <p>Today Sale</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer"></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                @php $totalorder = 0; @endphp
                @foreach($orders as $order)
                  @if($order->table->restaurant_id == $restaurantid)
                    @php $totalorder ++; @endphp
                  @endif
                @endforeach

                <h3>{{$totalorder}}</h3>

                <p>Today Order</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer"></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                @php $totalExpense = 0; @endphp
                @foreach($expenses as $expense)
                  @if($expense->restaurant_id == $restaurantid)
                    @php $totalExpense += $expense->price; @endphp
                  @endif
                @endforeach

                <h3>{{number_format($totalExpense)}} Ks</h3>

                <p>Today Expense</p>
              </div>
              <div class="icon">
                <i class="fas fa-dollar-sign"></i>
              </div>
              <a href="#" class="small-box-footer"></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">

                @php $totalpending = 0; @endphp
                @foreach($pendingorders as $pendingorder)
                  @if($pendingorder->table->restaurant_id == $restaurantid)
                    @php $totalpending ++; @endphp
                  @endif
                @endforeach

                <h3>{{$totalpending}}</h3>

                <p>Pending Order</p>
              </div>
              <div class="icon">
                <i class="fas fa-utensils"></i>
              </div>
              <a href="#" class="small-box-footer"></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
      </div>

        <!-- Main row -->
        <div class="row">
          <!-- Left col -->
          <section class="col-lg-7 connectedSortable">
            <!-- Custom tabs (Charts with tabs)-->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Sales
                </h3>
                <div class="card-tools">
                  <ul class="nav nav-pills ml-auto">
                    <li class="nav-item">
                      <a class="nav-link active" href="#revenue-chart" data-toggle="tab">Area</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#sales-chart" data-toggle="tab">Donut</a>
                    </li>
                  </ul>
                </div>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content p-0">
                  <!-- Morris chart - Sales -->
                  <div class="chart tab-pane active" id="revenue-chart"
                       style="position: relative; height: 300px;">
                      <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                   </div>
                  <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                    <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                  </div>
                </div>
              </div><!-- /.card-body -->
            </div>
            
          </section>
          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">
            <!-- solid sales graph -->
            <div class="card bg-gradient-info">
              <div class="card-header border-0">
                <h3 class="card-title">
                  <i class="fas fa-th mr-1"></i>
                  Sales Graph
                </h3>

                <div class="card-tools">
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn bg-info btn-sm" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
              <div class="card-footer bg-transparent">
                <div class="row">
                  <div class="col-4 text-center">
                    <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60"
                           data-fgColor="#39CCCC">

                    <div class="text-white">Mail-Orders</div>
                  </div>
                  <!-- ./col -->
                  <div class="col-4 text-center">
                    <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60"
                           data-fgColor="#39CCCC">

                    <div class="text-white">Online</div>
                  </div>
                  <!-- ./col -->
                  <div class="col-4 text-center">
                    <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60"
                           data-fgColor="#39CCCC">

                    <div class="text-white">In-Store</div>
                  </div>
                  <!-- ./col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.card-footer -->
            </div>
            <!-- /.card -->
          
            
            <!-- /.card -->
          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    
  </div>
@endsection