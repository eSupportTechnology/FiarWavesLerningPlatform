@extends('StudentDashboard.master')

@section('content')
<div class="container-fluid">

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5>Invitees List</h5>
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
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($invitees as $index => $customer)
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


                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">No invitees found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-3">
                    {{ $invitees->links() }}
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
