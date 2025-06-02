<div class="table-responsive">
    <table class="table table-bordered text-center align-middle">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Student</th>
                <th>Course</th>
                <th>Payment</th>
                <th>Method</th>
                <th>Transfer Date</th>
                <th>Receipt</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($bookings as $index => $booking)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $booking->customer->name ?? 'N/A' }}</td>
                    <td>{{ $booking->course->name ?? 'N/A' }}</td>
                    <td>{{ ucfirst($booking->payment_status) }}</td>
                    <td>{{ $booking->payment_method }}</td>
                    <td>{{ $booking->transfer_date ?? 'N/A' }}</td>
                    <td>
                        @if($booking->receipt_path)
                            <a href="{{ route('admin.orders.show', $booking->id) }}" class="btn btn-sm btn-info">View</a>
                        @else
                            <span class="text-muted">No Receipt</span>
                        @endif
                    </td>
                    <td><span class="badge bg-warning">{{ $booking->status }}</span></td>
                    <td>
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#updateBookingModal{{ $booking->id }}">Process</button>
                    </td>
                </tr>

                <!-- Modal -->
                <div class="modal fade" id="updateBookingModal{{ $booking->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <form action="{{ route('admin.orders.updateBooking', $booking->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Process Booking</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                </div>
                                <div class="modal-body">
                                    <p><strong>Customer:</strong> {{ $booking->customer->name }}</p>
                                    <p><strong>Course:</strong> {{ $booking->course->name }}</p>

                                    @if ($booking->receipt_path)
                                        <p><strong>Receipt:</strong> <a href="{{ asset('storage/' . $booking->receipt_path) }}" target="_blank">View</a></p>
                                    @endif

                                    <div class="mb-3">
                                        <label class="form-label">Payment Status</label>
                                        <select name="status" class="form-control">
                                            <option value="Pending" {{ $booking->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="Half" {{ $booking->status == 'Half' ? 'selected' : '' }}>Half</option>
                                            <option value="Confirmed" {{ $booking->status == 'Confirmed' ? 'selected' : '' }}>Confirmed</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">Assign Batch</label>
                                        <select name="batch_id" class="form-control">
                                            <option value="">-- Select Batch --</option>
                                            @foreach ($booking->course->batches as $batch)
                                                <option value="{{ $batch->id }}" {{ $booking->customer->batch_id == $batch->id ? 'selected' : '' }}>
                                                    {{ $batch->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success">Update</button>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @empty
                <tr>
                    <td colspan="9" class="text-muted">No records found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
