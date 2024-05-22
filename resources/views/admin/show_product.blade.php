<!DOCTYPE html>
<html lang="en">
  <head>
   @include('admin.css')

   <style type="text/css">

    .h2_font{
     font-size: 40px;
     padding-bottom: 40px;
     text-align: center;
     margin-top: 30px;


    }
    .center{
     margin: auto;
     width: 80%;
     text-align: center;
     margin-top: 30px;
     border: 3px solid green;
     font-size: 15px;

    }
    .img_size{
        width: 150px;
        height: 150px;
    }
    .th_color{
        background-color: green;
        color: white;
    }
     </style>
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      @include('admin.sidebar')
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('admin.header')
        <!-- partial -->

        <div class="main-panel">
            <div class="content-wrapper">

                @if (session()->has('success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ session()->get('success') }}
                </div>  
                @endif

                @if (session()->has('delete'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ session()->get('delete') }}
                </div>  
                @endif
                
                <h2 class="h2_font">All Products</h2>

                <table class="center">
                    <tr class="th_color">
                        <th>#</th>
                        <th>Product Title</th>
                        <th>Description</th>
                        <th>Category</th>
                        <th>Product Quantity</th>
                        <th>Product Price</th>
                        <th>Discount Price</th>
                        <th>Image</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                    <?php $i=0 ?>
                    @foreach($products as $product)
                    <?php $i++ ?>
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $product->title }}</td>
                        <td>{{ $product->description }}</td>
                        <td>{{ $product->category }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->discount_price }}</td>
                        <td>
                            <img class="img_size" src =" /product/{{ $product->image }}">
                        </td>
                        <td>
                            <a href="{{url("/update_product",$product->id)}}" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                            <a onclick="return confirm('are you sure to delete this')" href= "{{url("/delete_product",$product->id)}}" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
   @include('admin.js')
  </body>
</html>