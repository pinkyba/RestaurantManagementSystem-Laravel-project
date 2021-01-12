@extends('waiter_master')

@section('sidebar')
<!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Menu Category    
                <span class="right badge badge-danger">New</span>           
              </p>
            </a>
            
          </li>
          <li class="nav-item menu-open">
            <a href="{{route('tableno',['id'=>$id,'menuCategoryid'=>0])}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                All Menu  
                <span class="right badge badge-danger">New</span>           
              </p>
            </a>
            
          </li>
          @foreach($menu_categories as $menu_category)
          <li class="nav-item menu-open">
            <a href="{{route('tableno',['id'=>$id,'menuCategoryid'=>$menu_category->id])}}" class="nav-link {{Request::is('menu_categories*')? 'active':''}}">
              <p>
                {{$menu_category->name}}                    
              </p>
            </a>            
          </li>
          @endforeach
         
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->

@endsection

@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            @foreach($tables as $table)
              @if($table->id == $id)
                @php $table_name = $table->name; @endphp
              @endif
            @endforeach
            <h1 class="m-0">Order By {{$table_name}}</h1>

          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{route('waiterdashboard')}}">Home</a></li>
              <li class="breadcrumb-item active">Add Order</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- /.row -->
        <!-- Main row -->
        <div class="row">
          <div class="col-5">
            <div class="row ml-2">
            @foreach($menu_items as $menu_item)

            <a title="Add to Order" href="" class="addtoOrder" data-id="{{$menu_item->id}}" data-name="{{$menu_item->name}}" data-codeno="{{$menu_item->codeno}}" data-photo="{{$menu_item->photo}}" data-price="{{$menu_item->price}}" data-discount="{{$menu_item->discount}}" data-tableno="{{$id}}">
              <div class="card mr-3" style="width: 11rem;;">
                <img class="card-img-top" src="{{$menu_item->photo}}" alt="Card image cap" style="height: 8rem;">
                <div class="card-body">
                  <p class="card-text">{{$menu_item->name}}</p>
                  @if($menu_item->discount)
                    <p class="card-text">
                      <span class="text-danger">{{number_format($menu_item->discount)}} Ks</span> 
                      <del>{{number_format($menu_item->price)}} Ks</del>
                    </p>
                  @else                    
                     <p class="card-text">{{number_format($menu_item->price)}} Ks</p>
                  @endif
                </div>
              </div>
            </a>

            @endforeach
            </div>
          </div>

          <div class="col-7">
            
            <div class="card">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr class="main-hading">
                    <th>#</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th> 
                    
                  </tr>
                </thead>
                <tbody class="cart_table"> 

                </tbody>
                
              </table> 
              <p><span style="margin-left: 14rem;">Your Pay</span> <span class="payment" style="margin-left: 16rem;"></span></p>
              <a href="#" class="btn btn-info addOrderbtn" data-tableno="{{$id}}">Add Order</a> 
            </div>  
                  
          </div>
        </div>
        
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection

@section('script')
  
