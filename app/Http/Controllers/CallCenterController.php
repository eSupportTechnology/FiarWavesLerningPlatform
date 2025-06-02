<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CallCenter;

class CallCenterController extends Controller
{
    /**
     * Display a listing of the call center contacts.
     */
    public function index()
    {
        $contacts = CallCenter::latest()->get();
        return view('AdminDashboard.callcenter.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new contact.
     */
    public function create()
    {
        return view('AdminDashboard.callcenter.create');
    }

    /**
     * Store a newly created contact in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
        ]);

        CallCenter::create($request->only('name', 'phone_number'));

        return redirect()->route('admin.callcenter.index')
            ->with('success', 'Contact added successfully.');
    }

    /**
     * Show the form for editing the specified contact.
     */
    public function edit($id)
    {
        $contact = CallCenter::findOrFail($id);
        return view('AdminDashboard.callcenter.edit', compact('contact'));
    }

    /**
     * Update the specified contact in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
        ]);

        $contact = CallCenter::findOrFail($id);
        $contact->update($request->only('name', 'phone_number'));

        return redirect()->route('admin.callcenter.index')
            ->with('success', 'Contact updated successfully.');
    }

    /**
     * Remove the specified contact from storage.
     */
    public function destroy($id)
    {
        $contact = CallCenter::findOrFail($id);
        $contact->delete();

        return redirect()->route('admin.callcenter.index')
            ->with('success', 'Contact deleted successfully.');
    }

    public function getContacts()
    {
        return response()->json(\App\Models\CallCenter::all());
    }

}
