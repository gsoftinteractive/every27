<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\PlatformSettingModel;

class SettingsController extends BaseController
{
    /**
     * View settings page
     */
    public function index()
    {
        $settingModel = new PlatformSettingModel();
        $settings = $settingModel->getAllSettings();

        return view('admin/settings/index', [
            'pageTitle' => 'Platform Settings',
            'userType'  => 'admin',
            'settings'  => $settings,
        ]);
    }

    /**
     * Update settings
     */
    public function update()
    {
        $settingModel = new PlatformSettingModel();

        $data = $this->request->getPost();

        foreach ($data as $key => $value) {
            if ($key !== 'csrf_test_name') {
                $settingModel->setSetting($key, $value);
            }
        }

        return redirect()->to('/admin/settings')->with('success', 'Settings updated successfully');
    }
}
