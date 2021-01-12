@extends('vendor_master')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>menu_items</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboardpage')}}">Home</a></li>
              <li class="breadcrumb-item active">menu_items</li>
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
              <a href="{{route('menu_items.create')}}" class="btn btn-info float-right">Add New</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Photo</th>
                    <th>Codeno</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Menu Category</th>
                    
                    <th>Action</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                  @php $i=1; @endphp
                  @foreach($menu_items as $menu_item)
                    <tr>
                      <td>{{$i++}}</td>
                      <td><img src="{{$menu_item->photo}}" style="width: 120px;; height: 120px;"></td>
                      <td>{{$menu_item->codeno}}</td>
                      <td>{{$menu_item->name}}</td>

                      @if($menu_item->discount)
                        <td>
                          <span class="text-danger">{{number_format($menu_item->discount)}} Ks</span> 
                          <del>{{number_format($menu_item->price)}} Ks</del>
                        </td>
                      @else                    
                         <td>{{number_format($menu_item->price)}} Ks</td>
                      @endif

                      <td>{{$menu_item->description}}</td>
                      <td>{{$menu_item->status}}</td>
                      <td>{{$menu_item->menu_category->name}}</td>                      
                
                      <td> 
                        <div class="btn-group btn-group-sm">
                          
                          <a href="{{route('menu_items.edit',$menu_item->id)}}" class="btn btn-sm btn-warning mr-2"><i class="fas fa-cog"></i></a>

                          <form method="post" action="{{route('menu_items.destroy',$menu_item->id)}}" onsubmit="return confirm('Are you sure?')" class="d-inline-block">
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