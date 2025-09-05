<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'SafeBuild');
        $this->migrator->add('general.site_description', 'Construction Safety Equipment Store');
        $this->migrator->add('general.contact_email', 'info@safebuild.com');
        $this->migrator->add('general.contact_phone', '+91-9999999999');
        $this->migrator->add('general.address', '123 Industrial Area, Mumbai');
        $this->migrator->add('general.facebook_url', null);
        $this->migrator->add('general.twitter_url', null);
        $this->migrator->add('general.instagram_url', null);
        $this->migrator->add('general.linkedin_url', null);
        $this->migrator->add('general.logo', null);
        $this->migrator->add('general.favicon', null);
        $this->migrator->add('general.map_embed_url', null);
        $this->migrator->add('general.working_hours', null);
    }
    
    public function down(): void
    {
        $this->migrator->delete('general.site_name');
        $this->migrator->delete('general.site_description');
        $this->migrator->delete('general.contact_email');
        $this->migrator->delete('general.contact_phone');
        $this->migrator->delete('general.address');
        $this->migrator->delete('general.facebook_url');
        $this->migrator->delete('general.twitter_url');
        $this->migrator->delete('general.instagram_url');
        $this->migrator->delete('general.linkedin_url');
        $this->migrator->delete('general.logo');
        $this->migrator->delete('general.favicon');
        $this->migrator->delete('general.map_embed_url');
        $this->migrator->delete('general.working_hours');
    }
};
