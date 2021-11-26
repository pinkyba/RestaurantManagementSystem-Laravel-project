@extends('admin_master')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Order List</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboardpage')}}">Home</a></li>
              <li class="breadcrumb-item active">Order List</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <div class="card">
          <form action="{{route('adminOrderFilter')}}" method="post">
            @csrf
            <div class="row">

              <div class="col-3 ml-5"> 
                <div class="p-4">                    
                  <label class="mt-3 mb-3 d-block form-check-label">Choose Restaurant</label>
                  <select class="form-select form-select-lg mb-3 form-control" aria-label=".form-select-lg example" name="restaurant_id" id="restaurant">
                    <option selected>Choose Restaurant</option>
                    @foreach($restaurants as $restaurant)
                      <option value="{{$restaurant->id}}">{{$restaurant->name}}</option>
                    @endforeach
                  </select>                     
                </div>
              </div> 
              <div class="col-3"> 
                <div class="p-4">                     
                  <label class="mt-3 mb-3 d-block form-check-label">Choose Waiter</label>
                  <select class="form-select form-select-lg mb-3 form-control" aria-label=".form-select-lg example" name="waiter_id" id="waiter">
                   <option selected>Choose Waiter</option> 
                  </select> 
                </div>                   
              </div>

              <div class="col-3"> 
                <div class="p-4">                     
                  <label class="mt-3 mb-3 d-block form-check-label">Choose Date By</label>
                  <select class="form-select form-select-lg mb-3 form-control" aria-label=".form-select-lg example" name="date">

                    <option value="today">Today</option>
                    <option value="month">This Month</option>
                    
                  </select> 
                </div>                     
              </div>
              
              <div class="col-2">
                <div style="margin-top: 85px;" class="ml-4"> 
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
                <th>No</th>
                <th>Code No</th>
                <th>Order Date</th>
                <th>Total</th>
                <th>Waiter</th>
                <th>Table</th>
              </tr>
              </thead>
              <tbody>
              @php $i=1; @endphp
              @foreach($orders as $order)
                @if($restaurantid != 0 && $order->table->restaurant_id == $restaurantid)
                <tr>
                  <td>{{$i++}}</td>
                  <td>{{$order->codeno}}</td>
                  <td>{{$order->orderdate}}</td>
                  <td>{{number_format($order->total)}} Ks</td>
                  <td>{{$order->staff->user->name}}</td>
                  <td>{{$order->table->name}}</td>
                </tr>
                @else
                  <tr>
                  <td>{{$i++}}</td>
                  <td>{{$order->codeno}}</td>
                  <td>{{$order->orderdate}}</td>
                  <td>{{number_format($order->total)}} Ks</td>
                  <td>{{$order->staff->user->name}}</td>
                  <td>{{$order->table->name}}</td>
                </tr>
                @endif
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

@section('script')
  <script type="text/javascript">
    $.ajaxSetup({
      headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
    $(document).ready(function () {
      $('#restaurant').on('change',function(e) {
        var restaurant_id = e.target.value;
        $.ajax({
          url:"{{ route('adminwaiter') }}",
          type:"POST",
          data: {
          restaurant_id: restaurant_id
        },
      success:function (data) {
          //console.log(data.waiters);
          $('#waiter').empty();
          
          $.each(data.waiters,function(index,waiter){
          console.log(waiter.user);
          $('#waiter').append('<option value="'+waiter.id+'">'+waiter.user.name+'</option>');
        })
      }
      })
      });
    });
</script>
@endsection