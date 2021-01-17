@extends('waiter_master')

@section('sidebar')
<!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Table Order Detail
                <span class="right badge badge-danger">New</span>           
              </p>
            </a>
            
          </li>          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->

@endsection


@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            @foreach($orders as $order)
              @php
                $taleId = $order->table->id;
                $tableName = $order->table->name;
              @endphp
            @endforeach
            <h1 class="mb-3">Order Details by {{$tableName}}</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('waiterdashboard')}}">Home</a></li>
              <li class="breadcrumb-item active"><a href="{{route('tableno',['id'=>$taleId,'menuCategoryid'=>0])}}"> Add More Order</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
       <div class="row">
      @foreach($orders as $order)
        @if($order->status == 'order' || $order->status == 'served')
          @foreach($order->menu_items as $menu_item)
          @php               
            $total = 0;
            $subtotal = 0;
            $price = 0;
            
          @endphp

           <div class="col-md-4 mb-2">           
              <div class="card card-widget widget-user-2">
                <div class="widget-user-header bg-info">
                  <div class="widget-user-image">
                    <img class="img-circle elevation-2 mr-4" src="{{$menu_item->photo}}" alt="User Avatar">
                  </div>
                
                  <h5 class="widget-user-desc text-light">{{$menu_item->name}}</h5>
                </div>
                <div class="card-footer p-0">
                  <ul class="nav flex-column">
                    
                        @php
                            $qty = $menu_item->pivot->qty;

                            if($menu_item->discount){

                              $price = $menu_item->discount; 

                            }else{

                              $price = $menu_item->price;

                            }

                            $subtotal = $price*$qty;
                            $total += $subtotal;
                          @endphp

                    <li class="nav-item">
                      <a href="#" class="nav-link">
                        Quantity <span class="float-right">{{$qty}}</span>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="#" class="nav-link">
                        @if($menu_item->discount)
                        Price <span class="float-right">{{number_format($menu_item->discount)}} Ks
                        <del class="text-danger">{{$menu_item->price}} Ks</del></span>
                        @else
                        Price <span class="float-right">{{number_format($menu_item->price)}} Ks</span>
                        @endif
                      </a>
                    </li>

                    <li class="nav-item">                   
                      <a href="#" class="nav-link">
                        Subtotal <span class="float-right">{{number_format($subtotal)}} Ks</span>
                      </a>
                    </li>

                    <li class="nav-item">
                      
                      @if($menu_item->pivot->status == 'order')
                        <a href="#" class="nav-link">
                          State <span class="float-right badge-info px-3 pb-1 rounded">{{$menu_item->pivot->status}}</span>
                        </a>
                      @else
                        <a href="#" class="nav-link">
                          State <span class="float-right badge-warning px-3 pb-1 rounded">{{$menu_item->pivot->status}}</span>
                        </a>
                      @endif
                    </li>
                    
                  </ul>
                </div>
              </div>
              <!-- /.widget-user -->
            </div>

          @endforeach
        @endif
      @endforeach
       </div>
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection
