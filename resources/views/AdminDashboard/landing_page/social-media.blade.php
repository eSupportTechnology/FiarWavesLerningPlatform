@extends('AdminDashboard.master')

@section('title', 'Update Landing Page Content')

@section('breadcrumb-title')
    <h3>Social Media Handle</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Social Media Handle</li>
    <li class="breadcrumb-item active">Social Media</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-10">

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Social Media Handles</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.landing.socialMedia', $socialMedia->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        @php
                            $fields = [
                                'facebook_link', 'youtube_link', 'tiktok_link', 'instagram_link', 'whatsapp_link'
                            ];
                        @endphp

                        @foreach($fields as $field)
                            <div class="mb-3">
                                <label class="form-label text-capitalize">
                                    {{ str_replace('_', ' ', $field) }}
                                    @if(in_array($field, ['email', 'number_1', 'main_title'])) <span class="text-danger">*</span> @endif
                                </label>

                                @if(Str::contains($field, ['description']))
                                    <textarea name="{{ $field }}" class="form-control" rows="3">{{ old($field, $socialMedia->$field) }}</textarea>
                                @else
                                    <input type="text" name="{{ $field }}" class="form-control" value="{{ old($field, $socialMedia->$field) }}">
                                @endif
                            </div>
                        @endforeach

                        <div class="text-end">
                            <button type="submit" class="btn btn-success px-4">Update</button>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
