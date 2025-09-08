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
    public ?string $youtube_url;
    public ?string $logo;
    public ?string $favicon;
    public ?string $hero_image_1;
    public ?string $hero_image_2;
    public ?string $hero_image_3;
    public ?string $footer_description;
    public ?string $about_image_1;
    public ?string $about_image_2;
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

    /**
     * Get the about_image_1 URL
     */
    public function getAboutImage1Url(): ?string
    {
        return $this->about_image_1 ? asset('storage/' . $this->about_image_1) : null;
    }   
    /**
     * Get the about_image_2 URL
     */
    public function getAboutImage2Url(): ?string
    {
        return $this->about_image_2 ? asset('storage/' . $this->about_image_2) : null;
    }   
    /**
     * Get the hero_image_1 URL
     */
    public function getHeroImage1Url(): ?string
    {
        return $this->hero_image_1 ? asset('storage/' . $this->hero_image_1) : null;
    }   
    /**
     * Get the hero_image_2 URL
     */
    public function getHeroImage2Url(): ?string
    {
        return $this->hero_image_2 ? asset('storage/' . $this->hero_image_2) : null;
    }   
    /**
     * Get the hero_image_3 URL
     */
    public function getHeroImage3Url(): ?string
    {
        return $this->hero_image_3 ? asset('storage/' . $this->hero_image_3) : null;
    }   
  
}