@extends('AdminDashboard.master')

@section('title', 'Edit Contact')

@section('breadcrumb-title')
    <h3>Edit Contact</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Call Center</li>
    <li class="breadcrumb-item active">Edit Contact</li>
@endsection

@section('content')
<div class="container-fluid">
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Please fix the following errors:
            <ul class="mt-2 mb-0">
                @foreach ($errors->all() as $error)
                    <li class="small">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h5>Edit Call Center Contact</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.callcenter.update', $contact->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Contact Name <span class="text-danger">*</span></label>
                    <input type="text" name="name" id="name" class="form-control"
                           value="{{ old('name', $contact->name) }}" required>
                </div>

                <div class="mb-3">
                    <label for="phone_number" class="form-label">Phone Number <span class="text-danger">*</span></label>
                    <input type="text" name="phone_number" id="phone_number" class="form-control"
                           value="{{ old('phone_number', $contact->phone_number) }}" required>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.callcenter.index') }}" class="btn btn-secondary">Back</a>
                    <button type="submit" class="btn btn-primary">Update Contact</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
