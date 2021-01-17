@extends('cashier_master')

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
                Cashier Detail
                      
              </p>
            </a>
            
          </li>          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->

@endsection


@section('content')
<div class="content-wrapper">
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Invoice</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('cashierdashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Invoice</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
  <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            @foreach($orders as $order)
              @php
                $codeno = $order->codeno;
                $tableName = $order->table->name;
                $orderdate = $order->orderdate;
              @endphp
            @endforeach
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12">
                  <h4>
                    <i class="fas fa-globe"></i> {{$staff[0]->restaurant->name}}
                    <small class="float-right">Date: {{$orderdate}}</small>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                  From
                  <address>
                    <strong>{{$staff[0]->restaurant->address}}</strong><br>
                    
                    Phone: {{$staff[0]->restaurant->phno}}<br>
                    Email: {{$staff[0]->restaurant->email}}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  To
                  <address>
                    <strong>{{$tableName}}</strong><br>
                    
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <b>Invoice #</b><br>
                  <b>Order ID:</b> {{$codeno}}<br>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>No</th>
                      <th>Menu Name</th>
                      <th>Price</th>
                      <th>Quantity</th>
                      <th>Subtotal</th>
                    </tr>
                    </thead>
                    <tbody>
                      @php 
                        $i=1;               
                        $total = 0;
                        $subtotal = 0;
                        $price = 0;
                        $orderid = $order->id;
                      @endphp
                    @foreach($orders as $order)
                    @foreach($order->menu_items as $menu_item)
                      <tr>
                        <td>{{$i++}}</td>
                        <td>{{$menu_item->name}}</td>
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
                        <td>{{number_format($price)}} Ks</td>
                        <td>{{$qty}}</td>
                        <td>{{number_format($subtotal)}} Ks</td>
                      </tr>
                      @endforeach
                    @endforeach
                      <tr>
                        <td colspan="4" class="text-right"><b>Total Amount</b></td>
                        <td><b>{{number_format($total)}} Ks</b></td>
                      </tr>
                    
                    </tbody>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                
                  <a href="{{route('cashierdetailprint',$orderid)}}" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                    Payment
                  </a>
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
</div>

@endsection

@section('script')
  <script>
  window.addEventListener("load", window.print());
  </script>
@endsection

