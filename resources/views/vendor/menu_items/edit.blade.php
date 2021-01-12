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
              <li class="breadcrumb-item active">Menu Edit Form</li>
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
                <h2 class="d-inline">Menu Edit Form</h2>              
                <a href="{{route('menu_items.index')}}" class="btn btn-info float-right"><i class="fas fa-angle-double-left"></i></a>
              </div>
              
              <div class="card-body">
                <form action="{{route('menu_items.update',$menuItem->id)}}" method="post" enctype="multipart/form-data">
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
                            <img src="{{$menuItem->photo}}" width="100">

                            {{-- carry old photo data with hidden input --}}
                            <input type="hidden" name="oldphoto" value="{{$menuItem->photo}}">
                        </div>
                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-discount-tab">
                            
                            <input type="file" class="form-control" id="exampleInputphoto" name="photo">
                        </div>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="exampleInputcode">Code No</label>
                    <input type="text" class="form-control @error('codeno') is-invalid @enderror" id="exampleInputcode" placeholder="Enter Code No" name="codeno" value="{{$menuItem->codeno}}" readonly="">
                    @error('codeno')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputName">Name</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="exampleInputName" placeholder="Enter Menu Name" name="name" value="{{$menuItem->name}}">
                    @error('name')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputPrice">Price</label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" id="exampleInputPrice" placeholder="Enter Price" name="price" value="{{$menuItem->price}}">
                    @error('price')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputDis">Discount</label>
                    <input type="number" class="form-control @error('discount') is-invalid @enderror" id="exampleInputDis" placeholder="Enter Discount" name="discount" value="{{$menuItem->discount}}">
                    @error('discount')
                      <div class="text-danger">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="exampleInputexpense">Choose Menu Category</label>
                    <select id="exampleInputexpense" class="form-control" name="menu_category_id">
                      @foreach($menu_categories as $menu_category)

                      @if($menu_category->id == $menuItem->menu_category_id)
                        <option value="{{$menu_category->id}}" selected="">{{$menu_category->name}}</option>
                      @else
                        <option value="{{$menu_category->id}}">{{$menu_category->name}}</option>
                      @endif

                      @endforeach
                    </select>                    
                  </div>

                  <div class="form-group">
                    <label for="exampleInputDes">Description</label>
                    <textarea id="exampleInputDes" class="form-control @error('description') is-invalid @enderror" rows="3" placeholder="Enter description" name="description">{{$menuItem->description}}</textarea>
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