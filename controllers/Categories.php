<?php

namespace PhilippKuhn\ServiceManager\Controllers;

use Backend\Classes\Controller;
use Backend\Facades\BackendMenu;
use PhilippKuhn\ServiceManager\Models\Category;

class Categories extends Controller
{
    /**
     * @var string[]
     */
    public $implement = [
        'Backend.Behaviors.ListController',
        'Backend.Behaviors.ReorderController',
        'Backend.Behaviors.FormController'
    ];

    /**
     * @var string
     */
    public $listConfig = 'config_list.yaml';

    /**
     * @var string
     */
    public $reorderConfig = 'config_reorder.yaml';

    /**
     * @var string
     */
    public $formConfig = 'config_form.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('PhilippKuhn.ServiceManager', 'servicemanager', 'categories');
    }

    /**
     * @param Category $record
     * @param string|null $definition
     * @return string
     */
    public function listInjectRowClass(Category $record, string $definition = null): string
    {
        if (!$record->is_active) {
            return 'disabled';
        }
        return '';
    }
}
