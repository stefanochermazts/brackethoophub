<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // General settings
        Setting::set('app_name', 'Basketball Hub', 'string', 'general', 'Nome dell\'applicazione');
        Setting::set('timezone', 'Europe/Rome', 'string', 'general', 'Fuso orario predefinito');
        Setting::set('date_format', 'd/m/Y', 'string', 'general', 'Formato data predefinito');
        Setting::set('time_format', 'H:i', 'string', 'general', 'Formato ora predefinito');
        Setting::set('default_language', 'it', 'string', 'general', 'Lingua predefinita');

        // Notification settings
        Setting::set('email_notifications', true, 'boolean', 'notifications', 'Abilita notifiche email');
        Setting::set('sms_notifications', false, 'boolean', 'notifications', 'Abilita notifiche SMS');
        Setting::set('notification_email', 'notifiche@brackethoophub.com', 'string', 'notifications', 'Email per le notifiche');

        // Integration settings
        Setting::set('google_analytics_id', '', 'string', 'integrations', 'ID Google Analytics');
        Setting::set('facebook_pixel_id', '', 'string', 'integrations', 'ID Facebook Pixel');
    }
} 