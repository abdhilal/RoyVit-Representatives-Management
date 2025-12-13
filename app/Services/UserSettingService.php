<?php

namespace App\Services;

use App\Models\UserSetting;
use App\Services\Interfaces\UserSettingServiceInterface;

class UserSettingService
{
    public function update(UserSetting $userSetting, array $data)
    {
        // Update the user's settings.
        $this->setLayout($userSetting, $data['layout']);
        $this->setSidebarType($userSetting, $data['sidebar_type']);
        $this->setIcon($userSetting, $data['icon']);
        $this->setColor($userSetting, $data['color']);
        $this->setMode($userSetting, $data['mode']);
        $userSetting->save();
        $this->setSessions($userSetting);
    }
    // Set the user's mode preference.
    public function setMode(UserSetting $userSetting, $mode)
    {
        $userSetting->update(['mode' => $mode]);
        $userSetting->save();
        $this->setSessions($userSetting);
    }
    public function setColor(UserSetting $userSetting, $color)
    {
        // Set the user's color preference.
        $userSetting->update(['color' => $color]);
        $userSetting->save();
        $this->setSessions($userSetting);
    }
    // Set the user's sidebar type preference.
    public function setSidebarType(UserSetting $userSetting, $sidebar_type)
    {
        // Set the user's sidebar type preference.
        $userSetting->update(['sidebar_type' => $sidebar_type]);
        $userSetting->save();
        $this->setSessions($userSetting);
    }
    // Set the user's icon preference.
    public function setIcon(UserSetting $userSetting, $icon)
    {
        // Set the user's icon preference.
        $userSetting->update(['icon' => $icon]);
        $userSetting->save();
        $this->setSessions($userSetting);
    }
    // Set the user's layout preference.
    public function setLayout(UserSetting $userSetting, $layout)
    {
        // Set the user's layout preference.
        $userSetting->update(['layout' => $layout]);
        $userSetting->save();
        $this->setSessions($userSetting);
    }
    // Set the user's locale preference.
    public function setLocale(UserSetting $userSetting, $locale)
    {
        // Set the user's locale preference.
        $layout= $locale == 'en' ? 'ltr' : 'rtl';
        $userSetting->update(['locale' => $locale, 'layout' => $layout]);
        $userSetting->save();
        $this->setSessions($userSetting);
    }
    // Set default settings for the user.
    public function setDefault(UserSetting $userSetting)
    {
        // Set default settings for the user.
        $userSetting->update([
            'mode' => 'Light',
            'color' => '#308e87',
            'sidebar_type' => 'Vertical',
            'icon' => 'Stroke',
            'layout' => 'rtl',
            'locale' => 'ar',
        ]);
        $userSetting->save();
        $this->setSessions($userSetting);
    }

    public function setSessions(UserSetting $userSetting)
    {
        $theme_class= $userSetting->mode === 'Dark' ? 'dark-only' : ($userSetting->mode === 'Mix' ? 'dark-sidebar' : 'light');
        $locale = $userSetting->locale ?? config('app.locale');
        $layout = $userSetting->layout ?? ($locale === 'en' ? 'ltr' : 'rtl');
        session(['theme_class' => $theme_class]);
        session(['mode' => $userSetting->mode]);
        session(['color' => $userSetting->color]);
        session(['sidebar_type' => $userSetting->sidebar_type]);
        session(['icon' => $userSetting->icon]);
        session(['locale' => $locale]);
        session(['dir' => $layout]);
        app()->setLocale($locale);

    }
}
