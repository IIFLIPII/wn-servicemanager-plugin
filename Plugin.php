<?php

namespace PhilippKuhn\ServiceManager;

use Backend\Facades\Backend;
use Backend\Models\UserRole;
use Illuminate\Support\Facades\Lang;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public const VENDOR_NAME        = 'philippkuhn';
    public const PLUGIN_NAME        = 'servicemanager';
    public const TRANSLATION_KEY    = self::VENDOR_NAME . '.' . self::PLUGIN_NAME . '::lang.';
    public const TABLE_NAME_PREFIX  = self::VENDOR_NAME . '_' . self::PLUGIN_NAME . '_';
    private const BACKEND_MENU_PATH = self::VENDOR_NAME . '/servicemanager';

    /**
     * @return string[]
     */
    public function pluginDetails (): array
    {
        return [
            'name'        => self::TRANSLATION_KEY . 'plugin.name',
            'description' => self::TRANSLATION_KEY . 'plugin.description',
            'author'      => 'Philipp Kuhn',
            'iconSvg'     => '/plugins/' . self::BACKEND_MENU_PATH . '/assets/favicons/plugin-icon.svg'
        ];
    }

    /**
     * @return string[]
     */
    public function registerComponents (): array
    {
        return [
            'PhilippKuhn\ServiceManager\Components\Categories' => 'serviceManagerCategories',
            'PhilippKuhn\ServiceManager\Components\Services'   => 'serviceManagerServices'
        ];
    }

    public function registerSettings ()
    {

    }

    public function registerPermissions(): array
    {
        return [
            'philippkuhn.servicemanager.edit' => [
                'label' => 'Edit categories & services',
                'tab' => 'Service Manager',
                'order' => 100,
                'roles' => [UserRole::CODE_DEVELOPER, UserRole::CODE_PUBLISHER]
            ]
        ];
    }

    /**
     * @return array[]
     */
    public function registerNavigation (): array
    {
        return [
            'servicemanager' => [
                'label'   => Lang::get(self::TRANSLATION_KEY . 'navigation.main'),
                'url'     => Backend::url(self::BACKEND_MENU_PATH . '/categories'),
                'iconSvg' => '/plugins/' . self::BACKEND_MENU_PATH . '/assets/favicons/plugin-icon.svg',
                'order'   => 300,

                'sideMenu' => [
                    'services' => [
                        'label' => Lang::get(self::TRANSLATION_KEY . 'navigation.services'),
                        'icon'  => 'icon-shopping-bag',
                        'url'   => Backend::url(self::BACKEND_MENU_PATH . '/services')
                    ],
                    'categories' => [
                        'label' => Lang::get(self::TRANSLATION_KEY . 'navigation.categories'),
                        'icon'  => 'icon-list',
                        'url'   => Backend::url(self::BACKEND_MENU_PATH . '/categories')
                    ]
                ]
            ]
        ];
    }
}
