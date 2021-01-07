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
              <li class="breadcrumb-item active">Add Employee Form</li>
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
                <h2 class="d-inline">Add Employee Form</h2>              
                <a href="{{route('staff.index')}}" class="btn btn-info float-right"><i class="fas fa-angle-double-left"></i></a>
              </div>
              
              <div class="card-body">
                <form action="{{route('staff.store')}}" method="post" enctype="multipart/form-data">

                  @csrf

                  <div class="form-group">
                    <label for="exampleInputName">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputName" placeholder="Employee Name" name="name">
                    @error('name')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputFile">Photo</label>
                    <input id="exampleInputFile" type="file" class="form-control @error('photo') is-invalid @enderror" id="exampleInputphoto" name="photo">
                    @error('photo')
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
                    <label for="exampleInputNrc">NRC No</label>
                    <input type="text" class="form-control @error('NRCno') is-invalid @enderror" id="exampleInputNrc" placeholder="Enter NRC no" name="NRCno">
                    @error('NRCno')
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
                    <label for="exampleInputrestaurant">Choose Restaurant</label>
                    <select id="exampleInputrestaurant" class="form-control" name="restaurant_id">
                      @foreach($restaurants as $restaurant)
                        <option value="{{$restaurant->id}}">{{$restaurant->name}}</option>
                      @endforeach
                    </select>                    
                  </div>

                  <div class="form-group">
                    <label for="exampleInputrole">Choose Role</label>
                    <select id="exampleInputrole" class="form-control" name="role_id">
                      @foreach($roles as $role)
                        <option value="{{$role->id}}">{{$role->name}}</option>
                      @endforeach
                    </select>                    
                  </div>

                  <div class="form-group">
                    <label for="exampleInputEmail">Email</label>
                    <input id="exampleInputEmail" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="Enter Email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPassword">Password</label>
                    <input id="exampleInputPassword" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="Enter password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputConfirm">Confirm Password</label>
                    <input id="exampleInputConfirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="Enter Confirm Password">
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