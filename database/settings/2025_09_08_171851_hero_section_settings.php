<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.hero_image_1', null);
        $this->migrator->add('general.hero_image_2', null);
        $this->migrator->add('general.hero_image_3', null);


        $this->migrator->add('general.youtube_url', null);
        $this->migrator->add('general.footer_description', null);

        $this->migrator->add('general.about_image_1', null);
        $this->migrator->add('general.about_image_2', null);
    }

    public function down(): void
    {
        $this->migrator->delete('general.hero_image_1');
        $this->migrator->delete('general.hero_image_2');
        $this->migrator->delete('general.hero_image_3');

        $this->migrator->delete('general.youtube_url');
        $this->migrator->delete('general.footer_description');

        $this->migrator->delete('general.about_image_1');
        $this->migrator->delete('general.about_image_2');
    }
};
