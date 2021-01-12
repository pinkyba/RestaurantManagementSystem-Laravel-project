@extends('vendor_master')

@section('content')

<div class="content-wrapper">
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('vendordashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Menu Category Edit Form</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">  
                <h2 class="d-inline">Menu Category Edit Form</h2>              
                <a href="{{route('menu_categories.index')}}" class="btn btn-info float-right"><i class="fas fa-angle-double-left"></i></a>
              </div>
              
              <div class="card-body">
                <form action="{{route('menu_categories.update',$menuCategory->id)}}" method="post" enctype="multipart/form-data">
                  @csrf
                  @method('PUT')

                  <div class="form-group">
                    <label for="exampleInputName">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputName" placeholder="Category Name" name="name" value="{{$menuCategory->name}}">
                    @error('name')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputexpense">Choose Menu Status</label>
                    <select id="exampleInputexpense" class="form-control" name="status">
                      @foreach($expense_categories as $expense_category)
                      @if($expense_category->id == $expense->expense_category->id)
                        <option value="{{$expense_category->id}}" selected="">{{$expense_category->name}}</option>
                      @else
                        <option value="{{$expense_category->id}}">{{$expense_category->name}}</option>
                      @endif
                      @endforeach
                    </select>                    
                  </div>
                  <br>
                  <button type="submit" class="btn btn-info">Update</button>
                </form>
              </div>
          </div>
        </div>

      </div>
        <!-- /.row -->
    </div>
      <!-- /.container-fluid -->
    </section>
	
  </div>
@endsection