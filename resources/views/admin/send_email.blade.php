<!DOCTYPE html>
<html lang="en">

<head>
    <base href="/public">
    @include('admin.css')
    <style type="text/css">
        label {
            display: inline-block;
            width: 200px;
            font-size: 15px;
            font-weight: bold;
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

                    <h3 style="text-align: center; font-size:25px;">Send Email To {{ $order->email }}</h3>



                    <form action="{{ url('send_user_email', $order->id) }}" method="POST">

                        @csrf
                        <div style="padding-left: 35%; padding-top:30px;">
                            <label>Email Greeting :</label>
                            <input type="text" name="greeting">

                        </div>

                        <div style="padding-left: 35%; padding-top:30px;">
                            <label>Email Firstline :</label>
                            <input type="text" name="firstline">

                        </div>

                        <div style="padding-left: 35%; padding-top:30px;">
                            <label>Email Body :</label>
                            <input type="text" name="body">

                        </div>

                        <div style="padding-left: 35%; padding-top:30px;">
                            <label>Email Button Name :</label>
                            <input type="text" name="button">

                        </div>

                        <div style="padding-left: 35%; padding-top:30px;">
                            <label>Email Url :</label>
                            <input type="text" name="url">

                        </div>

                        <div style="padding-left: 35%; padding-top:30px;">
                            <label>Email Lastline :</label>
                            <input type="text" name="lastline">

                        </div>

                        <div style="padding-left: 35%; padding-top:30px;">

                            <input type="submit" value="Send Email" class="btn btn-primary">

                        </div>
                    </form>


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
