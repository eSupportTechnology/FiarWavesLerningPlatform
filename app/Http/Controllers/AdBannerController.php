<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdBanner;
use Illuminate\Support\Facades\Storage;

class AdBannerController extends Controller
{
    // Show all banners
    public function index()
    {
        $banners = AdBanner::latest()->get();
        return view('AdminDashboard.adbanners.index', compact('banners'));
    }

    // Show create form
    public function create()
    {
        return view('AdminDashboard.adbanners.create');
    }

    // Store new banner
    public function store(Request $request)
    {
        
        $request->validate([
            'image'   => 'required|image|mimes:jpg,jpeg,png,webp',
            'caption' => 'nullable|string|max:255',
        ]);

        $path = $request->file('image')->store('adbanners', 'public');

        AdBanner::create([
            'image'   => $path,
            'caption' => $request->caption,
            'status'  => true,
        ]);

        return redirect()->route('admin.adbanners.index')->with('success', 'Banner added successfully.');
    }

    // Show edit form
    public function edit($id)
    {
        $banner = AdBanner::findOrFail($id);
        return view('AdminDashboard.adbanners.edit', compact('banner'));
    }

    // Update banner
    public function update(Request $request, $id)
    {
        $request->validate([
            'caption' => 'nullable|string|max:255',
            'image'   => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'status'  => 'required|boolean',
        ]);

        $banner = AdBanner::findOrFail($id);

        $data = [
            'caption' => $request->caption,
            'status'  => $request->status,
        ];

        if ($request->hasFile('image')) {
            // Delete old image
            if ($banner->image && Storage::disk('public')->exists($banner->image)) {
                Storage::disk('public')->delete($banner->image);
            }
            $data['image'] = $request->file('image')->store('adbanners', 'public');
        }

        $banner->update($data);

        return redirect()->route('admin.adbanners.index')->with('success', 'Banner updated successfully.');
    }

    // Delete banner
    public function destroy($id)
    {
        $banner = AdBanner::findOrFail($id);

        if ($banner->image && Storage::disk('public')->exists($banner->image)) {
            Storage::disk('public')->delete($banner->image);
        }

        $banner->delete();

        return redirect()->route('admin.adbanners.index')->with('success', 'Banner deleted successfully.');
    }
}
