<?php

namespace App\Modules\Admin\Models;

use App\Models\Ventive;

class Admin extends Ventive {

    protected $table = 'users';
    protected $fillable = [
        'fname',
        'lname',
        'email',
        'password',
        'status',
        'remember_token',
        'created_by',
        'modified_by',
        'created_at',
        'modified_at',
    ];

    /**
     * 
     * @param type $options
     * @return type
     */
    protected function _getQuery($options = []) {
        $query = parent::query();
        return $query;
    }

    /**
     * 
     * @return string
     */
    public function getFetchCols() {
        $cols = [
            $this->getTable() . ".*",
        ];
        return $cols;
    }

}
