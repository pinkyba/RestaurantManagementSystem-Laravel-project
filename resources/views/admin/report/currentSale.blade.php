@extends('admin_master')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Current Sale Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboardpage')}}">Home</a></li>
              <li class="breadcrumb-item active">Current Sale</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
            <div class="card">
              <form action="{{route('admincurrentSaleFilter')}}" method="post">
                @csrf
                <div class="row">

                  <div class="col-7 ml-5 mr-5"> 
                    <div class="p-4" style="margin-left: 70px;">                    
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
                    <div style="margin-top: 85px; margin-left: 50px;"> 
                      <button class="btn-info" type="submit"><i class="fa fa-th-large mr-2"></i>Display</button>
                    </div>
                  </div>
                </div>
            </form>
            </div>
            <!-- /.card -->

            <div class="card">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Item</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                   
                  </tr>
                </thead>
              <tbody>

                @php $totalSale = 0; @endphp
                @foreach($orders as $order)
                  @if($order->table->restaurant_id == $restaurantid)
                    @php $totalSale += $order->total; @endphp
                  @endif
                @endforeach

                <tr>
                  <td colspan="4"><b>TOTAL SALE: {{number_format($totalSale)}} Ks</b></td>
                </tr>

                @foreach($orders as $order)
                  @php              
                    $total = 0;
                    $subtotal = 0;
                    $price = 0;
                  @endphp
                  @if($order->table->restaurant_id == $restaurantid)
                    <tr><td colspan="4"><b>DATE: {{$order->orderdate}}</b></td></tr>
                    <tr><td colspan="4"><b>INVOICE: {{$order->codeno}}</b></td></tr>
                    
                    @foreach($order->menu_items as $menu_item)
                      
                        <tr>
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
                  @endif
                  <tr>
                    <td colspan="3" class="text-right"><b>Total Amount</b></td>
                    <td><b>{{number_format($total)}} Ks</b></td>
                  </tr>
                  @endforeach
                  
              </tbody>
                  
                </table>
            </div>
         
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection