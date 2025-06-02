<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PopupContact; // ✅ Import your model

class PopupContactController extends Controller
{



    public function index(Request $request)
    {
        $query = PopupContact::query();

        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $leads = $query->latest()->paginate(20);

        return view('AdminDashboard.popupcontacts.index', compact('leads'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
        ]);

        PopupContact::create([
            'name' => $request->name,
            'phone' => $request->phone,
        ]);

        return response()->json(['success' => true]);
    }
}
