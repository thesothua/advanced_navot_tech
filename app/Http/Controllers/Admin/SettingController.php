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
            'site_name'          => 'required|string|max:255',
            'site_description'   => 'nullable|string',
            'footer_description' => 'nullable|string',
            'contact_email'      => 'nullable|email',
            'contact_phone'      => 'nullable|string',
            'address'            => 'nullable|string',
            'facebook_url'       => 'nullable|url',
            'twitter_url'        => 'nullable|url',
            'instagram_url'      => 'nullable|url',
            'linkedin_url'       => 'nullable|url',
            'youtube_url'        => 'nullable|url',
            'logo'               => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',

            'about_image_1'      => 'nullable|image|mimes:jpeg,webp,png,jpg,gif|max:10240',
            'about_image_2'      => 'nullable|image|mimes:jpeg,webp,png,jpg,gif|max:10240',

            'hero_image_1'       => 'nullable|image|mimes:jpeg,webp,png,jpg,gif|max:10240',
            'hero_image_2'       => 'nullable|image|mimes:jpeg,webp,png,jpg,gif|max:10240',
            'hero_image_3'       => 'nullable|image|mimes:jpeg,webp,png,jpg,gif|max:10240',

            'favicon'            => 'nullable|image|mimes:ico,png|max:1024',
            'map_embed_url'      => 'nullable|url',
            'working_hours'      => 'nullable|string|max:255',
        ]);

        $settings = app(GeneralSettings::class);

        $settings->site_name          = $request->site_name;
        $settings->site_description   = $request->site_description;
        $settings->footer_description = $request->footer_description;
        $settings->contact_email      = $request->contact_email;
        $settings->contact_phone      = $request->contact_phone;
        $settings->address            = $request->address;
        $settings->facebook_url       = $request->facebook_url;
        $settings->twitter_url        = $request->twitter_url;
        $settings->instagram_url      = $request->instagram_url;
        $settings->linkedin_url       = $request->linkedin_url;
        $settings->youtube_url        = $request->youtube_url;
        $settings->map_embed_url      = $request->map_embed_url;
        $settings->working_hours      = $request->working_hours;

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logoPath       = $request->file('logo')->store('settings', 'public');
            $settings->logo = $logoPath;
        }

        // Handle favicon upload
        if ($request->hasFile('favicon')) {
            $faviconPath       = $request->file('favicon')->store('settings', 'public');
            $settings->favicon = $faviconPath;
        }

        // Handle About Image 1 upload
        if ($request->hasFile('about_image_1')) {
            $about_image_1Path       = $request->file('about_image_1')->store('settings', 'public');
            $settings->about_image_1 = $about_image_1Path;
        }

        // Handle About Image 2 upload
        if ($request->hasFile('about_image_2')) {
            $about_image_2Path       = $request->file('about_image_2')->store('settings', 'public');
            $settings->about_image_2 = $about_image_2Path;
        }

        // Handle slider Image 1 upload
        if ($request->hasFile('hero_image_1')) {
            $hero_image_1Path       = $request->file('hero_image_1')->store('settings', 'public');
            $settings->hero_image_1 = $hero_image_1Path;
        }
        // Handle slider Image 2 upload
        if ($request->hasFile('hero_image_2')) {
            $hero_image_2Path       = $request->file('hero_image_2')->store('settings', 'public');
            $settings->hero_image_2 = $hero_image_2Path;
        }

        // Handle slider Image 3 upload
        if ($request->hasFile('hero_image_3')) {
            $hero_image_3Path       = $request->file('hero_image_3')->store('settings', 'public');
            $settings->hero_image_3 = $hero_image_3Path;
        }

        $settings->save();

        return redirect()->route('admin.settings.index')
            ->with('success', 'Settings updated successfully.');
    }
}
