<?php

namespace PhilippKuhn\ServiceManager\Models;


use Backend\Facades\BackendAuth;
use Illuminate\Support\Facades\Lang;
use PhilippKuhn\ServiceManager\Plugin;
use Winter\Storm\Database\Model;
use Winter\Storm\Database\Traits\SoftDelete;
use Winter\Storm\Database\Traits\Sortable;
use Winter\Storm\Database\Traits\Validation;
use Winter\Storm\Exception\ApplicationException;

class Service extends Model
{
    use Sortable;
    use SoftDelete;
    use Validation;

    public const TABLE_NAME = Plugin::TABLE_NAME_PREFIX . '_services';

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

    public array $rules = [
        'name' => 'required',
        'slug' => ['required', 'regex:/^[a-z0-9\/\:_\-\*\[\]\+\?\|]*$/i', 'unique:' . self::TABLE_NAME],
        'price' => 'required',
        'time' => 'required'
    ];

    /**
     * @var string[]
     */
    public $belongsTo = [
        'category' => Category::class
    ];

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
}
