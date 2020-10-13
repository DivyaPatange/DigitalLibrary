@extends('auth.authLayouts.main')
@section('title', 'Library Accession')
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
    <h1 class="h3 mb-2 text-gray-800">Library Accession</h1>
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
                <div class="card-header">
                    Add Student Library Accession
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('admin.libraryAccession.store') }}">
                    @csrf 
                                <div class="form-group ">
                                    <label>BT Card No.</label>
                                    <input type="text" class="form-control form-control-user @error('BT_no') is-invalid @enderror" name="BT_no" id="BT_no" placeholder="Enter BT Card No." value="{{ old('BT_no') }}">
                                    @error('BT_no')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group ">
                                   <h5 id="student_name"></h5>
                                </div>
                                    <div class="form-group ">
                                        <label>.</label>
                                        <input type="datetime-local" class="form-control form-control-user start_time @error('start_time') is-invalid @enderror" name="start_time" id="start_date" placeholder="Start Time" value="{{ old('start_time') }}">
                                        @error('start_time')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary btn-user">
                                    Add
                                    </button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
    <div class="row">
        <div class="col-md-6">
      <h6 class="m-0 font-weight-bold text-primary">Library Accession List</h6>
      </div>
      <div class="col-md-6">
  <?php   
  $month = date('m');
  $day = date('d');
  $year = date('Y');

  $today = $month . '/' . $day . '/' . $year;
  // dd($today);
  ?>
      <input type="date" value="{{ $today }}" class="form-control form-control-user @error('accession_date') is-invalid @enderror" name="accession_date" id="accession_date" placeholder="Select Date">
    </div>
    </div>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Sr. No.</th>
              <th>BT Card No.</th>
              <th>Name</th>
              <th>Start Time</th>
              <th>End Time</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
            <th>Sr. No.</th>
              <th>BT Card No.</th>
              <th>Name</th>
              <th>Start Time</th>
              <th>End Time</th>
              <th>Action</th>
            </tr>
          </tfoot>
          <tbody id="accession_record">
          @foreach($libraryAccession as $key=> $la)
          <tr>
            <th>{{ ++$key }}</th>
            <th>BT Card No.</th>
            <th>Name</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Action</th>
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
<!-- <script src="{{ asset('adminAsset/js/bootstrap-datetimepicker.js') }}"></script> -->
<!-- <script>
$(function () {
  $(".accession_end_time").datetimepicker({
      format : 'YYYY-MM-DD H:m:s',
      locale : 'en',
  });
});
</script>
<script>
$(function () {
  $('.start_time').datetimepicker({
      format : 'YYYY-MM-DD H:m:s',
      locale : 'en',
  });
});
</script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
   $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});
</script>
<script>
$("#accession_record").on("click",".submit",function(){
    let deleteButton = $(this);
    let id = deleteButton.data('id');
    let end_time = $(".end_time").val();
    // alert(end_time);
		$.ajax({
			url: "{{ url('admin/updateLibraryAccessionTime') }}",
			method:"POST",
			data:{id:id, end_time:end_time},
			success:function(data)
			{
        setTimeout(() => {
                        location.reload();
                    }, 1000);

			}
		});
});
</script>
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
    $('#accession_date').on('change',function() {
        // the text typed in the input field is assigned to a variable 
        var query = $(this).val();
        
        $.ajax({
            // assign a controller function to perform search action - route name is search
            url:"{{ route('admin.searchLibraryAccessionRecord') }}",
            // since we are getting data methos is assigned as GET
            type:"GET",
            // data are sent the server
            data:{'accession_date':query},
            // if search is succcessfully done, this callback function is called
            success:function (data) {
                // print the search results in the div called country_list(id)
                $('#accession_record').html(data);
            }
        })

    });
  });
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
@endsection
