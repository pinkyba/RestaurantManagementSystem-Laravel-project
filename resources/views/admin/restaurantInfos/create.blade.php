@extends('admin_master')

@section('content')

<div class="content-wrapper">
  <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('menu_categories.index')}}">Home</a></li>
              <li class="breadcrumb-item active">Restaurant Form</li>
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
                <h2 class="d-inline">Add Restaurant Form</h2>              
                <a href="{{route('restaurantInfos.index')}}" class="btn btn-info float-right"><i class="fas fa-angle-double-left"></i></a>
              </div>
              
              <div class="card-body">
                <form action="{{route('restaurantInfos.store')}}" method="post" enctype="multipart/form-data">

                  @csrf

                  <div class="form-group">
                    <label for="exampleInputFile">Photo</label>
                    <input id="exampleInputFile" type="file" class="form-control @error('photo') is-invalid @enderror" id="exampleInputphoto" name="photo">
                    @error('photo')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputName">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputName" placeholder="Restaurant Name" name="name">
                    @error('name')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPhone">Ph No</label>
                    <input type="text" class="form-control @error('phno') is-invalid @enderror" id="exampleInputPhone" placeholder="Enter Phone No" name="phno">
                    @error('phno')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail">Email</label>
                    <input type="text" class="form-control @error('phno') is-invalid @enderror" id="exampleInputEmail" placeholder="Enter Email" name="email">
                    @error('email')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputaddress">Address</label>
                    <textarea id="exampleInputaddress" class="form-control @error('address') is-invalid @enderror" rows="3" placeholder="Enter Address" name="address"></textarea>
                    @error('address')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
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