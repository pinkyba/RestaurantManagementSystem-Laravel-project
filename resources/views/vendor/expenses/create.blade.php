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
              <li class="breadcrumb-item active">Expense Form</li>
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
                <h2 class="d-inline">Expense Create Form</h2>              
                <a href="{{route('expenses.index')}}" class="btn btn-info float-right"><i class="fas fa-angle-double-left"></i></a>
              </div>
              
              <div class="card-body">
                <form action="{{route('expenses.store')}}" method="post" enctype="multipart/form-data">

                  @csrf

                  <div class="form-group">
                    <label for="exampleInputName">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputName" placeholder="Expense Name" name="name">
                    @error('name')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPhone">Expense Date</label>
                    <input type="Date" class="form-control @error('date') is-invalid @enderror" id="exampleInputPhone" placeholder="Enter Expense Date" name="date">
                    
                    @error('date')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPrice">Price</label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" id="exampleInputPrice" placeholder="Enter Price" name="price">
                    @error('price')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputexpense">Choose Expense Category</label>
                    <select id="exampleInputexpense" class="form-control" name="expense_category_id">
                      @foreach($expense_categories as $expense_category)
                        <option value="{{$expense_category->id}}">{{$expense_category->name}}</option>
                      @endforeach
                    </select>                    
                  </div>

                  <div class="form-group">
                    <label for="exampleInputDes">Description</label>
                    <textarea id="exampleInputDes" class="form-control @error('address') is-invalid @enderror" rows="3" placeholder="Enter description" name="description"></textarea>
                    @error('description')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <button type="submit" class="btn btn-info">Save</button>
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