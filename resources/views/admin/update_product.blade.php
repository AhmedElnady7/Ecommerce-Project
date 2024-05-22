<!DOCTYPE html>
<html lang="en">
  <head>

    <base href="/public">
   @include('admin.css')

   <style type="text/css">
    .div_center{
     text-align: center;
     padding-top: 40px;
    }
    .h2_font{
     font-size: 40px;
     padding-bottom: 40px;
    }
    label{
        display: inline-block;
        width: 200px;
    }
    .div_design{
        padding-bottom: 15px;
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

                <div class="div_center">

                    <h2 class="h2_font">Update Product</h2>
                    
                    <form method="POST" action="{{url('/update_product_confirm',$products->id)}}" enctype="multipart/form-data">
                        @csrf
                    <div class="div_design">

                        <label>Product Title :</label>
                    <input type="text" name="title" placeholder="write a title" required="" value="{{ $products->title }}">
                    </div>
                    <div class="div_design">
                        <label>Product Description :</label>
                    <input type="text" name="description" placeholder="write a description" required="" value="{{ $products->description }}">
                    </div>
                    <div class="div_design">
                        <label>Product Price :</label>
                    <input type="number" name="price" placeholder="write a price" required="" value="{{ $products->price }}">
                    </div>
                    <div class="div_design">
                        <label>Discount Price :</label>
                    <input type="number" name="discount_price" placeholder="write a discount" value="{{ $products->discount_price }}">
                    </div>
                    <div class="div_design">
                        <label>Product Quantity :</label>
                    <input type="number" min="0" name="quantity" placeholder="write a quantity" required="" value="{{ $products->quantity }}">
                    </div>
                    
                    <div class="div_design">
                        <label>Product Category :</label>
                        <select name="category" required="">
                            <option value="{{ $products->category }}" selected="" >{{ $products->category }}</option>
                            @foreach ($category as $category )
                                
                            <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="div_design">
                        <label>Current Product Image :</label>
                    <img height="100" width="100" src="/product/{{ $products->image }}">
                    </div>

                    <div class="div_design">
                        <label>Change Product Image :</label>
                    <input type="file" name="image">
                    </div>


                    <div class="div_design">
                    <input type="submit" value="Update Product" class="btn btn-primary">
                    </div>
                 </form>
                </div>

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