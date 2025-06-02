<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\VipPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VipPackageController extends Controller
{
    // Display all packages
    public function index()
    {
        $packages = VipPackage::latest()->get();
        return view('AdminDashboard.vip_packages.index', compact('packages'));
    }

    // Show create form
    public function create()
    {
        return view('AdminDashboard.vip_packages.create');
    }

    // Store new package
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image',
        ]);

        $data = $request->only(['title', 'price', 'description', 'status','video_link']);

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('vip_packages', 'public');
        }

        VipPackage::create($data);

        return redirect()->route('vip-packages.index')->with('success', 'Package created successfully.');
    }

    // Show single package
    public function show(VipPackage $vipPackage)
    {
        return view('AdminDashboard.vip_packages.show', compact('vipPackage'));
    }

    // Show edit form
    public function edit(VipPackage $vipPackage)
    {
        return view('AdminDashboard.vip_packages.edit', compact('vipPackage'));
    }

    // Update package
    public function update(Request $request, VipPackage $vipPackage)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
            'image' => 'nullable|image',
        ]);

        $data = $request->only(['title', 'price', 'description', 'status', 'video_link']);

        // Replace old image if a new one is uploaded
        if ($request->hasFile('image')) {
            // Delete old image
            if ($vipPackage->image && Storage::disk('public')->exists($vipPackage->image)) {
                Storage::disk('public')->delete($vipPackage->image);
            }

            // Store new image
            $data['image'] = $request->file('image')->store('vip_packages', 'public');
        }

        $vipPackage->update($data);

        return redirect()->route('vip-packages.index')->with('success', 'Package updated successfully.');
    }

    // Delete package
    public function destroy(VipPackage $vipPackage)
    {
        // Delete image from storage
        if ($vipPackage->image && Storage::disk('public')->exists($vipPackage->image)) {
            Storage::disk('public')->delete($vipPackage->image);
        }

        $vipPackage->delete();

        return redirect()->route('vip-packages.index')->with('success', 'Package deleted successfully.');
    }
}
