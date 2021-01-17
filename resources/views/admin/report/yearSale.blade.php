@extends('admin_master')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Year Item Sale Report</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboardpage')}}">Home</a></li>
              <li class="breadcrumb-item active">Year Item Sale</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <div class="card">
          <form action="{{route('adminyearSaleFilter')}}" method="post">
            @csrf
            <div class="row">

              <div class="col-4 ml-5"> 
                <div class="p-4">                    
                  <label class="mt-3 mb-3 d-block">Choose Restaurant</label>
                  <select class="form-select form-select-lg mb-3 form-control" aria-label=".form-select-lg example" name="restaurant_id" id="restaurant">
                    <option selected>Choose Restaurant</option>
                    @foreach($restaurants as $restaurant)
                      <option value="{{$restaurant->id}}">{{$restaurant->name}}</option>
                    @endforeach
                  </select>                     
                </div>
              </div> 
                
              <div class="col-4 ml-5"> 
                <div class="p-4">                    
                  <label class="mt-3 mb-3 d-block" for="year">Enter Year</label>
                  <input type="number" class="form-control" name="year" id="year">                    
                </div>
              </div>

              <div class="col-2">
                <div style="margin-top: 85px;" class="ml-5"> 
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

              <tr><td colspan="4"><b>YEAR: {{$year}}</b></td></tr>
              @php                                    
                  $myArray = array();
              @endphp

              {{-- create key value item array --}}
              @foreach($orders as $order)
                @if($order->table->restaurant_id == $restaurantid)                    
                                        
                  @foreach($order->menu_items as $menu_item)
                   @php
                    $id = $menu_item->id;
                    $name = $menu_item->name;
                    $qty = $menu_item->pivot->qty;
                    
                    if($menu_item->discount){

                      $price = $menu_item->discount; 

                    }else{

                      $price = $menu_item->price;

                    }

                    // create key value item array
                    $item = array(
                        "id" => $id,
                        "name"  => $name,
                        "qty" => $qty,
                        "price" => $price,
                    );
                    array_push($myArray, $item);
                   @endphp                        
                  @endforeach
                @endif                  
              @endforeach

              {{-- add quantity of same item id --}}
              @php 
                //print_r($myArray);
                //exit();
                $sum = array_reduce($myArray, function ($a, $b) {
                  //print_r($a);
                  // print_r($b);
                  isset($a[$b['id']]) ? $a[$b['id']]['qty'] += $b['qty'] : $a[$b['id']] = $b;  
                  return $a;
                });
              
              // check $myArray is exist
              if($myArray){
                // get new array sum of quantity groupby same itemid
                $result = array_values($sum);
                //print_r($result); 
              }else{
                $result = [];
              }
                
              @endphp
                
              {{-- display sale item and its quantity and total in one month --}}
              @foreach($result as $key => $value)
              <tr>

              @php 
                $total = $value['qty']*$value['price'];
                //print_r($value['name']);
              @endphp

                <td>{{$value['name']}}</td>
                <td>{{number_format($value['price'])}} Ks</td>
                <td>{{$value['qty']}}</td>
                <td>{{number_format($total)}} Ks</td>

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