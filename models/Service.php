<?php

namespace PhilippKuhn\ServiceManager\Models;


use Backend\Facades\BackendAuth;
use Illuminate\Support\Facades\Lang;
use PhilippKuhn\ServiceManager\Plugin;
use Winter\Storm\Database\Model;
use Winter\Storm\Database\Traits\SoftDelete;
use Winter\Storm\Database\Traits\Sortable;
use Winter\Storm\Exception\ApplicationException;

class Service extends Model
{
    use Sortable;
    use SoftDelete;

    public const TABLE_NAME = Plugin::TABLE_NAME_PREFIX . 'services';

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
     * @var string
     */
    protected $table = self::TABLE_NAME;

    /**
     * @var string[]
     */
    public $belongsTo = [
        'category' => 'PhilippKuhn\ServiceManager\Models\Category'
    ];

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
