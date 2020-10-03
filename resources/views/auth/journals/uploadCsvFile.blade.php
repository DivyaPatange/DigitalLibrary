@extends('auth.authLayouts.main')
@section('title', 'Journals')
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
  <h1 class="h3 mb-2 text-gray-800">Journals</h1>
  <div class="row justify-content-center">
    <div class="col-lg-12">
      <!-- Basic Card Example -->
      <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-primary mt-3 mb-3">
        Import CSV File
    </button>
    <button type="button" data-toggle="modal" data-target="#addJournal" class="btn btn-primary mt-3 mb-3">
       Add Journal
    </button>
    </div>
  </div>
  <!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Upload CSV File</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
    <form action="{{ url('/admin/uploadFile') }}" enctype="multipart/form-data" method="POST">
    @csrf
      <!-- Modal body -->
      <div class="modal-body">
      <div class="form-group">
        <input type="file" name="file" class="@error('file') is-invalid @enderror">
        </div>
      @error('file')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
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
      <h6 class="m-0 font-weight-bold text-primary">Journals List</h6>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Sr. No.</th>
              <th>Registration No</th>
              <th>Author Name</th>
              <th>Name</th>
              <th>Publisher</th>
              <th>Seller</th>
              <th>Action</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Sr. No.</th>
              <th>Registration No</th>
              <th>Author Name</th>
              <th>Name</th>
              <th>Publisher</th>
              <th>Seller</th>
              <th>Action</th>
            </tr>
          </tfoot>
          <tbody>
            @foreach($journals as $key => $j)
            <tr>
              <td>{{ ++$key }}</td>
              <td>{{ $j->registration_no }}</td>
              <td>{{ $j->author_name }}</td>
              <td>{{ $j->name }}</td>
              <td>{{ $j->publisher }}</td>
              <td>{{ $j->seller }}</td>
              <td>
                <a href="{{ url('/admin/edit-journal', $j->id) }}" class="btn btn-warning btn-circle">
                  <i class="fas fa-edit"></i>
                </a>
                <a href="javascript:void(0)" onclick="$(this).parent().find('form').submit()" class="btn btn-danger btn-circle">
                  <i class="fas fa-trash"></i>
                </a>
                <form action="{{ route('admin.journals.destroy', $j->id) }}" method="post">
                  @method('DELETE')
                  <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </form>
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
@endsection