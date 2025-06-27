<?php

namespace App\Http\Controllers;

use App\Models\LandingPageContent;
use App\Models\SocialMedia;
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

    public function socialMedia()
    {
        $socialMedia = SocialMedia::first(); // or find($id) if multiple

        // If no record exists, create a blank one
        if (!$socialMedia) {
            $socialMedia = SocialMedia::create(); // Make sure fillable is set
        }


        return view('AdminDashboard.landing_page.social-media', compact('socialMedia'));
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

    public function socialMediaUpdate(Request $request, $id)
    {
        $socialMedia = SocialMedia::findOrFail($id);

        $request->validate([

            'facebook_link' => 'nullable|url',
            'youtube_link' => 'nullable|url',
            'tiktok_link' => 'nullable|url',
            'instagram_link' => 'nullable|url',
            'whatsapp_link' => 'nullable|url',

            // ...other field validations
        ]);

        $socialMedia->update($request->all());

        return back()->with('success', 'Social Media Handles updated successfully.');
    }
}
