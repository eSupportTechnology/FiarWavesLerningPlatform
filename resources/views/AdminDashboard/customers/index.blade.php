@extends('AdminDashboard.master')

@section('title', 'Customer Management')

@section('breadcrumb-title')
    <h3>All Customers</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Users</li>
    <li class="breadcrumb-item active">Customers</li>
@endsection

@section('content')
<div class="container-fluid">

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Customer List</h5>
            <!-- Optional: Add Customer -->
            {{-- <a href="{{ route('admin.customers.create') }}" class="btn btn-primary">+ Add Customer</a> --}}
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-center">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Status</th>
                            <th>Assigned Batches</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($customers as $index => $customer)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $customer->stu_id }}</td>
                                <td>{{ $customer->name }}</td>
                                <td>{{ $customer->email }}</td>
                                <td>{{ $customer->contact_number }}</td>
                                <td>
                                    <span class="badge bg-{{ $customer->status ? 'success' : 'secondary' }}">
                                        {{ $customer->status ? 'Active' : 'Inactive' }}
                                    </span>
                                </td>
                                <td>
                                    @if($customer->assignedBatches->count())
                                        <ul class="list-unstyled mb-0">
                                            @foreach ($customer->assignedBatches as $assign)
                                                <li>
                                                    <button class="btn btn-sm btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#batchModal{{ $assign->id }}">
                                                        {{ $assign->course->name ?? 'Course' }} ({{ $assign->batch->name ?? 'Batch' }})
                                                    </button>

                                                    <!-- Modal -->
                                                    <div class="modal fade" id="batchModal{{ $assign->id }}" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <form action="{{ route('admin.batches.updateBatch', $assign->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Update Batch for {{ $assign->course->name ?? 'Course' }}</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="mb-3">
                                                                            <label for="batchSelect{{ $assign->id }}" class="form-label">Select New Batch</label>
                                                                            <select name="batch_id" id="batchSelect{{ $assign->id }}" class="form-select" required>
                                                                                <option value="">-- Choose Batch --</option>
                                                                                @foreach ($assign->course->batches as $batch)
                                                                                    <option value="{{ $batch->id }}" {{ $assign->batch_id == $batch->id ? 'selected' : '' }}>
                                                                                        {{ $batch->name }}
                                                                                    </option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <span class="text-muted">No batch assigned</span>
                                    @endif
                                </td>

                                <td class="d-flex flex-wrap justify-content-center gap-2">
                                    <form action="{{ route('admin.customers.toggleStatus', $customer->user_id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-{{ $customer->status ? 'warning' : 'success' }}">
                                            {{ $customer->status ? 'Deactivate' : 'Activate' }}
                                        </button>
                                    </form>

                                    <a href="{{ route('admin.customers.show', $customer->user_id) }}" class="btn btn-sm btn-info">
                                        View More
                                    </a>

                                    <form action="{{ route('admin.customers.destroy', $customer->user_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this customer?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">No customers found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $customers->links() }}
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
