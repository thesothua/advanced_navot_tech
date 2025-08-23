<?php

namespace App\View\Composers;

use App\Settings\GeneralSettings;
use Illuminate\View\View;

class SettingsComposer
{
    protected $settings;

    public function __construct(GeneralSettings $settings)
    {
        $this->settings = $settings;
    }

    public function compose(View $view)
    {
        $view->with('globalSettings', $this->settings);
    }
}
