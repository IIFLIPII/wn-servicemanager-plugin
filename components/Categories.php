<?php

namespace PhilippKuhn\ServiceManager\Components;

use Cms\Classes\ComponentBase;
use Cms\Classes\Page;
use PhilippKuhn\ServiceManager\Models\Category;
use PhilippKuhn\ServiceManager\Plugin;
use Winter\Storm\Database\Collection;

class Categories extends ComponentBase
{
    public const COMPONENT_KEY = 'serviceManagerCategories';

    public Collection $categories;


    /**
     * @return string[]
     */
    public function componentDetails(): array
    {
        return [
            'name'        => Plugin::TRANSLATION_KEY . '.component.categories.name',
            'description' => Plugin::TRANSLATION_KEY . '.component.categories.description'
        ];
    }

    /**
     * @return array
     */
    public function defineProperties (): array
    {
        return [
            'displayInactive' => [
                'title'       => Plugin::TRANSLATION_KEY . '.component.categories.property_inactive',
                'description' => Plugin::TRANSLATION_KEY . '.component.categories.property_inactive_description',
                'type'        => 'checkbox',
                'default'     => 0
            ],
            'categoryPage' => [
                'title'       => Plugin::TRANSLATION_KEY . '.component.categories.property_page',
                'description' => Plugin::TRANSLATION_KEY . '.component.categories.property_page_description',
                'type'        => 'dropdown',
                'group'       => Plugin::TRANSLATION_KEY . '.component.categories.group_links',
            ]
        ];
    }

    /**
     * @return array
     */
    public function getCategoryPageOptions (): array
    {
        return Page::getNameList();
    }

    /**
     * @return void
     */
    public function onRun (): void
    {
        $this->categories = $this->loadCategories();
    }

    /**
     * @return Collection
     */
    protected function loadCategories (): Collection
    {
        $categories = Category::orderBy('sort_order', 'asc');
        if (!$this->property('displayInactive')) {
            $categories = $categories->where('is_active', true);
        }
        $categories = $categories->get();

        $categories->each(function ($category) {
           $category->setUrl($this->property('categoryPage'), $this->controller);
        });

        return $categories;
    }
}
