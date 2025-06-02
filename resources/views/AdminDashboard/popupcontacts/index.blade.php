@extends('AdminDashboard.master')

@section('title', 'Popup Leads')

@section('breadcrumb-title')
    <h3>Popup Contact Leads</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Contacts</li>
    <li class="breadcrumb-item active">All</li>
@endsection

@section('content')
<div class="container-fluid">
    @if (session('success'))
        <div class="alert alert-success ">{{ session('success') }}</div>
    @endif

    <!-- Filter Form -->
    <div class="card mb-3" >
        <div class="card-body" style="margin-top:30px;">
            <form method="GET" action="{{ route('popupcontacts.index') }}" class="row g-3 align-items-end">
                <div class="col-md-4">
                    <label for="from_date" class="form-label">From Date</label>
                    <input type="date" name="from_date" id="from_date" class="form-control" value="{{ request('from_date') }}">
                </div>
                <div class="col-md-4">
                    <label for="to_date" class="form-label">To Date</label>
                    <input type="date" name="to_date" id="to_date" class="form-control" value="{{ request('to_date') }}">
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Filter</button>
                    <a href="{{ route('popupcontacts.index') }}" class="btn btn-secondary">Reset</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Leads Table -->
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>All Popup Contact Leads</h5>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Contact Number</th>
                            <th>Submitted At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($leads as $index => $lead)
                            <tr>
                                <td>{{ $index + $leads->firstItem() }}</td>
                                <td>{{ $lead->name }}</td>
                                <td>{{ $lead->phone }}</td>
                                <td>{{ $lead->created_at->format('F d, Y h:i A') }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-muted">No leads found.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $leads->withQueryString()->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
