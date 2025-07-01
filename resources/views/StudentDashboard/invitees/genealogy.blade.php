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
        background: #f8fafc;
        display: flex;
        justify-content: center;
        align-items: flex-start;
    }

    /* Zoom Wrapper */
    #zoom-wrapper {
        display: flex;
        justify-content: center;
        transform-origin: center;
        transition: transform 0.3s ease;
        min-width: min-content;
        padding: 20px 0;
    }

    /* Tree Structure */
    .tree {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        margin: 0 auto;
    }

    /* Node Styling */
    .tree-node {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 10px 0;
    }

    .node-content {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 12px 20px;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        text-align: center;
        min-width: 160px;
        z-index: 2;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    /* Children Container */
    .children {
        display: flex;
        justify-content: center;
        position: relative;
        margin-top: 40px;
        gap: 80px;
        width: 100%;
    }

    /* Connecting Lines */
    .tree-node::before {
        content: '';
        position: absolute;
        top: -20px;
        left: 50%;
        width: 2px;
        height: 20px;
        background: #667eea;
        z-index: 1;
    }

    .children::before {
        content: '';
        position: absolute;
        top: -20px;
        left: 0;
        right: 0;
        width: 100%;
        height: 2px;
        background: #667eea;
        z-index: 1;
    }

    /* Root Node Special Styling */
    .level-0 {
        margin: 0 auto;
    }

    .level-0 .node-content {
        background: linear-gradient(135deg, #ff6b6b 0%, #ee5a52 100%);
        min-width: 180px;
        padding: 16px 24px;
    }
</style>

<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Customer Genealogy Tree</h5>
        </div>
        <div class="card-body p-0">
            <div class="genealogy-container" id="tree-container">
                @if(isset($error))
                    <div class="alert alert-danger m-4">{{ $error }}</div>
                @elseif($root)
                    <div id="zoom-wrapper">
                        <div class="tree">
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
        </div>
    </div>
</div>

<script>
    // Zoom functionality
    let scale = 1;
    const zoomStep = 0.1;

    function updateZoom() {
        document.getElementById('zoom-wrapper').style.transform = `scale(${scale})`;
    }

    function zoomIn() {
        if (scale < 2) {
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
        centerTree();
    }

    // Center tree on load and zoom
    function centerTree() {
        const container = document.getElementById('tree-container');
        const wrapper = document.getElementById('zoom-wrapper');

        setTimeout(() => {
            container.scrollLeft = (wrapper.scrollWidth - container.clientWidth) / 2;
            container.scrollTop = (wrapper.scrollHeight - container.clientHeight) / 2;
        }, 100);
    }

    document.addEventListener('DOMContentLoaded', centerTree);
    window.addEventListener('resize', centerTree);
</script>
@endsection
