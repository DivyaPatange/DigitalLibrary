@extends('auth.authLayouts.main')
@section('title', 'Student Book Issue')
@section('customcss')

<link href="{{ asset('adminAsset/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endsection
@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">
  @if ($message = Session::get('success'))
  <div class="alert alert-success alert-block mt-4">
    <button type="button" class="close" data-dismiss="alert">×</button>	
          <strong>{{ $message }}</strong>
  </div>
  @endif
  @if ($message = Session::get('danger'))
  <div class="alert alert-danger alert-block mt-4">
    <button type="button" class="close" data-dismiss="alert">×</button>	
          <strong>{{ $message }}</strong>
  </div>
  @endif
  <!-- Page Heading -->
  <h1 class="h3 mb-2 text-gray-800">Student Book Issue</h1>
  <div class="row justify-content-center">
    <div class="col-lg-12">
      <!-- Basic Card Example -->
    <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary mt-3 mb-3">
        Issue Book
    </button>
    </div>
  </div>
  <!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">New Book Issue</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
    <form action="" enctype="multipart/form-data" method="POST">
    @csrf
        <!-- Modal body -->
        <div class="modal-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                      <label>BT Card No.</label>
                      <input type="text" class="form-control form-control-user @error('BT_no') is-invalid @enderror" name="BT_no" id="BT_no" >
                    </div>
                    @error('BT_no')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <h3 id="student_name"></h3>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                      <label>Book Code</label>
                      <input type="text" class="form-control form-control-user @error('book_code') is-invalid @enderror" name="book_code" id="book_code" >
                    </div>
                    @error('book_code')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <h4 id="book_name"></h4>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
            <input type="submit" class="btn btn-success" name="submit" value="Save">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
    </form>
    </div>
  </div>
</div>

  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Book List</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Sr. No.</th>
              <th>BT Card No.</th>
              <th>Book Code</th>
              <th>Issue Date</th>
              <th>Expected Return Date</th>
              <th>Actual Return Date</th>
              <th>Action</th>
              <th>Renew</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
            <th>Sr. No.</th>
              <th>BT Card No.</th>
              <th>Book Code</th>
              <th>Issue Date</th>
              <th>Expected Return Date</th>
              <th>Actual Return Date</th>
              <th>Action</th>
              <th>Renew</th>
            </tr>
          </tfoot>
          <tbody>
            @foreach($bookTransaction as $key => $l)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $l->book_code }}</td>
                <td>{{ $l->book_no }}</td>
                <td>{{ $l->author_name }}</td>
                <td>{{ $l->book_name }}</td>
                <td>{{ $l->price }}</td>
                <td>{{ $l->publication }}</td>
                <td>
                <a href="#" class="btn btn-warning btn-circle">
                  <i class="fas fa-edit"></i>
                </a>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->
@endsection
@section('customjs')
<!-- Page level plugins -->
<script src="{{ asset('adminAsset/vendor/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminAsset/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('adminAsset/js/demo/datatables-demo.js') }}"></script>
<script>
$(document).ready(function() {
        $('#dataTable').DataTable();
    } );
</script>
<script>
$(document).ready(function () {
    // keyup function looks at the keys typed on the search box
    $('#BT_no').on('keyup',function() {
        // the text typed in the input field is assigned to a variable 
        var query = $(this).val();
        // call to an ajax function
        $.ajax({
            // assign a controller function to perform search action - route name is search
            url:"{{ route('admin.searchStudentBTCard') }}",
            // since we are getting data methos is assigned as GET
            type:"GET",
            // data are sent the server
            data:{'BT_no':query},
            // if search is succcessfully done, this callback function is called
            success:function (data) {
                // print the search results in the div called country_list(id)
                $('#student_name').html(data);
            }
        })
        // end of ajax call
    });
})
</script>
<script>
$(document).ready(function () {
    // keyup function looks at the keys typed on the search box
    $('#book_code').on('keyup',function() {
        // the text typed in the input field is assigned to a variable 
        var query = $(this).val();
        // call to an ajax function
        $.ajax({
            // assign a controller function to perform search action - route name is search
            url:"{{ route('admin.searchBookCode') }}",
            // since we are getting data methos is assigned as GET
            type:"GET",
            // data are sent the server
            data:{'book_code':query},
            // if search is succcessfully done, this callback function is called
            success:function (data) {
                // print the search results in the div called country_list(id)
                $('#book_name').html(data);
            }
        })
        // end of ajax call
    });
})
</script>

@endsection