@php
    $left = \App\Models\Customer::where('user_id', $customer->left_child_id)->first();
    $right = \App\Models\Customer::where('user_id', $customer->right_child_id)->first();
@endphp

<style>
    .tree-node-container {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .tree-arrows {
        position: absolute;
        top: 100px; /* Adjust based on card height */
        left: 50%;
        transform: translateX(-50%);
        width: 400px; /* Match min-width of children container */
        height: 60px;
        pointer-events: none;
        z-index: 0;
    }
    </style>

    <div class="tree-node-container">
        {{-- Current customer --}}
        <div class="card shadow mb-3" style="min-width: 180px; z-index: 1;">
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

        {{-- SVG Arrows --}}
        <svg class="tree-arrows" viewBox="0 0 400 60">
            <!-- Left arrow -->
            <line x1="200" y1="0" x2="80" y2="60" stroke="#888" stroke-width="2" marker-end="url(#arrowhead)" />
            <!-- Right arrow -->
            <line x1="200" y1="0" x2="320" y2="60" stroke="#888" stroke-width="2" marker-end="url(#arrowhead)" />
            <defs>
                <marker id="arrowhead" markerWidth="8" markerHeight="8" refX="4" refY="4" orient="auto" markerUnits="strokeWidth">
                    <polygon points="0 0, 8 4, 0 8" fill="#888"/>
                </marker>
            </defs>
        </svg>

        {{-- Children --}}
        <div class="d-flex justify-content-between align-items-start mt-4" style="min-width: 400px; gap: 20px; z-index: 1;">
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

