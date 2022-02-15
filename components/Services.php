<?php

namespace PhilippKuhn\ServiceManager\Components;

use Cms\Classes\ComponentBase;
use PhilippKuhn\ServiceManager\Models\Category;
use PhilippKuhn\ServiceManager\Models\Service;
use PhilippKuhn\ServiceManager\Plugin;
use Winter\Storm\Database\Collection;
use Winter\Storm\Database\Model;

class Services extends ComponentBase
{
    /**
     * @var Category|null
     */
    private $category;

    /**
     * @var Collection
     */
    public $services;


    /**
     * @return string[]
     */
    public function componentDetails(): array
    {
        return [
            'name'        => Plugin::TRANSLATION_KEY . 'component.services.name',
            'description' => Plugin::TRANSLATION_KEY . 'component.services.description'
        ];
    }

    /**
     * @return array
     */
    public function defineProperties (): array
    {
        return [
            'category' => [
                'title'       => Plugin::TRANSLATION_KEY . 'component.services.property_category',
                'description' => Plugin::TRANSLATION_KEY . 'component.services.property_category_description',
                'type'        => 'string',
                'default'     => '{{ :slug }}'
            ],
            'displayInactive' => [
                'title'       => Plugin::TRANSLATION_KEY . 'component.services.property_inactive',
                'description' => Plugin::TRANSLATION_KEY . 'component.services.property_inactive_description',
                'type'        => 'checkbox',
                'default'     => 0
            ],
            'displaySpecial' => [
                'title'       => Plugin::TRANSLATION_KEY . 'component.services.property_special',
                'description' => Plugin::TRANSLATION_KEY . 'component.services.property_special_description',
                'type'        => 'checkbox',
                'default'     => 0
            ],
        ];
    }

    public function onRun ()
    {
        $this->category = $this->loadCategory();
        $this->services = $this->loadServices();
    }

    /**
     * @return Category|null
     */
    public function loadCategory (): ?Category
    {
        if (!$slug = $this->property('category')) {
            return null;
        }

        $category = Category::where('slug', $slug)->first();

        return $category ?: null;
    }

    /**
     * @return Collection
     */
    protected function loadServices (): Collection
    {
        $services = $this->category
            ? $this->category->services()->orderBy('sort_order', 'asc')
            : Service::orderBy('sort_order', 'asc');

        if (!$this->property('displayInactive')) {
            $services = $services->where('is_active', 1);
        }
        if ($this->property('displaySpecial')) {
            $services = $services->where('is_special', 1);
        }
        return $services->get();
    }
}
