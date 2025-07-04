@extends('StudentDashboard.master')

@section('title', 'Customer Genealogy')

@section('content')
<style>
    /* Main Container */
    .genealogy-container {
        width: 100%;
        height: 80vh;
        overflow: auto;
        padding: 20px;
        background: #f8f9fa;
    }

    /* Tree Wrapper */
    .tree-wrapper {
        display: inline-block;
        min-width: min-content;
        padding: 20px 0;
        transform-origin: top center;
    }

    /* Tree Structure */
    .tree {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
    }

    /* Node Styling */
    .tree-node {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 8px 0;
    }

/* Node content styling - Beautiful modern design */
.node-content {
    background: #ffffff;
    color: #2c3e50;
    border: 2px solid #E85D04;
    padding: 12px 16px;
    border-radius: 12px;
    text-align: center;
    z-index: 2;
    cursor: pointer;
    box-shadow: 0 4px 12px rgba(232, 93, 4, 0.15);
    min-width: 140px;
    box-sizing: border-box;
    transition: all 0.3s ease;
    position: relative;
    font-weight: 500;
}

.node-content:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(232, 93, 4, 0.25);
    border-color: #d34a02;
}

/* Empty slot styling - Beautiful design */
.empty-slot {
    background: #f8f9fa;
    color: #6c757d;
    border: 2px dashed #E85D04;
    padding: 12px 16px;
    border-radius: 12px;
    text-align: center;
    font-style: italic;
    min-width: 140px;
    box-sizing: border-box;
    display: flex;
    align-items: center;
    justify-content: center;
    width: auto;
    min-height: 1.2em;
    transition: all 0.3s ease;
    opacity: 0.7;
}

