<?php

namespace PhilippKuhn\ServiceManager\Components;

use Cms\Classes\ComponentBase;
use PhilippKuhn\ServiceManager\Models\Category as CategoryModel;
use PhilippKuhn\ServiceManager\Plugin;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Category extends ComponentBase
{
    public const COMPONENT_KEY = 'serviceManagerCategory';

    public CategoryModel $category;

    /**
     * @return string[]
     */
    public function componentDetails(): array
    {
        return [
            'name'        => Plugin::TRANSLATION_KEY . '.component.category.name',
            'description' => Plugin::TRANSLATION_KEY . '.component.category.description'
        ];
    }

    /**
     * @return array
     */
    public function defineProperties(): array
    {
        return [
            'slug' => [
                'title'       => Plugin::TRANSLATION_KEY . '.component.category.property_slug',
                'description' => Plugin::TRANSLATION_KEY . '.component.category.property_slug_description',
                'default'     => '{{ :slug }}',
                'type'        => 'string',
            ]
        ];
    }

    /**
     * @return void
     */
    public function onRun (): void
    {
        $this->category = $this->loadCategory();
    }

    /**
     * @return CategoryModel
     */
    protected function loadCategory (): CategoryModel
    {
        $category = CategoryModel::where('slug', $this->property('slug'))->where('is_active', true)->first();

        if (!$category) {
            throw new NotFoundHttpException();
        }
        return $category;
    }
}
