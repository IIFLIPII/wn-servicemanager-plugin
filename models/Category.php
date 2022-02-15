<?php

namespace PhilippKuhn\ServiceManager\Models;


use Backend\Facades\BackendAuth;
use Cms\Classes\Controller;
use Illuminate\Support\Facades\Lang;
use PhilippKuhn\ServiceManager\Plugin;
use Winter\Storm\Database\Model;
use Winter\Storm\Database\Traits\Sluggable;
use Winter\Storm\Database\Traits\SoftDelete;
use Winter\Storm\Database\Traits\Sortable;
use Winter\Storm\Exception\ApplicationException;

class Category extends Model
{
    use Sortable;
    use SoftDelete;
    use Sluggable;

    public const TABLE_NAME = Plugin::TABLE_NAME_PREFIX . 'categories';

    /**
     * @var string[]
     */
    protected $dates = [
        'published_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * @var string[]
     */
    protected $slugs = [
        'slug' => 'name'
    ];

    /**
     * Also take deleted entries into consideration when creating the slug
     * @var bool
     */
    protected $allowTrashedSlugs = true;

    /**
     * @var string
     */
    protected $table = self::TABLE_NAME;

    /**
     * @var string[]
     */
    public $hasMany = [
        'services'       => 'PhilippKuhn\ServiceManager\Models\Service',
        'services_count' => ['PhilippKuhn\ServiceManager\Models\Service', 'count' => true]
    ];

    /**
     * @var string[]
     */
    public $attachOne = [
        'banner' => 'System\Models\File'
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
    public function beforeSave()
    {
        $this->checkUser();
    }

    /**
     * @throws ApplicationException
     */
    public function beforeDelete()
    {
        $this->checkUser();
    }

    /**
     * @throws ApplicationException
     */
    private function checkUser()
    {
        $user = BackendAuth::getUser();

        if (!$user->hasAccess('philippkuhn.servicemanager.edit')) {
            throw new ApplicationException(Lang::get('philippkuhn.servicemanager::lang.error.permission_denied'));
        }
    }
}
