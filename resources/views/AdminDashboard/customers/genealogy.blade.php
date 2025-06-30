@extends('AdminDashboard.master')

@section('title', 'Customer Genealogy')

@section('breadcrumb-title')
    <h3>Genealogy Tree</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Users</li>
    <li class="breadcrumb-item active">Genealogy</li>
@endsection

@section('content')
<style>
    .tree-container {
        width: 100%;
        height: 80vh;
        overflow: auto;
        padding: 20px;
        position: relative;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        border-radius: 12px;
        box-shadow: inset 0 2px 10px rgba(0,0,0,0.1);
    }

    #zoom-wrapper {
        min-width: max-content;
        display: inline-block;
        transform-origin: top center;
        transition: transform 0.3s ease-in-out;
    }

    .tree {
        display: flex;
        flex-direction: column;
        align-items: center;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        padding: 20px;
    }

    .tree-node {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 0;
    }

    .node-content {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 16px 24px;
        border-radius: 12px;
        box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        text-align: center;
        min-width: 180px;
        position: relative;
        margin: 8px 0;
        font-size: 13px;
        line-height: 1.4;
        border: 3px solid rgba(255,255,255,0.2);
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
    }

    .node-content:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 35px rgba(102, 126, 234, 0.4);
    }

    .node-content.empty {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        color: #64748b;
        border: 2px dashed #cbd5e1;
        box-shadow: 0 4px 15px rgba(0,0,0,0.08);
        font-style: italic;
        min-width: 160px;
        opacity: 0.7;
    }

    .node-content.empty:hover {
        opacity: 1;
        background: linear-gradient(135deg, #f1f5f9 0%, #d1d5db 100%);
    }

    .node-name {
        font-weight: 700;
        font-size: 15px;
        margin-bottom: 6px;
        text-shadow: 0 1px 3px rgba(0,0,0,0.2);
    }

    .node-id {
        font-size: 11px;
        opacity: 0.9;
        margin-bottom: 4px;
        background: rgba(255,255,255,0.2);
        padding: 2px 8px;
        border-radius: 12px;
        display: inline-block;
    }

    .node-sponsor {
        font-size: 10px;
        opacity: 0.8;
        font-weight: 500;
    }

    .children {
        display: flex;
        justify-content: center;
        position: relative;
        margin-top: 30px;
        gap: 40px;
        flex-wrap: wrap;
    }

    /* Enhanced connecting lines */
    .tree-node::before {
        content: '';
        position: absolute;
        top: calc(100% - 8px);
        left: 50%;
        width: 3px;
        height: 30px;
        background: linear-gradient(to bottom, #667eea, #764ba2);
        border-radius: 2px;
        transform: translateX(-50%);
        z-index: 1;
    }

    .tree-node:only-child::before,
    .tree > .tree-node::before {
        display: none;
    }

    .children::before {
        content: '';
        position: absolute;
        top: -30px;
        left: 20px;
        right: 20px;
        height: 3px;
        background: linear-gradient(to right, #667eea, #764ba2);
        border-radius: 2px;
        z-index: 0;
    }

    .children.single-child::before {
        display: none;
    }

    .children > .tree-node::after {
        content: '';
        position: absolute;
        top: -30px;
        left: 50%;
        width: 3px;
        height: 30px;
        background: linear-gradient(to bottom, #667eea, #764ba2);
        border-radius: 2px;
        transform: translateX(-50%);
        z-index: 1;
    }

    /* Zoom controls */
    .zoom-controls {
        position: sticky;
        top: 10px;
        z-index: 1000;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 50px;
        padding: 8px 16px;
        margin-bottom: 20px;
        backdrop-filter: blur(10px);
        box-shadow: 0 8px 32px rgba(0,0,0,0.1);
        border: 1px solid rgba(255,255,255,0.2);
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .zoom-controls .btn {
        border-radius: 25px;
        font-size: 12px;
        padding: 8px 16px;
        font-weight: 600;
        border: none;
        transition: all 0.3s ease;
    }

    .zoom-controls .btn:hover {
        transform: translateY(-1px);
    }

    .zoom-controls .btn-primary {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .zoom-controls .btn-danger {
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
    }

    .zoom-controls .btn-outline-secondary {
        background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
        color: #64748b;
        border: 1px solid #cbd5e1;
    }

    /* Level indicators for better hierarchy visualization */
    .level-0 .node-content {
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
        min-width: 200px;
        padding: 20px 30px;
        font-size: 14px;
        box-shadow: 0 12px 40px rgba(255, 107, 107, 0.3);
    }

    .level-1 .node-content {
        background: linear-gradient(135deg, #4ecdc4 0%, #44a08d 100%);
        box-shadow: 0 8px 25px rgba(78, 205, 196, 0.3);
    }

    .level-2 .node-content {
        background: linear-gradient(135deg, #45b7d1 0%, #96c93d 100%);
        box-shadow: 0 8px 25px rgba(69, 183, 209, 0.3);
    }

    .level-3 .node-content {
        background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        box-shadow: 0 8px 25px rgba(240, 147, 251, 0.3);
    }

    .level-4 .node-content {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        box-shadow: 0 8px 25px rgba(79, 172, 254, 0.3);
    }

    /* Compact layout for deeper levels */
    .level-3 .node-content,
    .level-4 .node-content,
    .level-5 .node-content {
        min-width: 140px;
        padding: 12px 18px;
        font-size: 12px;
    }

    .level-3 .children,
    .level-4 .children,
    .level-5 .children {
        gap: 25px;
        margin-top: 20px;
    }

    /* Responsive design */
    @media (max-width: 768px) {
        .tree-container {
            padding: 10px;
        }

        .node-content {
            min-width: 140px;
            padding: 12px 18px;
            font-size: 12px;
        }

        .children {
            gap: 25px;
            margin-top: 20px;
        }

        .level-0 .node-content {
            min-width: 160px;
            padding: 16px 20px;
        }
    }

    /* Enhanced scrollbar */
    .tree-container::-webkit-scrollbar {
        width: 12px;
        height: 12px;
    }

    .tree-container::-webkit-scrollbar-track {
        background: rgba(255,255,255,0.1);
        border-radius: 10px;
    }

    .tree-container::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 10px;
        border: 2px solid transparent;
        background-clip: content-box;
    }

    .tree-container::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
        background-clip: content-box;
    }

    /* Animation for tree loading */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .tree-node {
        animation: fadeInUp 0.6s ease-out;
    }

    /* Stagger animation for children */
    .children > .tree-node:nth-child(1) {
        animation-delay: 0.1s;
    }

    .children > .tree-node:nth-child(2) {
        animation-delay: 0.2s;
    }

    .children > .tree-node:nth-child(3) {
        animation-delay: 0.3s;
    }
</style>

<div class="container-fluid">
    <div class="card shadow-lg border-0">
        <div class="card-header bg-gradient-primary text-white border-0" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
            <h5 class="mb-0 d-flex align-items-center">
                <i class="bi bi-diagram-3 me-2"></i>
                Customer Genealogy Tree
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="text-center p-3">
                <div class="zoom-controls">
                    <button class="btn btn-primary btn-sm" onclick="zoomIn()">
                        <i class="bi bi-zoom-in"></i> Zoom In
                    </button>
                    <button class="btn btn-danger btn-sm" onclick="zoomOut()">
                        <i class="bi bi-zoom-out"></i> Zoom Out
                    </button>
                    <button class="btn btn-outline-secondary btn-sm" onclick="resetZoom()">
                        <i class="bi bi-arrow-clockwise"></i> Reset
                    </button>
                    <button class="btn btn-outline-primary btn-sm" onclick="toggleCompactMode()">
                        <i class="bi bi-arrows-collapse"></i> Compact
                    </button>
                </div>
            </div>

            <div class="tree-container" id="tree-container">
                @if($root)
                <div id="zoom-wrapper">
                    <div class="tree">
                        @include('AdminDashboard.customers.partial.tree-node', ['customer' => $root, 'level' => 0])
                    </div>
                </div>
                @else
                    <div class="alert alert-warning m-4 border-0 shadow-sm" style="background: linear-gradient(135deg, #fff3cd 0%, #ffeaa7 100%);">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-exclamation-triangle-fill text-warning me-3" style="font-size: 24px;"></i>
                            <div>
                                <h6 class="alert-heading mb-1">No Root Sponsor Found</h6>
                                <p class="mb-0">Please ensure there is a root customer in the system.</p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    let scale = 1;
    let compactMode = false;
    const zoomStep = 0.15;
    const minZoom = 0.3;
    const maxZoom = 2.5;

    function updateZoom() {
        const wrapper = document.getElementById('zoom-wrapper');
        if (wrapper) {
            wrapper.style.transform = `scale(${scale})`;
        }
    }

    function zoomIn() {
        if (scale < maxZoom) {
            scale = Math.min(scale + zoomStep, maxZoom);
            updateZoom();
        }
    }

    function zoomOut() {
        if (scale > minZoom) {
            scale = Math.max(scale - zoomStep, minZoom);
            updateZoom();
        }
    }

    function resetZoom() {
        scale = 1;
        updateZoom();
    }

    function toggleCompactMode() {
        compactMode = !compactMode;
        const container = document.querySelector('.tree-container');
        const button = event.target.closest('button');

        if (compactMode) {
            container.classList.add('compact-mode');
            button.innerHTML = '<i class="bi bi-arrows-expand"></i> Expand';

            // Add compact styles
            const style = document.createElement('style');
            style.id = 'compact-style';
            style.textContent = `
                .compact-mode .children { gap: 20px; margin-top: 15px; }
                .compact-mode .node-content { min-width: 120px; padding: 10px 16px; font-size: 11px; }
                .compact-mode .tree-node::before,
                .compact-mode .children > .tree-node::after { height: 15px; }
                .compact-mode .children::before { top: -15px; }
            `;
            document.head.appendChild(style);
        } else {
            container.classList.remove('compact-mode');
            button.innerHTML = '<i class="bi bi-arrows-collapse"></i> Compact';

            // Remove compact styles
            const style = document.getElementById('compact-style');
            if (style) style.remove();
        }
    }

    // Initialize on page load
    document.addEventListener('DOMContentLoaded', function() {
        // Center the tree
        const container = document.querySelector('.tree-container');
        if (container) {
            setTimeout(() => {
                container.scrollLeft = (container.scrollWidth - container.clientWidth) / 2;
            }, 100);
        }

        // Keyboard shortcuts
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey || e.metaKey) {
                switch(e.key) {
                    case '=':
                    case '+':
                        e.preventDefault();
                        zoomIn();
                        break;
                    case '-':
                        e.preventDefault();
                        zoomOut();
                        break;
                    case '0':
                        e.preventDefault();
                        resetZoom();
                        break;
                    case 'c':
                        e.preventDefault();
                        toggleCompactMode();
                        break;
                }
            }
        });

        // Add loading animation
        const nodes = document.querySelectorAll('.tree-node');
        nodes.forEach((node, index) => {
            node.style.animationDelay = `${index * 0.1}s`;
        });
    });

    // Enhanced mouse wheel zoom
    document.querySelector('.tree-container')?.addEventListener('wheel', function(e) {
        if (e.ctrlKey || e.metaKey) {
            e.preventDefault();
            if (e.deltaY < 0) {
                zoomIn();
            } else {
                zoomOut();
            }
        }
    });

    // Add smooth scrolling behavior
    document.querySelectorAll('.node-content').forEach(node => {
        node.addEventListener('click', function() {
            this.scrollIntoView({
                behavior: 'smooth',
                block: 'center'
            });
        });
    });
</script>

@endsection
