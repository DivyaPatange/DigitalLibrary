@extends('auth.authLayouts.main')
@section('title', 'Edit Magazine')
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
    <h1 class="h3 mb-2 text-gray-800">Edit Magazine</h1>
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <!-- Basic Card Example -->
            <div class="card shadow mb-4">
            <div class="card-header">
          Edit Magazine
        </div>
                <div class="card-body">
                    <form method="post" action="{{ route('admin.magazines.update', $magazine->id) }}">
                    @csrf 
                    @method('PUT')
                        <div class="form-group ">
                        <label>Magazine Name</label>
                            <input type="text" class="form-control form-control-user @error('magazine_name') is-invalid @enderror" name="magazine_name" id="exampleInputName" placeholder="Magazine Name" value="{{ $magazine->magazine_name }}">
                            @error('magazine_name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
@endsection