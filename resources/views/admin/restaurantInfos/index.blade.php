@extends('admin_master')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Restaurant Infos</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('dashboardpage')}}">Home</a></li>
              <li class="breadcrumb-item active">Restaurant Infos</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          @php
            $i=1;
          @endphp
          @foreach($restaurants as $restaurant)
          <div class="col-md-4">

            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="{{$restaurant->photo}}"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center">{{$restaurant->name}}</h3>

                <p class="text-muted text-center">Bar & Restaurant</p>

                <strong><i class="fas fa-mobile-alt mr-1"></i> Phone No</strong>

                <p class="text-muted">
                  {{$restaurant->phno}}
                </p>

                <hr>

                <strong><i class="fas fa-envelope-open-text mr-1"></i> Email</strong>

                <p class="text-muted">{{$restaurant->email}}</p>

                <hr>

                <strong><i class="fas fa-map-marker-alt mr-1"></i> Address</strong>

                <p class="text-muted">
                  {{$restaurant->address}}
                </p>

                <hr>

                <strong><i class="far fa-file-alt mr-1"></i> Description</strong>

                <p class="text-muted">{{$restaurant->description}}</p>

                <div class="btn-group btn-group-sm">
                  
                  <a href="{{route('restaurantInfos.edit',$restaurant->id)}}" class="btn btn-warning mr-2"><i class="fas fa-cog px-5 pt-2">&nbsp;Edit</i></a>

                  <form method="post" action="{{route('restaurantInfos.destroy',$restaurant->id)}}" onsubmit="return confirm('Are you sure?')" class="d-inline-block">
                          @csrf
                          @method('DELETE')
                  <button type="submit" name="btn-delete" class="btn btn-danger"><i class="fas fa-trash px-4">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Delete</i></a>
                  </form>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
           </div>
          @endforeach
            
          
          
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection