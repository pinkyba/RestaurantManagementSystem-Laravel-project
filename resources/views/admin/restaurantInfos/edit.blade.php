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
              <li class="breadcrumb-item"><a href="{{route('restaurantInfos.index')}}">Home</a></li>
              <li class="breadcrumb-item active">Restaurant Edit
               Form</li>
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
                <h2 class="d-inline">Edit Restaurant Form</h2>              
                <a href="{{route('restaurantInfos.index')}}" class="btn btn-info float-right"><i class="fas fa-angle-double-left"></i></a>
              </div>
              
              <div class="card-body">
                <form action="{{route('restaurantInfos.update',$restaurantInfo->id)}}" method="post" enctype="multipart/form-data">

                  @csrf
                  @method('PUT')

                  <div class="form-group">
                    <label for="exampleInputFile">Edit Photo</label>
                    <ul class="nav nav-tabs">
                      <li class="nav-item">
                        <a class="nav-link active" id="nav-unit-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Old Photo </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="nav-discount-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">New Photo</a>
                      </li>
                      
                    </ul><br>
                    
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-unit-tab">                           
                            <img src="{{$restaurantInfo->photo}}" width="100">

                            {{-- carry old photo data with hidden input --}}
                            <input type="hidden" name="oldphoto" value="{{$restaurantInfo->photo}}">
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-discount-tab">
                            
                            <input type="file" class="form-control" id="exampleInputphoto" name="photo">
                        </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputName">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputName" placeholder="Restaurant Name" name="name" value="{{$restaurantInfo->name}}">
                    @error('name')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPhone">Ph No</label>
                    <input type="text" class="form-control @error('phno') is-invalid @enderror" id="exampleInputPhone" placeholder="Enter Phone No" name="phno" value="{{$restaurantInfo->phno}}">
                    @error('phno')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail">Email</label>
                    <input type="text" class="form-control @error('phno') is-invalid @enderror" id="exampleInputEmail" placeholder="Enter Email" name="email" value="{{$restaurantInfo->email}}">
                    @error('email')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputaddress">Address</label>
                    <textarea id="exampleInputaddress" class="form-control @error('address') is-invalid @enderror" rows="3" placeholder="Enter Address" name="address">{{$restaurantInfo->address}}</textarea>
                    @error('address')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputDes">Description</label>
                    <textarea id="exampleInputDes" class="form-control @error('address') is-invalid @enderror" rows="3" placeholder="Enter description" name="description"> {{$restaurantInfo->description}}</textarea>
                    @error('description')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>

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