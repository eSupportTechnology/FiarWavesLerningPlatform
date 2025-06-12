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
                                <th>Invite Code</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Contact</th>
                                <th>Status</th>
                                <th>KYC Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($customers as $index => $customer)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $customer->invite_code }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->contact_number }}</td>
                                    <td>
                                        <span class="badge bg-{{ $customer->status ? 'success' : 'secondary' }}">
                                            {{ $customer->status ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge bg-{{ $customer->kyc_status ? 'success' : 'warning' }}">
                                            @if (is_null($customer->kyc_status))
                                                Not Applied
                                            @elseif ($customer->kyc_status == 'approved')
                                                Approved
                                            @elseif ($customer->kyc_status == 'rejected')
                                                Rejected
                                            @else
                                                Pending
                                            @endif

                                        </span>
                                    </td>

                                    <td class="d-flex flex-wrap justify-content-center gap-2">

                                        <form action="{{ route('admin.customers.toggleStatus', $customer->user_id) }}"
                                            method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="btn btn-sm btn-{{ $customer->status ? 'warning' : 'success' }}">
                                                {{ $customer->status ? 'Deactivate' : 'Activate' }}
                                            </button>
                                        </form>

                                        <a href="{{ route('admin.customers.show', $customer->user_id) }}"
                                            class="btn btn-sm btn-info">
                                            View More
                                        </a>

                                        <form action="{{ route('admin.customers.destroy', $customer->user_id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Are you sure you want to delete this customer?');">
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
