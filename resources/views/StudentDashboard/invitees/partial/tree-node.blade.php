@php
    $left = \App\Models\Customer::where('user_id', $customer->left_child_id)->first();
    $right = \App\Models\Customer::where('user_id', $customer->right_child_id)->first();
    $sponsor = $customer->sponsor_id ? \App\Models\Customer::where('user_id', $customer->sponsor_id)->first() : null;

    // Check if we have any children
    $hasChildren = $left || $right;

    // Dynamic max depth based on user preference or default to unlimited
    $maxDepth = $maxDepth ?? 999;
    $currentLevel = $level ?? 0;

    // For performance, we can add a reasonable limit but make it configurable
    $performanceLimit = $performanceLimit ?? 15;
@endphp

<div class="tree-node level-{{ $currentLevel }}" data-level="{{ $currentLevel }}">
    {{-- Current Node --}}
    <div class="node-content" title="Click to center view" onclick="centerNode(this)">
        <div class="node-name">
            <i class="bi bi-person-circle me-1"></i>
            {{ $customer->name ?? 'Unknown User' }}
        </div>
        <div class="node-id">{{ $customer->invite_code }}</div>
        <div class="node-sponsor">
            @if($sponsor)
                <i class="bi bi-arrow-up-circle me-1"></i>{{ $sponsor->invite_code }}
            @else
                <i class="bi bi-star-fill me-1"></i>ROOT
            @endif
        </div>

        {{-- Additional info for root level --}}
        @if($currentLevel === 0)
            <div class="mt-2" style="font-size: 10px; opacity: 0.8;">
                <i class="bi bi-people-fill me-1"></i>
                {{ ($left ? 1 : 0) + ($right ? 1 : 0) }} Direct Children
            </div>
        @endif

        {{-- Show level indicator for deep levels --}}
        @if($currentLevel > 3)
            <div class="mt-1" style="font-size: 9px; opacity: 0.7; background: rgba(255,255,255,0.3); padding: 2px 6px; border-radius: 8px;">
                Level {{ $currentLevel }}
            </div>
        @endif
    </div>

    {{-- Children (maintain left/right positioning) --}}
    @if($hasChildren && $currentLevel < $performanceLimit)
        <div class="children {{ (!$left || !$right) ? 'single-child' : '' }}">

            {{-- LEFT CHILD - Always show in left position --}}
            @if($left)
                @include('StudentDashboard.invitees.partial.tree-node', [
                    'customer' => $left,
                    'level' => $currentLevel + 1,
                    'maxDepth' => $maxDepth,
                    'performanceLimit' => $performanceLimit
                ])
            @elseif($currentLevel < 4)
                {{-- Show empty left slot --}}
                <div class="tree-node level-{{ $currentLevel + 1 }}">
                    <div class="node-content empty" title="Left position available">
                        <div class="node-name">
                            <i class="bi bi-plus-circle-dotted"></i>
                        </div>
                        <div class="node-id">Left Available</div>
                        <div class="node-sponsor">Open Position</div>
                    </div>
                </div>
            @endif

            {{-- RIGHT CHILD - Always show in right position --}}
            @if($right)
                @include('StudentDashboard.invitees.partial.tree-node', [
                    'customer' => $right,
                    'level' => $currentLevel + 1,
                    'maxDepth' => $maxDepth,
                    'performanceLimit' => $performanceLimit
                ])
            @elseif($currentLevel < 4)
                {{-- Show empty right slot --}}
                <div class="tree-node level-{{ $currentLevel + 1 }}">
                    <div class="node-content empty" title="Right position available">
                        <div class="node-name">
                            <i class="bi bi-plus-circle-dotted"></i>
                        </div>
                        <div class="node-id">Right Available</div>
                        <div class="node-sponsor">Open Position</div>
                    </div>
                </div>
            @endif

        </div>

    @elseif($currentLevel > 0 && !$hasChildren)
        {{-- Show leaf node indicator --}}
        <div class="mt-1">
            <div class="leaf-indicator" style="font-size: 10px; opacity: 0.6; color: #10ac84;">
                <i class="bi bi-check-circle-fill"></i> Leaf Node
            </div>
        </div>
    @endif
</div>

{{-- Add this script section at the end of the file --}}
@if($currentLevel === 0)
<script>
// Function to center a node in view
function centerNode(element) {
    element.scrollIntoView({
        behavior: 'smooth',
        block: 'center',
        inline: 'center'
    });
}

// Add keyboard shortcuts for tree navigation
document.addEventListener('keydown', function(e) {
    if (e.target.matches('input, textarea')) return;

    switch(e.key) {
        case 'ArrowUp':
            e.preventDefault();
            navigateToParent();
            break;
        case 'ArrowDown':
            e.preventDefault();
            navigateToChild();
            break;
        case 'ArrowLeft':
            e.preventDefault();
            navigateToSibling('left');
            break;
        case 'ArrowRight':
            e.preventDefault();
            navigateToSibling('right');
            break;
        case 'Home':
            e.preventDefault();
            document.querySelector('.level-0 .node-content').click();
            break;
    }
});

function navigateToParent() {
    const focused = document.activeElement;
    if (focused.classList.contains('node-content')) {
        const parentNode = focused.closest('.tree-node').parentElement.closest('.tree-node');
        if (parentNode) {
            parentNode.querySelector('.node-content').focus();
            parentNode.querySelector('.node-content').click();
        }
    }
}

function navigateToChild() {
    const focused = document.activeElement;
    if (focused.classList.contains('node-content')) {
        const childNode = focused.closest('.tree-node').querySelector('.children .tree-node .node-content');
        if (childNode) {
            childNode.focus();
            childNode.click();
        }
    }
}

function navigateToSibling(direction) {
    const focused = document.activeElement;
    if (focused.classList.contains('node-content')) {
        const currentNode = focused.closest('.tree-node');
        const sibling = direction === 'left' ?
            currentNode.previousElementSibling :
            currentNode.nextElementSibling;

        if (sibling && sibling.classList.contains('tree-node')) {
            const siblingContent = sibling.querySelector('.node-content');
            if (siblingContent) {
                siblingContent.focus();
                siblingContent.click();
            }
        }
    }
}
</script>
@endif
