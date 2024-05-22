<!DOCTYPE html>
<html>

<head>
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

    <style type="text/css">
    .center{
        text-align: center;
        margin-top: 30px;
        margin: auto;
        width: 70%;
        padding: 30px;
    }
    table {
        border-collapse: collapse;
        width: 100%;
        border: 1px solid black;
    }
    th,td{
        border: 1px solid black;
        padding: 10px;
        text-align: center;
        font-size: 20px;
        font-family: sans-serif;
        color: black;
        background-color: white;
        margin-top: 30px;
        margin-bottom: 30px;
        margin-left: 30px;
        margin-right: 30px;
        border-radius: 10px;
        transition: 0.3s;
    }
    .th{
        background-color:skyblue;
        padding: 10px;
        font-size: 20px; 
    }
    </style>
</head>

<body>
    <div class="hero_area">
        <!-- header section strats -->
        @include('home.header')
        <div class="center">

            <table>
                <tr>
                    <th class="th">Product Title</th>
                    <th class="th">Quantity</th>
                    <th class="th">Price</th>
                    <th class="th">Payment Status</th>
                    <th class="th">Delivery Status</th>
                    <th class="th">Image</th>
                    <th class="th">Cancel Order</th>
                </tr>
                @foreach ($order as $order )
                    
                <tr>
                    <td>{{ $order->product_title }}</td>
                    <td>{{ $order->quantity }}</td>
                    <td>{{ $order->price }}</td>
                    <td>{{ $order->payment_status }}</td>
                    <td>{{ $order->delivery_status }}</td>
                    <td>
                        <img src="/product/{{ $order->image }}" style="width: 100px; height:100px; border:2px solid black  margin-top: 30px;" >
                    </td>
                    <td>
                        @if ($order->delivery_status=='processing')
                        <a onclick="return confirm('Are You Sure To Cancel This Order!!!')" href="{{ url('cancel_order',$order->id) }}" class="btn btn-danger">Cancel Order</a>
                            @else
                            <p style="color: blue;">Not Allowed</p>
                        @endif
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
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
