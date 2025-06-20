<?php

namespace App\Http\Controllers;

use App\Models\LandingPageContent;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function edit()
    {
        $landingPage = LandingPageContent::first(); // or find($id) if multiple

        // If no record exists, create a blank one
        if (!$landingPage) {
            $landingPage = LandingPageContent::create(); // Make sure fillable is set
        }


        return view('AdminDashboard.landing_page.index', compact('landingPage'));
    }

    public function update(Request $request, $id)
    {
        $landingPage = LandingPageContent::findOrFail($id);

        $request->validate([
            'email' => 'required|email',
            'number_1' => 'required|string',
            'main_title' => 'required|string',
            'red_title' => 'required|string',
            'title_description' => 'required|string',
            'middle_title' => 'required|string',
            'middle_title_description' => 'required|string',
            'footer_description' => 'required|string',
            'about_title' => 'required|string',
            'about_title_description' => 'required|string',
            'address' => 'required|string',
            'website' => 'nullable|url',
            'location_link' => 'nullable|url',
            'vision' => 'nullable|string',
            'mission' => 'nullable|string',

            // ...other field validations
        ]);

        $landingPage->update($request->all());

        return back()->with('success', 'Landing page content updated successfully.');
    }
}
