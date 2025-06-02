@extends('AdminDashboard.master')

@section('title', 'Add Ad Banner')

@section('breadcrumb-title')
    <h3>Add New Banner</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item"><a href="{{ route('admin.banners.index') }}">Ad Banners</a></li>
    <li class="breadcrumb-item active">Create</li>
@endsection

@section('content')
<div class="container-fluid">

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error!</strong> Please check your input.<br><br>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h5>New Banner</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.adbanners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="image" class="form-label">Banner Image <span class="text-danger">*</span></label>
                    <input type="file" name="image" class="form-control" required accept="image/*">
                </div>

                <div class="mb-3">
                    <label for="caption" class="form-label">Caption</label>
                    <input type="text" name="caption" class="form-control" placeholder="E.g. Join our Binance class...">
                </div>

                <div class="text-end">
                    <a href="{{ route('admin.adbanners.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-success">Save Banner</button>
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
