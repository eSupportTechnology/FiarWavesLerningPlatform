@php
    $left = \App\Models\Customer::where('user_id', $customer->left_child_id)->first();
    $right = \App\Models\Customer::where('user_id', $customer->right_child_id)->first();
@endphp

<div class="d-flex flex-column align-items-center">
    {{-- Current customer --}}
    <div class="card shadow mb-3" style="min-width: 180px;">
        <div class="card-body p-2 text-center">
            <h6 class="mb-1">{{ $customer->name ?? 'N/A' }}</h6>
            <small class="text-muted">UID: {{ $customer->invite_code }}</small><br>
            @php
                $sponsor = $customer->sponsor_id ? \App\Models\Customer::where('user_id', $customer->sponsor_id)->first() : null;
            @endphp
            <small class="text-muted">
                Sponsor UID: {{ $sponsor ? $sponsor->invite_code : 'N/A' }}
            </small>
        </div>
    </div>

    {{-- Children (side-by-side, even if one is empty) --}}
    <div class="d-flex justify-content-between align-items-start mt-4" style="min-width: 400px; gap: 60px;">
        <div class="d-flex flex-column align-items-center">
            @if($left)
                @include('AdminDashboard.customers.partial.tree-node', ['customer' => $left])
            @else
                <div class="card text-center p-3 shadow-sm bg-light border border-secondary-subtle" style="min-width: 120px;">
                    <div class="text-muted">
                        <i class="bi bi-person-x fs-3 mb-2"></i>
                        <div>No Left Child</div>
                        <small class="d-block">Slot Available</small>
                    </div>
                </div>
            @endif
        </div>
        <div class="d-flex flex-column align-items-center">
            @if($right)
                @include('AdminDashboard.customers.partial.tree-node', ['customer' => $right])
            @else
                <div class="card text-center p-3 shadow-sm bg-light border border-secondary-subtle" style="min-width: 120px;">
                    <div class="text-muted">
                        <i class="bi bi-person-x fs-3 mb-2"></i>
                        <div>No Right Child</div>
                        <small class="d-block">Slot Available</small>
                    </div>
                </div>
            @endif
        </div>
    </div>

</div>