.empty-slot:hover {
    background: #ffffff;
    opacity: 1;
    border-color: #d34a02;
}

    /* Children Container - Clean layout */
    .children {
        display: flex;
        position: relative;
        margin-top: 25px;
        gap: 15px;
    }

    /* Beautiful Connecting Lines */
    
    /* Main vertical line from parent down */
    .tree-node:not(.level-0)::before {
        content: '';
        position: absolute;
        top: -25px;
        left: 50%;
        width: 3px;
        height: 15px;
        background: linear-gradient(180deg, #E85D04 0%, #d34a02 100%);
        z-index: 1;
        transform: translateX(-50%);
        border-radius: 2px;
    }

    /* Horizontal connecting line between children */
    .children::before {
        content: '';
        position: absolute;
        top: -12px;
        left: 20%;
        right: 20%;
        height: 3px;
        background: linear-gradient(90deg, #E85D04 0%, #d34a02 100%);
        z-index: 1;
        border-radius: 2px;
    }

    /* Vertical drop lines for each child */
    .children .tree-node::after {
        content: '';
        position: absolute;
        top: -12px;
        left: 50%;
        width: 3px;
        height: 12px;
        background: linear-gradient(180deg, #E85D04 0%, #d34a02 100%);
        z-index: 2;
        transform: translateX(-50%);
        border-radius: 2px;
    }

    /* Hide lines for root level */
    .level-0::before,
    .level-0::after {
        display: none !important;
    }

    /* Node content details - Enhanced typography */
    .node-name {
        font-weight: 600;
        margin-bottom: 4px;
        color: #2c3e50;
        font-size: 1rem;
        letter-spacing: 0.3px;
    }

    .node-id, .node-sponsor, .node-bv {
        font-size: 0.85rem;
        color: #6c757d;
        margin-top: 3px;
        font-weight: 500;
    }

    /* Root Node Special Styling - Premium look */
    .level-0 .node-content {
        background: linear-gradient(135deg, #E85D04 0%, #d34a02 100%);
        color: white;
        border: 3px solid #c44b03;
        padding: 16px 20px;
        font-size: 1.1rem;
        box-shadow: 0 6px 20px rgba(232, 93, 4, 0.3);
    }

    .level-0 .node-name {
        color: white;
        font-weight: 700;
        font-size: 1.1rem;
    }

    .level-0 .node-id, 
    .level-0 .node-sponsor, 
    .level-0 .node-bv {
        color: rgba(255, 255, 255, 0.9);
    }

    /* Modern Zoom controls */
.zoom-controls {
    position: fixed;
    bottom: 30px;
    right: 30px;
    z-index: 100;
    display: flex;
    gap: 10px;
    background: rgba(255, 255, 255, 0.95);
    padding: 8px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(10px);
}

.zoom-btn {
    background: linear-gradient(135deg, #E85D04 0%, #d34a02 100%);
    color: white;
    border: none;
    border-radius: 8px;
    width: 40px;
    height: 40px;
    font-size: 18px;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 8px rgba(232, 93, 4, 0.3);
    transition: all 0.3s ease;
}

.zoom-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(232, 93, 4, 0.4);
}

.zoom-btn:active {
    transform: translateY(0);
}

/* Enhanced card styling */
.card {
    border: none;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

.card-header {
    background: linear-gradient(135deg, #1a1a1a 0%, #2c2c2c 60%, #E85D04 85%, #d34a02 100%) !important;
    border: none !important;
    padding: 20px;
}

.card-header h5 {
    color: white !important;
    font-weight: 600;
    font-size: 1.25rem;
    margin: 0;
}

/* Scrollbar styling */
.genealogy-container::-webkit-scrollbar {
    width: 8px;
    height: 8px;
}

.genealogy-container::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
}

.genealogy-container::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #E85D04 0%, #d34a02 100%);
    border-radius: 4px;
}

.genealogy-container::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(135deg, #d34a02 0%, #c44b03 100%);
}
</style>

<div class="container-fluid">
    <div class="card shadow-lg">
        <div class="card-header">
            <h5 class="mb-0">Customer Genealogy Tree</h5>
        </div>
        <div class="card-body p-0">
            <div class="genealogy-container" id="tree-container">
                @if(isset($error))
                    <div class="alert alert-danger m-4">{{ $error }}</div>
                @elseif($root)
                    <div class="tree-wrapper" id="tree-wrapper">
                        <div class="tree" id="genealogy-tree">
                            @include('StudentDashboard.invitees.partial.tree-node', [
                                'customer' => $root,
                                'level' => 0,
                                'performanceLimit' => $performanceLimit
                            ])
                        </div>
                    </div>
                @else
                    <div class="alert alert-warning m-4">No root node found</div>
                @endif
            </div>
            <div class="zoom-controls">
                <button class="zoom-btn" onclick="zoomOut()" title="Zoom Out">−</button>
                <button class="zoom-btn" onclick="resetZoom()" title="Reset Zoom">⌂</button>
                <button class="zoom-btn" onclick="zoomIn()" title="Zoom In">+</button>
            </div>
        </div>
    </div>
</div>

<script>
   document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('tree-container');
    const tree = document.getElementById('genealogy-tree');

    function calculateWidths() {
        // First, let all elements render with their natural size
        setTimeout(() => {
            matchEmptySlots();
            setTimeout(() => {
                calculateParentWidths();
                centerTree();
            }, 50);
        }, 100);
    }

    function matchEmptySlots() {
        // Find all empty slots
        const emptySlots = document.querySelectorAll('.empty-slot');

        emptySlots.forEach(emptySlot => {
            // Find the parent children container
            const parentChildren = emptySlot.closest('.children');
            if (parentChildren) {
                // Get all child nodes in this container
                const childNodes = Array.from(parentChildren.children);

                // Find non-empty siblings
                const nonEmptyNodes = childNodes.filter(child => {
                    const content = child.querySelector('.node-content');
                    return content !== null;
                });

                // If there are non-empty siblings, match the width of the first one
                if (nonEmptyNodes.length > 0) {
                    const referenceContent = nonEmptyNodes[0].querySelector('.node-content');
                    if (referenceContent) {
                        const referenceWidth = referenceContent.offsetWidth;
                        emptySlot.style.width = `${referenceWidth}px`;
                    }
                }
            }
        });
    }

    function calculateParentWidths() {
        // Process nodes from bottom up
        const nodes = Array.from(document.querySelectorAll('.tree-node')).reverse();

        nodes.forEach(node => {
            const childrenContainer = node.querySelector('.children');
            if (childrenContainer) {
                const children = Array.from(childrenContainer.children);
                let totalWidth = 0;

                children.forEach(child => {
                    const content = child.querySelector('.node-content, .empty-slot');
                    if (content) {
                        totalWidth += content.offsetWidth;
                    }
                });

                // Add gaps between children
                totalWidth += 10 * (children.length - 1);

                // Set parent width
                const parentContent = node.querySelector('.node-content');
                if (parentContent) {
                    parentContent.style.width = `${totalWidth}px`;
                }
            }
        });
    }

    function centerTree() {
        setTimeout(() => {
            container.scrollLeft = (tree.scrollWidth - container.clientWidth) / 2;
            container.scrollTop = (tree.scrollHeight - container.clientHeight) / 2;
        }, 100);
    }

    // Run calculation multiple times to ensure it works
    calculateWidths();
    setTimeout(calculateWidths, 300);
    setTimeout(calculateWidths, 600);

    // Recalculate on window resize
    window.addEventListener('resize', calculateWidths);
});

let scale = 1;
const zoomStep = 0.1;
const wrapper = document.getElementById('tree-wrapper');

function updateZoom() {
    wrapper.style.transform = `scale(${scale})`;
    centerTree();
}

function zoomIn() {
    if (scale < 1.5) {
        scale += zoomStep;
        updateZoom();
    }
}

function zoomOut() {
    if (scale > 0.5) {
        scale -= zoomStep;
        updateZoom();
    }
}

function resetZoom() {
    scale = 1;
    updateZoom();
}

function centerTree() {
    setTimeout(() => {
        const container = document.getElementById('tree-container');
        container.scrollLeft = (wrapper.scrollWidth * scale - container.clientWidth) / 2;
        container.scrollTop = (wrapper.scrollHeight * scale - container.clientHeight) / 2;
    }, 100);
}

function centerNode(element) {
    const container = document.getElementById('tree-container');
    const rect = element.getBoundingClientRect();
    const containerRect = container.getBoundingClientRect();

    container.scrollTo({
        left: container.scrollLeft + (rect.left - containerRect.left) - containerRect.width/2 + rect.width/2,
        top: container.scrollTop + (rect.top - containerRect.top) - containerRect.height/2 + rect.height/2,
        behavior: 'smooth'
    });
}
</script>
@endsection