<script type="text/javascript">
    
    $(document).ready(function(){
      
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
      
      var tableid = "{{$id}}";
      console.log(tableid);
      showOrderItem(tableid);

      $('.addtoOrder').on('click',function(){

        var id = $(this).data('id');
        var photo = $(this).data('photo');
        var name = $(this).data('name');
        var codeno = $(this).data('codeno');
        var price = $(this).data('price');
        var discount = $(this).data('discount');
        var tableno = $(this).data('tableno');
        var qty = 1;

        var itemList = {
          id: id,
          photo: photo,
          name: name,
          codeno: codeno,
          price: price,
          discount: discount,
          tableno: tableno,
          qty: qty
        }

        var cart = localStorage.getItem('cart');
        var cartArray;

        if(cart == null){
          cartArray = [];
        }else{
          cartArray = JSON.parse(cart);
        }

        // addtocart item is exit or not
        // if exit, increase only qty of this item
        var status = false;

        $.each(cartArray, function(i,v){
          if(id == v.id && tableid == v.tableno){
            v.qty ++;
            status = true;
          }
        })

        // if not exit, add new item in localstorage
        if(!status){
          cartArray.push(itemList);
        }

        var cartJson = JSON.stringify(cartArray);
        localStorage.setItem('cart', cartJson);

        //showOrderItem();
      })

      // Number Format
      function formatNumber(num) {
          return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1,')
      }

      // Show Order
      function showOrderItem(table_id){
        var cart = localStorage.getItem('cart');
        var html = '';
        var payment = '';

        if(cart){
          var cartArray = JSON.parse(cart);
          var subtotal = 0;
          var total = 0;

          $.each(cartArray, function(i,v){
            if(v.tableno == table_id){

            var id = v.id;
            var name = v.name;
            var codeno = v.codeno;
            var qty = v.qty;
            var price = v.price;
            var discount = v.discount;
            var photo = v.photo;


            html += `
                <tr>
                  <td>
                      <a href="#" class="remove btnremove btn" data-key=${i} title="Remove this item"><i class="far fa-times-circle"></i></a>
                    </td>
                  <td class="product-des" data-title="Description">
                    <p class="product-name"><a href="#">${name}</a></p>
                    
                  </td>`;
            if(v.discount){
              subtotal = discount*qty;
              total += subtotal;
              html += `<td class="price" data-title="Price"><span>${formatNumber(discount)} Ks </span></td>`;
            }
            else{
              subtotal = price*qty;
              total += subtotal;
              html += `<td class="price" data-title="Price"><span>${formatNumber(price)} Ks </span></td>`;
            }

            html += `<td class="qty" data-title="Qty">
                    <a class="btn btndecrease" data-type="minus" data-key=${i}><i class="far fa-minus-square"></i></a>
                   
                    <input type="text" class="input-number text-center" data-min="1" data-max="100" value="${qty}" size="1" readonly="">
                    <a class="btn btnincrease" data-type="plus" data-key=${i}><i class="far fa-plus-square"></i></a>
                    </td>
                    <td class="total-amount" data-title="Total"><span>${formatNumber(subtotal)} Ks</span></td>

                  </tr>`;
                }
            
          })
          $('.cart_table').html(html);
          payment += `${formatNumber(total)} Ks`;

          $('.payment').html(payment);
        }
        
      }


      //increase qty button
      $('.cart_table').on('click', '.btnincrease', function(){
        var key = $(this).data('key');

        var cart = localStorage.getItem('cart');
        var cartArray = JSON.parse(cart);
        $.each(cartArray,function(i,v){
          if(key==i){
            v.qty++;
          }
        })

        var cartJson = JSON.stringify(cartArray);
        localStorage.setItem('cart', cartJson);

        showOrderItem(tableid);
      })

      //decrease qty button
      $('.cart_table').on('click', '.btndecrease', function(){
        var key = $(this).data('key');

        var cart = localStorage.getItem('cart');
        var cartArray = JSON.parse(cart);
        $.each(cartArray,function(i,v){
          if(key==i){
            v.qty--;

            if(v.qty == 0){
              var isDelete = confirm("Your item count is zero! Do you want to remove this item?");
              if(isDelete){
                cartArray.splice(i,1);
              }else{
                  v.qty = 1;
              }
              

            }
          }
        })

        var cartJson = JSON.stringify(cartArray);
        localStorage.setItem('cart', cartJson);

        showOrderItem(tableid);
      })

      // btn remove
      $('.cart_table').on('click', '.btnremove', function(){
        var key = $(this).data('key');

        var cart = localStorage.getItem('cart');
        var cartArray = JSON.parse(cart);
        $.each(cartArray,function(i,v){
          if(key==i){
            var isDelete = confirm("Are you sure to delete?");
            if(isDelete){
              cartArray.splice(i,1);
            }
              
          }
        })

        var cartJson = JSON.stringify(cartArray);
        localStorage.setItem('cart', cartJson);

        showOrderItem(tableid);
      })


        // checkout button
      $('.addOrderbtn').click(function (){
        
        var cart = localStorage.getItem('cart');
        var cartArray = JSON.parse(cart);
        var subtotal = 0;
        var total = 0;
        var tableno = $(this).data('tableno');

        // var total = cartArray.reduce((acc,item) => acc+ (price => (item.discount == "")? item.price:item.discount * item.qty),0);
        var menuArray = [];
        var delete_tableno;

        $.each(cartArray, function(i,v){
          if(v.tableno == tableno){
              if(v.discount){
              subtotal = v.discount*v.qty;
              total += subtotal;
            }else{
              subtotal = v.price*v.qty;
              total += subtotal;
            }
            menuArray.push(cartArray[i]);

            delete_tableno = v.tableno;
            
          }         

        })

        // remove order by tableno from local storage 
        cartArray = cartArray.filter(item => item.tableno != delete_tableno);
        
        console.log(cartArray);

        // restore removed array to localstorage
        var cartJson = JSON.stringify(cartArray);
        localStorage.setItem('cart', cartJson);

        var menuJson = JSON.stringify(menuArray);

        // console.log(menuArray);
        // console.log(total);
        // console.log(tableno);
        // console.log(menuJson);

        $.post("{{route('orders.store')}}",{
          cart: menuJson,
          total: total,
          tableno: tableno,
        },function(response){
          
          location.href = "{{route('waiterdashboard')}}";
        })
      })
    })

  </script>

@endsection