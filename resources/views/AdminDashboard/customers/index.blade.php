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
                                <th>Bank Status</th>
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

                                    <td>
                                        <span class="badge bg-{{ $customer->bank_status ? 'success' : 'warning' }}">
                                            @if (is_null($customer->bank_status))
                                                Not Applied
                                            @elseif ($customer->bank_status == 'approved')
                                                Approved
                                            @elseif ($customer->bank_status == 'rejected')
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

                                        <!-- Edit Button -->
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#editCustomerModal{{ $customer->user_id }}">
                                            Edit
                                        </button>

                                        <!-- Edit Customer Modal -->
                                        <div class="modal fade" id="editCustomerModal{{ $customer->user_id }}" tabindex="-1" aria-labelledby="editCustomerModalLabel{{ $customer->user_id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <form action="{{ route('admin.customers.update', $customer->user_id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editCustomerModalLabel{{ $customer->user_id }}">Edit Customer</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body row g-3">
                                                            <div class="col-md-6">
                                                                <label class="form-label">First Name</label>
                                                                <input type="text" name="fname" class="form-control" value="{{ $customer->fname }}" required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Last Name</label>
                                                                <input type="text" name="lname" class="form-control" value="{{ $customer->lname }}" required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Email</label>
                                                                <input type="email" name="email" class="form-control" value="{{ $customer->email }}" required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Contact Number</label>
                                                                <input type="text" name="contact_number" class="form-control" value="{{ $customer->contact_number }}" required>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Address</label>
                                                                <input type="text" name="address" class="form-control" value="{{ $customer->address }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Street</label>
                                                                <input type="text" name="street" class="form-control" value="{{ $customer->street }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">City</label>
                                                                <input type="text" name="city" class="form-control" value="{{ $customer->city }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">District</label>
                                                                <input type="text" name="district" class="form-control" value="{{ $customer->district }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Postal Code</label>
                                                                <input type="text" name="postal_code" class="form-control" value="{{ $customer->postal_code }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Bank Name</label>
                                                                <input type="text" name="bank_name" class="form-control" value="{{ $customer->bank_name }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Bank Branch</label>
                                                                <input type="text" name="bank_branch" class="form-control" value="{{ $customer->bank_branch }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Account Name</label>
                                                                <input type="text" name="account_name" class="form-control" value="{{ $customer->account_name }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Account Number</label>
                                                                <input type="text" name="account_number" class="form-control" value="{{ $customer->account_number }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Account Type</label>
                                                                <input type="text" name="account_type" class="form-control" value="{{ $customer->account_type }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Bank Front Image</label>
                                                                <input type="file" name="bank_front_image" class="form-control">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Bank Back Image</label>
                                                                <input type="file" name="bank_back_image" class="form-control">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Bank Status</label>
                                                                <select name="bank_status" class="form-select">
                                                                    <option value="" {{ is_null($customer->bank_status) ? 'selected' : '' }}>Not Applied</option>
                                                                    <option value="approved" {{ $customer->bank_status == 'approved' ? 'selected' : '' }}>Approved</option>
                                                                    <option value="rejected" {{ $customer->bank_status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                                                    <option value="pending" {{ $customer->bank_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">KYC Document Type</label>
                                                                <select name="kyc_doc_type" class="form-select">
                                                                    <option value="" {{ is_null($customer->kyc_doc_type) ? 'selected' : '' }}>Select</option>
                                                                    <option value="NIC" {{ $customer->kyc_doc_type == 'NIC' ? 'selected' : '' }}>NIC</option>
                                                                    <option value="DL" {{ $customer->kyc_doc_type == 'DL' ? 'selected' : '' }}>DL</option>
                                                                    <option value="Passport" {{ $customer->kyc_doc_type == 'Passport' ? 'selected' : '' }}>Passport</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">KYC Document Number</label>
                                                                <input type="text" name="kyc_doc_number" class="form-control" value="{{ $customer->kyc_doc_number }}">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">KYC Front Image</label>
                                                                <input type="file" name="kyc_doc_front" class="form-control">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">KYC Back Image</label>
                                                                <input type="file" name="kyc_doc_back" class="form-control">
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">KYC Status</label>
                                                                <select name="kyc_status" class="form-select">
                                                                    <option value="" {{ is_null($customer->kyc_status) ? 'selected' : '' }}>Not Applied</option>
                                                                    <option value="approved" {{ $customer->kyc_status == 'approved' ? 'selected' : '' }}>Approved</option>
                                                                    <option value="rejected" {{ $customer->kyc_status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                                                    <option value="pending" {{ $customer->kyc_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <label class="form-label">Status</label>
                                                                <select name="status" class="form-select">
                                                                    <option value="1" {{ $customer->status ? 'selected' : '' }}>Active</option>
                                                                    <option value="0" {{ !$customer->status ? 'selected' : '' }}>Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-success">Save Changes</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>

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

                    <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
                        <div>
                            <small>
                                Showing
                                @if ($customers->total() > 0)
                                    {{ $customers->firstItem() }} to {{ $customers->lastItem() }} of {{ $customers->total() }} entries
                                @else
                                    0 entries
                                @endif
                            </small>
                        </div>
                        <div>
                            {{ $customers->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
