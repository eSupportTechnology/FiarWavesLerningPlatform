@php
    // Get relationships
    $left = $customer->leftChild ?? null;
    $right = $customer->rightChild ?? null;
    $sponsor = $customer->sponsor ?? null;

    $hasChildren = $left || $right;
    $currentLevel = $level ?? 0;
@endphp

<div class="tree-node level-{{ $currentLevel }}" data-id="{{ $customer->id }}">
    {{-- Node Content --}}
    <div class="node-content" onclick="centerNode(this)">
        <div class="node-name">
            <i class="bi bi-person-fill me-1"></i>
            Name :{{ $customer->name ?? 'Unknown' }}
        </div>
        <div class="node-id">UID :{{ $customer->invite_code ?? 'N/A' }}</div>

        @if($sponsor)
            <div class="node-sponsor">
                <i class="bi bi-arrow-up me-1"></i>
                SID :{{ $sponsor->invite_code }}
            </div>
        @elseif($currentLevel === 0)
            <div class="node-sponsor">
                <i class="bi bi-star-fill me-1"></i>
                Root Member
            </div>
        @endif
    </div>

    {{-- Children --}}
    @if($hasChildren && $currentLevel < ($performanceLimit ?? 10))
        <div class="children">
            {{-- Left Child --}}
            @if($left)
                @include('AdminDashboard.customers.partial.tree-node', [
                    'customer' => $left,
                    'level' => $currentLevel + 1,
                    'performanceLimit' => $performanceLimit
                ])
            @endif

            {{-- Right Child --}}
            @if($right)
                @include('AdminDashboard.customers.partial.tree-node', [
                    'customer' => $right,
                    'level' => $currentLevel + 1,
                    'performanceLimit' => $performanceLimit
                ])
            @endif
        </div>
    @endif
</div>

@if($currentLevel === 0)
<script>
    function centerNode(element) {
        element.scrollIntoView({
            behavior: 'smooth',
            block: 'center',
            inline: 'center'
        });
    }

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        const focused = document.activeElement.closest('.tree-node');
        if (!focused) return;

        switch(e.key) {
            case 'ArrowUp':
                navigateToParent(focused);
                break;
            case 'ArrowDown':
                navigateToChild(focused);
                break;
        }
    });

    function navigateToParent(node) {
        const parent = node.parentElement.closest('.tree-node');
        if (parent) {
            centerNode(parent.querySelector('.node-content'));
        }
    }

    function navigateToChild(node) {
        const firstChild = node.querySelector('.tree-node');
        if (firstChild) {
            centerNode(firstChild.querySelector('.node-content'));
        }
    }
</script>
@endif
