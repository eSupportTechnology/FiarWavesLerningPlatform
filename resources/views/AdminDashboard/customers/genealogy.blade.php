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
        padding: 40px;
        position: relative;
        background-color: #fff;
        border: 1px solid #ddd;
    }

    #zoom-wrapper {
        min-width: max-content;
        display: inline-block;
        transform-origin: top center;
        transition: transform 0.3s ease-in-out;
    }

    .customer-card {
        min-width: 180px;
        border: 2px solid #0d6efd;
        border-radius: 10px;
        padding: 10px;
        background-color: #ffffff;
        box-shadow: 0 0 10px rgba(13, 110, 253, 0.2);
    }
    </style>



<div class="container-fluid">
    <div class="card">
        <div class="card-header">
            <h5>Customer Genealogy</h5>
        </div>
        <div class="card-body">
            <div class="mb-3 text-center">
                <button class="btn btn-primary btn-sm me-2" onclick="zoomIn()">Zoom In</button>
                <button class="btn btn-secondary btn-sm" onclick="zoomOut()">Zoom Out</button>
                <button class="btn btn-outline-dark btn-sm" onclick="resetZoom()">Reset</button>
            </div>


            <div class="tree-container">
                @if($root)
                <div id="zoom-wrapper" class="d-flex justify-content-center">
                    @include('AdminDashboard.customers.partial.tree-node', ['customer' => $root])
                </div>
                @else
                    <div class="alert alert-warning">No root sponsor found.</div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    let scale = 1;
    const zoomStep = 0.1;
    const minZoom = 0.2;
    const maxZoom = 2;

    function updateZoom() {
        const wrapper = document.getElementById('zoom-wrapper');
        wrapper.style.transform = `scale(${scale})`;
    }

    function zoomIn() {
        if (scale < maxZoom) {
            scale += zoomStep;
            updateZoom();
        }
    }

    function zoomOut() {
        if (scale > minZoom) {
            scale -= zoomStep;
            updateZoom();
        }
    }

    function resetZoom() {
        scale = 1;
        updateZoom();
    }
</script>

<script>
    // Scroll to center on load
    window.onload = function () {
        const container = document.querySelector('.tree-container');
        container.scrollLeft = container.scrollWidth / 2 - container.clientWidth / 2;
    };
</script>


@endsection
