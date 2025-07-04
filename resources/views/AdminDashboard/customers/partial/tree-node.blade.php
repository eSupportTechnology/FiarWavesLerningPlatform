@php
    $left = $customer->leftChild ?? null;
    $right = $customer->rightChild ?? null;
    $sponsor = $customer->sponsor ?? null;
    $currentLevel = $level ?? 0;
@endphp

<div class="tree-node level-{{ $currentLevel }}" data-id="{{ $customer->id }}">
    <div class="node-content" onclick="centerNode(this)">
        <div class="node-name">{{ $customer->name ?? 'Unknown' }}
            @if(isset($customer->status) && $customer->status == 1)
            <span class="status-bulb" style="color:green;">&#128994;</span>
            @else
            <span class="status-bulb" style="color:red;">&#128308;</span>
            @endif
        </div>
        <div class="node-id">UID :{{ $customer->invite_code  }}</div>
        {{-- <div class="node-bv">-3.60 BV</div> --}}
        @if($sponsor)
            <div class="node-sponsor">SID: {{ $sponsor->invite_code }}</div>
        @elseif($currentLevel === 0)
            <div class="node-sponsor">Root Member</div>
        @endif
    </div>

    @if($currentLevel < ($performanceLimit ?? 10))
    <div class="children">
        {{-- Left Child -- Always rendered --}}
        <div class="tree-node level-{{ $currentLevel + 1 }}">
            @if($left)
                @include('AdminDashboard.customers.partial.tree-node', [
                    'customer' => $left,
                    'level' => $currentLevel + 1,
                    'performanceLimit' => $performanceLimit
                ])
            @else
                <div class="empty-slot">No assigned</div>
            @endif
        </div>

        {{-- Right Child -- Always rendered --}}
        <div class="tree-node level-{{ $currentLevel + 1 }}">
            @if($right)
                @include('AdminDashboard.customers.partial.tree-node', [
                    'customer' => $right,
                    'level' => $currentLevel + 1,
                    'performanceLimit' => $performanceLimit
                ])
            @else
                <div class="empty-slot">No assigned</div>
            @endif
        </div>
    </div>
    @endif
</div>

<script>
    function centerNode(element) {
        element.scrollIntoView({
            behavior: 'smooth',
            block: 'center',
            inline: 'center'
        });
    }
</script>
