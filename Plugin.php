<?php

namespace PhilippKuhn\ServiceManager;

use Backend\Facades\Backend;
use Backend\Models\UserRole;
use PhilippKuhn\ServiceManager\Components\Categories;
use PhilippKuhn\ServiceManager\Components\Category as CategoryComponent;
use PhilippKuhn\ServiceManager\Components\Services;
use PhilippKuhn\ServiceManager\Models\Category;
use System\Classes\PluginBase;
use Winter\Storm\Support\Facades\Event;

class Plugin extends PluginBase
{
    public const VENDOR_NAME        = 'philippkuhn';
    public const PLUGIN_NAME        = 'servicemanager';
    public const PLUGIN_KEY         = self::VENDOR_NAME . '.' . self::PLUGIN_NAME;
    public const TRANSLATION_KEY    = self::PLUGIN_KEY . '::lang';
    public const TABLE_NAME_PREFIX  = self::VENDOR_NAME . '_' . self::PLUGIN_NAME;
    private const BACKEND_MENU_PATH = self::VENDOR_NAME . '/' . self::PLUGIN_NAME;

    /**
     * @return string[]
     */
    public function pluginDetails (): array
    {
        return [
            'name'        => self::TRANSLATION_KEY . '.plugin.name',
            'description' => self::TRANSLATION_KEY . '.plugin.description',
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
            Categories::class => Categories::COMPONENT_KEY,
            Services::class   => Services::COMPONENT_KEY,
            CategoryComponent::class => CategoryComponent::COMPONENT_KEY
        ];
    }

    /**
     * @return void
     */
    public function registerSettings (): void
    {

    }

    /**
     * @return array[]
     */
    public function registerPermissions(): array
    {
        return [
            self::PLUGIN_KEY . '.edit' => [
                'label' => self::TRANSLATION_KEY . '.permissions.edit',
                'tab' => self::TRANSLATION_KEY . '.plugin.name',
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
            self::PLUGIN_NAME => [
                'label'   => self::TRANSLATION_KEY . '.navigation.main',
                'url'     => Backend::url(self::BACKEND_MENU_PATH . '/categories'),
                'iconSvg' => '/plugins/' . self::BACKEND_MENU_PATH . '/assets/favicons/plugin-icon.svg',
                'order'   => 300,

                'sideMenu' => [
                    'services' => [
                        'label' => self::TRANSLATION_KEY . '.navigation.services',
                        'icon'  => 'icon-shopping-bag',
                        'url'   => Backend::url(self::BACKEND_MENU_PATH . '/services')
                    ],
                    'categories' => [
                        'label' => self::TRANSLATION_KEY . '.navigation.categories',
                        'icon'  => 'icon-list',
                        'url'   => Backend::url(self::BACKEND_MENU_PATH . '/categories')
                    ]
                ]
            ]
        ];
    }

    /**
     * @return void
     */
    public function boot(): void
    {
        /*
         * Register menu items for the RainLab.Pages plugin
         */
        Event::listen('pages.menuitem.listTypes', function () {
            return [
                'service-categories' => self::TRANSLATION_KEY . '.menu_item.service-categories'
            ];
        });

        Event::listen('pages.menuitem.getTypeInfo', function ($type) {
            if ($type == 'service-categories') {
                return Category::getMenuTypeInfo();
            }
        });

        Event::listen('pages.menuitem.resolveItem', function($type, $item, $url, $theme) {
            if ($type == 'service-categories') {
                return Category::resolveMenuItem($item, $url, $theme);
            }
        });
    }
}
