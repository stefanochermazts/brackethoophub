<?php

declare(strict_types=1);

namespace App\Livewire\Admin;

use App\Models\Setting;
use Livewire\Component;

class Settings extends Component
{
    public $activeTab = 'general';
    public $settings = [];
    public $generalSettings = [];
    public $notificationSettings = [];
    public $integrationSettings = [];

    protected $rules = [
        'generalSettings.app_name' => 'required|string|max:255',
        'generalSettings.timezone' => 'required|string',
        'generalSettings.date_format' => 'required|string',
        'generalSettings.time_format' => 'required|string',
        'generalSettings.default_language' => 'required|string',
        'notificationSettings.email_notifications' => 'boolean',
        'notificationSettings.sms_notifications' => 'boolean',
        'notificationSettings.notification_email' => 'required_if:notificationSettings.email_notifications,true|email',
        'integrationSettings.google_analytics_id' => 'nullable|string',
        'integrationSettings.facebook_pixel_id' => 'nullable|string',
    ];

    public function mount()
    {
        $this->loadSettings();
    }

    public function loadSettings()
    {
        $this->generalSettings = Setting::getByGroup('general');
        $this->notificationSettings = Setting::getByGroup('notifications');
        $this->integrationSettings = Setting::getByGroup('integrations');
    }

    public function setActiveTab($tab)
    {
        $this->activeTab = $tab;
    }

    public function saveSettings()
    {
        $this->validate();

        // Save general settings
        foreach ($this->generalSettings as $key => $value) {
            if (is_array($value)) {
                Setting::set($key, $value['value'], $value['type'] ?? 'string', 'general');
            } else {
                Setting::set($key, $value, 'string', 'general');
            }
        }

        // Save notification settings
        foreach ($this->notificationSettings as $key => $value) {
            if (is_array($value)) {
                Setting::set($key, $value['value'], $value['type'] ?? 'boolean', 'notifications');
            } else {
                Setting::set($key, $value, 'boolean', 'notifications');
            }
        }

        // Save integration settings
        foreach ($this->integrationSettings as $key => $value) {
            if (is_array($value)) {
                Setting::set($key, $value['value'], $value['type'] ?? 'string', 'integrations');
            } else {
                Setting::set($key, $value, 'string', 'integrations');
            }
        }

        session()->flash('message', 'Impostazioni salvate con successo.');
    }

    public function render()
    {
        return view('livewire.admin.settings');
    }
} 