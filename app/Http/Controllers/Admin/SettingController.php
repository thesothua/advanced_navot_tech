<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Settings\GeneralSettings;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = app(GeneralSettings::class);
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string',
            'contact_email' => 'nullable|email',
            'contact_phone' => 'nullable|string',
            'address' => 'nullable|string',
            'facebook_url' => 'nullable|url',
            'twitter_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'linkedin_url' => 'nullable|url',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png|max:1024',
        ]);

        $settings = app(GeneralSettings::class);
        
        $settings->site_name = $request->site_name;
        $settings->site_description = $request->site_description;
        $settings->contact_email = $request->contact_email;
        $settings->contact_phone = $request->contact_phone;
        $settings->address = $request->address;
        $settings->facebook_url = $request->facebook_url;
        $settings->twitter_url = $request->twitter_url;
        $settings->instagram_url = $request->instagram_url;
        $settings->linkedin_url = $request->linkedin_url;
        
        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('settings', 'public');
            $settings->logo = $logoPath;
        }
        
        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            $faviconPath = $request->file('favicon')->store('settings', 'public');
            $settings->favicon = $faviconPath;
        }
        
        $settings->save();

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully.');
    }
} 