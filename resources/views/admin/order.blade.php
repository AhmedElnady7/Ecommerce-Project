<!DOCTYPE html>
<html lang="en">
  <head>
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
    .center{
     margin: auto;
     width: 80%;
     text-align: center;
     margin-top: 40px;
     border: 3px solid green;
     font-size: 15px;
    }
    .th_color{
        background-color: green;
        color: white;
    }
    .img_size{
        width: 80px;
        height: 80px;
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

                <div class="div_center">

                    <h2 class="h2_font">All Orders</h2>

                    <div>

                        <form action="{{ url('search') }}" method="get">


                            @csrf
                            <input type="text" name="search" placeholder="search">

                            <input type="submit" value="search" class="btn btn-outline-primary">

                        </form>
                    </div>
    
                </div>
                
                <table class="center">

                    <tr class="th_color">
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Product_Title</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Payment_Status</th>
                        <th>Delivery_Status</th>
                        <th>Image</th>
                        <th>Dilivered</th>
                        <th>Print PDF</th>
                        <th>Send Email</th>
                    </tr>
                    
                    <?php $i=0 ?>
                    @forelse ($order as $order)
                        <?php $i++ ?>
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->email }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->address }}</td>
                        <td>{{ $order->product_title }}</td>
                        <td>${{ $order->price }}</td>
                        <td>{{ $order->quantity }}</td>
                        <td>{{ $order->payment_status }}</td>
                        <td>{{ $order->delivery_status }}</td>
                        <td>
                            <img class="img_size" src =" /product/{{ $order->image }}">
                        </td>
                        <td>
                            @if ($order->delivery_status=='processing')

                            <a href="{{ url('delivered',$order->id)}}" class="btn btn-primary" onclick="return confirm('Are You Sure To Make This Order Delivered..!')">delivered</a>

                            @else

                            <p style="color: green">delivered</p>

                            @endif

                        </td>
                        <td>
                            <a href="{{ url('print_pdf',$order->id) }}" class="btn btn-secondary">Print PDF</a>
                        </td>
                        <td>
                            <a href="{{ url('send_email',$order->id) }}" class="btn btn-info">Send Email</a>

                        </td>
                       
                    </tr>
                @empty
                    <tr>
                        <td colspan="16">
                            No Data Found
                        </td>
                    </tr>

                    @endforelse
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