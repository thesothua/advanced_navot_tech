<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $site_name;
    public ?string $site_description;
    public ?string $contact_email;
    public ?string $contact_phone;
    public ?string $address;
    public ?string $facebook_url;
    public ?string $twitter_url;
    public ?string $instagram_url;
    public ?string $linkedin_url;
    public ?string $logo;
    public ?string $favicon;
    public ?string $map_embed_url;
    public ?string $working_hours;

    public static function group(): string
    {
        return 'general';
    }

    /**
     * Get the logo URL
     */
    public function getLogoUrl(): ?string
    {
        return $this->logo ? asset('storage/' . $this->logo) : null;
    }

    /**
     * Get the favicon URL
     */
    public function getFaviconUrl(): ?string
    {
        return $this->favicon ? asset('storage/' . $this->favicon) : null;
    }
}