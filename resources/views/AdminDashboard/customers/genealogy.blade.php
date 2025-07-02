@extends('AdminDashboard.master')

@section('title', 'Customer Genealogy')

@section('content')
<style>
    /* Main Container */
    .genealogy-container {
        width: 100%;
        height: 80vh;
        overflow: auto;
        padding: 20px;
        background: #ffffff;
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
        margin: 5px 0;
    }

    /* Children Container - Back to original */
.children {
    display: flex;
    position: relative;
    margin-top: 25px;
    gap: 10px;
}

/* Node content styling */
.node-content {
    background: #2d2d2d;
    color: #ffffff;
    border: 1px solid #444;
    padding: 8px 12px;
    border-radius: 6px;
    text-align: center;
    z-index: 2;
    cursor: pointer;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
    min-width: 120px;
    box-sizing: border-box;
}

/* Empty slot styling */
/* Ensure empty slots have consistent base styling */
.empty-slot {
    background: #333;
    color: #fff;
    border: 1px dashed #555;
    padding: 8px 12px;
    border-radius: 6px;
    text-align: center;
    font-style: italic;
    min-width: 120px;
    box-sizing: border-box;
    display: flex;
    align-items: center;
    justify-content: center;
    /* Ensure it can be resized by JavaScript */
    width: auto;
    /* Same height calculation as regular nodes */
    min-height: 1.2em;
}

    /* Children Container - Critical Change */
    .children {
        display: flex;
        position: relative;
        margin-top: 25px;
        gap: 10px;
    }

    /* Connecting Lines */
    .tree-node::before {
        content: '';
        position: absolute;
        top: -15px;
        left: 50%;
        width: 1px;
        height: 15px;
        background: #444;
        z-index: 1;
    }

    .children::before {
        content: '';
        position: absolute;
        top: -15px;
        left: 0;
        right: 0;
        width: 100%;
        height: 1px;
        background: #444;
        z-index: 1;
    }

    /* Node content details */
    .node-name {
        font-weight: bold;
        margin-bottom: 3px;
        color: #fff;
        font-size: 0.95em;
    }

    .node-id, .node-sponsor, .node-bv {
        font-size: 0.8em;
        color: #fff;
        margin-top: 2px;
    }

    /* Root Node Special Styling */
    .level-0 .node-content {
        background: #3a3a3a;
        border: 1px solid #555;
        padding: 10px 15px;
    }

    /* Zoom controls */
.zoom-controls {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 100;
    display: flex;
    gap: 8px;
}

.zoom-btn {
    background: #333;
    color: white;
    border: none;
    border-radius: 50%;
    width: 36px;
    height: 36px;
    font-size: 16px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}
</style>

<div class="container-fluid">
    <div class="card shadow-sm" style="background: #222; border-color: #333;">
        <div class="card-header" style="background: #333; border-color: #444;">
            <h5 class="mb-0 text-white">Customer Genealogy Tree</h5>
        </div>
        <div class="card-body p-0">
            <div class="genealogy-container" id="tree-container">
                @if(isset($error))
                    <div class="alert alert-danger m-4">{{ $error }}</div>
                @elseif($root)
                    <div class="tree-wrapper" id="tree-wrapper">
                        <div class="tree" id="genealogy-tree">
                            @include('AdminDashboard.customers.partial.tree-node', [
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
                <button class="zoom-btn" onclick="zoomOut()">-</button>
                <button class="zoom-btn" onclick="resetZoom()">⌂</button>
                <button class="zoom-btn" onclick="zoomIn()">+</button>
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
