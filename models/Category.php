<?php

namespace PhilippKuhn\ServiceManager\Models;


use Backend\Facades\BackendAuth;
use Cms\Classes\Controller;
use Cms\Classes\Page as CmsPage;
use Cms\Classes\Theme;
use Illuminate\Support\Facades\Lang;
use PhilippKuhn\ServiceManager\Components\Category as CategoryComponent;
use PhilippKuhn\ServiceManager\Plugin;
use RainLab\Pages\Classes\MenuItem;
use System\Models\File;
use Winter\Storm\Database\Model;
use Winter\Storm\Database\Traits\Sluggable;
use Winter\Storm\Database\Traits\SoftDelete;
use Winter\Storm\Database\Traits\Sortable;
use Winter\Storm\Database\Traits\Validation;
use Winter\Storm\Exception\ApplicationException;

class Category extends Model
{
    use Sortable;
    use SoftDelete;
    use Sluggable;
    use Validation;

    public const TABLE_NAME = Plugin::TABLE_NAME_PREFIX . '_categories';

    /**
     * @var string
     */
    protected $table = self::TABLE_NAME;

    /**
     * @var string[]
     */
    protected $dates = [
        'published_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected array $slugs = [
        'slug' => 'name'
    ];

    /**
     * Also take deleted entries into consideration when creating the slug
     */
    protected bool $allowTrashedSlugs = true;

    public array $rules = [
        'name' => 'required',
        'slug' => ['required', 'regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i', 'unique:' . self::TABLE_NAME]
    ];

    /**
     * @var string[]
     */
    public $hasMany = [
        'services'       => Service::class,
        'services_count' => [Service::class, 'count' => true]
    ];

    /**
     * @var string[]
     */
    public $attachOne = [
        'banner' => File::class
    ];

    /**
     * @param string $pageName
     * @param Controller $controller
     * @return string|null
     */
    public function setUrl (string $pageName, Controller $controller): ?string
    {
        return $this->url = $controller->pageUrl($pageName, [
            'slug' => $this->slug
        ]);
    }

    /**
     * @throws ApplicationException
     */
    public function beforeSave(): void
    {
        $this->checkUser();
    }

    /**
     * @throws ApplicationException
     */
    public function beforeDelete(): void
    {
        $this->checkUser();
    }

    /**
     * @throws ApplicationException
     */
    private function checkUser(): void
    {
        $user = BackendAuth::getUser();

        if (!$user->hasAccess(Plugin::PLUGIN_KEY . '.edit')) {
            throw new ApplicationException(Lang::get(Plugin::TRANSLATION_KEY . '.error.permission_denied'));
        }
    }

    /**
     * Handler for the pages.menuitem.getTypeInfo event.
     * Returns a menu item type information. The type information is returned as array
     * with the following elements:
     * - references - a list of the item type reference options. The options are returned in the
     *   ["key"] => "title" format for options that don't have sub-options, and in the format
     *   ["key"] => ["title"=>"Option title", "items"=>[...]] for options that have sub-options. Optional,
     *   required only if the menu item type requires references.
     * - nesting - Boolean value indicating whether the item type supports nested items. Optional,
     *   false if omitted.
     * - dynamicItems - Boolean value indicating whether the item type could generate new menu items.
     *   Optional, false if omitted.
     * - cmsPages - a list of CMS pages (objects of the Cms\Classes\Page class), if the item type requires a CMS page reference to
     *   resolve the item URL.
     * @return array
     */
    public static function getMenuTypeInfo (): array
    {
        $result = [
            'dynamicItems' => true
        ];

        // Get valid CMS pages
        $theme = Theme::getActiveTheme();
        $pages = CmsPage::listInTheme($theme, true);
        $cmsPages = [];
        foreach ($pages as $page) {
            if (!$page->hasComponent(CategoryComponent::COMPONENT_KEY)) {
                continue;
            }

            $cmsPages[] = $page;
        }

        $result['cmsPages'] = $cmsPages;

        return $result;
    }

    /**
     * Handler for the pages.menuitem.resolveItem event.
     * Returns information about a menu item. The result is an array
     * with the following keys:
     * - url - the menu item URL. Not required for menu item types that return all available records.
     *   The URL should be returned relative to the website root and include the subdirectory, if any.
     *   Use the Url::to() helper to generate the URLs.
     * - isActive - determines whether the menu item is active. Not required for menu item types that
     *   return all available records.
     * - items - an array of arrays with the same keys (url, isActive, items) + the title key.
     *   The items array should be added only if the $item's $nesting property value is TRUE.
     * @param MenuItem $item
     * @param Theme $theme
     * @param string $url Specifies the current page URL, normalized, in lower case
     * The URL is specified relative to the website root, it includes the subdirectory name, if any.
     * @return array
     */
    public static function resolveMenuItem (MenuItem $item, string $url, Theme $theme): array
    {
        $result = [
            'items' => []
        ];

        $categories = self::orderBy('sort_order', 'asc')->where('is_active', 1)->get();

        foreach ($categories as $category) {
            $categoryItem = [
                'title' => $category->name,
                'url' => self::getCategoryPageUrl($item->cmsPage, $category, $theme)
            ];
            $categoryItem['isActive'] = $category->url === $url;
            $result['items'][] = $categoryItem;
        }

        return $result;
    }

    /**
     * @param string $pageName
     * @param CategoryComponent $category
     * @param Theme $theme
     * @return string
     */
    protected static function getCategoryPageUrl (string $pageName, CategoryComponent $category, Theme $theme): string
    {
        $page = CmsPage::loadCached($theme, $pageName);
        return CmsPage::url($page->getBaseFileName(), ['slug' => $category->slug]);
    }
}
