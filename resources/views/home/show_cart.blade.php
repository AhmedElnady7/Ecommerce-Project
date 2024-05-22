<!DOCTYPE html>
<html>
   <head>
    <style type="text/css">
    .center{
        margin:auto;
        width: 70%;
        text-align: center;
        padding: 50px;
    }
    .table,th,td{
        border: 3px solid grey;
    }

    .th_color{
        font-size: 20px;
        padding: 10px;
        background: skyblue;
    }
    
    .img{
        width: 100px;
        height: 100px;
        padding: 10px;
        margin: 10px;
        
    }
    .total{
        font-size: 20px;
        padding: 30px;
    }
    </style>
      <!-- Basic -->
      <meta charset="utf-8" />
      <meta http-equiv="X-UA-Compatible" content="IE=edge" />
      <!-- Mobile Metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
      <!-- Site Metas -->
      <meta name="keywords" content="" />
      <meta name="description" content="" />
      <meta name="author" content="" />
      <link rel="shortcut icon" href="images/favicon.png" type="">
      <title>Famms - Fashion HTML Template</title>
      <!-- bootstrap core css -->
      <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
      <!-- font awesome style -->
      <link href="home/css/font-awesome.min.css" rel="stylesheet" />
      <!-- Custom styles for this template -->
      <link href="home/css/style.css" rel="stylesheet" />
      <!-- responsive style -->
      <link href="home/css/responsive.css" rel="stylesheet" />
   </head>
   <body>
      <div class="hero_area">
         <!-- header section strats -->
         @include('home.header')
         <!-- end header section -->
         <!-- slider section -->
         @if (session()->has('massage'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ session()->get('massage') }}
                </div>  
                @endif
         <!-- end slider section -->
      
     <div class="center">
        <table>
            <tr>
                <th class="th_color">Product Title</th>
                <th class="th_color">Product Quantity</th>
                <th class="th_color">Price</th>
                <th class="th_color">image</th>
                <th class="th_color">Action</th>
            </tr>
            <?php  $totalprice=0 ?>
            @foreach ($cart as $cart )
                
            <tr>
                <td>{{$cart->product_title}}</td>
                <td>{{$cart->quantity}}</td>
                <td>${{$cart->price}}</td>
                <td><img class="img" src="/product/{{$cart->image}}"></td>
                <td>
                    <a onclick="return confirm('are you sure to delete this')" href="{{ url('/remove_product',$cart->id) }}" class="btn btn-danger">Remove Product</a>
                </td>
                
            </tr>
            <?php $totalprice= $totalprice + $cart->price ?> 
            @endforeach
        </table>
        <div>
            <h5 class="total">

                Total Price : ${{ $totalprice }}
            </h5>
            
        </div>
        <div>
            <h5>Proceed To Order</h5>
            <a href="{{ url('cash_order') }}" class="btn btn-danger">Cash On Delivery</a>
            <a href="{{ url('stripe',$totalprice) }}" class="btn btn-danger">Pay Using Card</a>
        </div>
     </div>
      <!-- footer start -->
      
      <!-- footer end -->
      <div class="cpy_">
         <p class="mx-auto">© 2021 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>
         
            Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>
         
         </p>
      </div>
      <!-- jQery -->
      <script src="home/js/jquery-3.4.1.min.js"></script>
      <!-- popper js -->
      <script src="home/js/popper.min.js"></script>
      <!-- bootstrap js -->
      <script src="home/js/bootstrap.js"></script>
      <!-- custom js -->
      <script src="home/js/custom.js"></script>
   </body>
</html>