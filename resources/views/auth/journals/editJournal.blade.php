@extends('auth.authLayouts.main')
@section('title', 'Edit Journal')
@section('customcss')
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
  <div class="row justify-content-center">
    <div class="col-lg-12">
      <!-- Basic Card Example -->
      <div class="card shadow mb-4">
        <div class="card-header">
          Edit Journal
        </div>
        <div class="card-body">
            <form method="post" action="{{ route('admin.journals.update', $journal->id) }}" enctype="multipart/form-data">
            @csrf 
            @method('PUT')
            <div class="form-group">
            <input type="text" class="form-control form-control-user @error('journal_title') is-invalid @enderror" name="journal_title" id="exampleInputName" placeholder="Journal Title" value="">
                 @error('journal_type')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-group ">
              <input type="text" class="form-control form-control-user @error('journal_title') is-invalid @enderror" name="journal_title" id="exampleInputName" placeholder="Journal Title" value="">
              @error('journal_title')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-group ">
              <input type="file" class="form-control form-control-user @error('file') is-invalid @enderror" name="file" id="exampleInputName">
              @error('file')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-group ">
            
                  </div>
            <button type="submit" class="btn btn-primary btn-user btn-block">
              Update
            </button>
            </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->
@endsection
@section('customjs')
<!-- Page level plugins -->
@endsection