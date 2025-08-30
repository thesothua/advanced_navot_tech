<?php
namespace App\View\Composers;

use App\Models\Notification;
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

        $unreadCount = 0;

        $unreadCount = Notification::whereNull('read_at')

            ->count();

        // $view->with('globalSettings', $this->settings);

        $view->with([
            'globalSettings' => $this->settings,
            'unreadCount'    => $unreadCount,
        ]);
    }
}
