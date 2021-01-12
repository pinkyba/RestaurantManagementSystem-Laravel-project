@extends('vendor_master')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Expenses</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboardpage')}}">Home</a></li>
              <li class="breadcrumb-item active">Expenses</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                
              <a href="{{route('expenses.create')}}" class="btn btn-info float-right">Add New</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Expense Category</th>
                    <th>Expense Date</th>
                    <th>Description</th>
                    <th>Restaurant</th>
                    <th>Action</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                  @php $i=1; @endphp
                  @foreach($expenses as $expense)
                    <tr>
                      <td>{{$i++}}</td>
                      <td>{{$expense->name}}</td>
                      <td>{{number_format($expense->price)}} Ks</td>
                      <td>{{$expense->expense_category->name}}</td>
                      <td>{{$expense->expensedate}}</td>
                      <td>{{$expense->description}}</td>
                      <td>{{$expense->restaurant->name}}</td>
                      <td> 
                        <div class="btn-group btn-group-sm">
                          
                          <a href="{{route('expenses.edit',$expense->id)}}" class="btn btn-sm btn-warning mr-2"><i class="fas fa-cog"></i></a>

                          <form method="post" action="{{route('expenses.destroy',$expense->id)}}" onsubmit="return confirm('Are you sure?')" class="d-inline-block">
                          @csrf
                          @method('DELETE')
                            <button type="submit" name="btn-delete" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                          </form>

                        </div>
                      </td>
                    </tr>
                  @endforeach
                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection