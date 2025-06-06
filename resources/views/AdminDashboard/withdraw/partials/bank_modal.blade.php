<div class="modal fade" id="bankDetailsModal{{ $withdrawal->id }}" tabindex="-1" aria-labelledby="bankDetailsModalLabel{{ $withdrawal->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bankDetailsModalLabel{{ $withdrawal->id }}">Bank Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Bank Name:</strong> {{ $withdrawal->bank_name ?? 'N/A' }}</p>
                <p><strong>Account Name:</strong> {{ $withdrawal->account_name ?? 'N/A' }}</p>
                <p><strong>Account Number:</strong> {{ $withdrawal->account_number ?? 'N/A' }}</p>
                <p><strong>Branch:</strong> {{ $withdrawal->bank_branch ?? 'N/A' }}</p>
            </div>
        </div>
    </div>
</div>
