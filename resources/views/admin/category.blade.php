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
    width: 50%;
    text-align: center;
    margin-top: 30px;
    border: 3px solid green;
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

                @if (session()->has('massage'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ session()->get('massage') }}
                </div>  
                @endif
                @if (session()->has('delete'))
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    {{ session()->get('delete') }}
                </div>  
                @endif


            <div class="div_center">

                <h2 class="h2_font">Add Category</h2>

                <form action="{{ url("/add_category") }}" method="POST">
                    @csrf
                    <input type="text" name="category_name" placeholder="write category name">
                    <input type="submit" class="btn btn-primary" name="submit" value="add category">
                </form>
            </div>
            <table class="center">

                <tr>
                    <th>#</th>
                    <th>Category Name</th>
                    <th>Action</th>
                </tr>
                
                <?php $i=0 ?>
                @foreach ($data as $data)
                    <?php $i++ ?>
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $data->category_name }}</td>
                    <td>
                        <a onclick="return confirm('are you sure to delete this')" class="btn btn-danger" href="{{url("/delete_category",$data->id)}}">Delete</a>
                    </td>
                </tr>
            
                @endforeach
            </table>
        </div>
        </div>
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
   @include('admin.js')
  </body>
</html>