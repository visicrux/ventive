<?php

/**
 * @author Vijay Vyas <visicrux@gmail.com>
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;
use Auth;

class Ventive extends Model {

    const UPDATED_AT = 'updated_at';
    const CREATED_AT = 'created_at';

    /**
     * it will create query
     * @author Vijay Vyas <visicrux@gmail.com>
     */
    protected static function boot() {
        parent::boot();
    }

    /**
     * delete query
     * @return type
     * @author Vijay Vyas <visicrux@gmail.com>
     */
    public function delete() {
        $delete = parent::delete();
        return $delete;
    }

    /**
     * It will prepare query and execute based on passing parameter
     * @param type $options
     * @return type
     * @author Vijay Vyas <visicrux@gmail.com>
     */
    public function find($options = []) {

        $columns = isset($options["cols"]) ? $options["cols"] : $this->getFetchCols();
        $query = $this->_getQuery($options);

        if (isset($options['orderBy'])) {
            // Get default order
            $order = isset($options['order']) ? $options['order'] : 'ASC';
            $query->orderBy($options['orderBy'], $order);
        }
        if (isset($options['whereNot'])) {
            if (is_array($options['whereNot'])) {
                foreach ($options['whereNot'] as $key => $value) {
                    $query->where($key, '!=', $value);
                }
            }
        }

        if (isset($options['whereIn'])) {
            if (is_array($options['whereIn'])) {
                foreach ($options['whereIn'] as $key => $value) {
                    $query->whereIn($key, $value);
                }
            }
        }

        if (isset($options['whereNotIn'])) {
            if (is_array($options['whereNotIn'])) {
                foreach ($options['whereNotIn'] as $key => $value) {
                    $query->whereNotIn($key, $value);
                }
            }
        }

        if (isset($options['whereNotNull'])) {
            if (is_array($options['whereNotNull'])) {
                foreach ($options['whereNotNull'] as $value) {
                    $query->whereNotNull($value);
                }
            } else {
                $query->whereNotNull($options['whereNotNull']);
            }
        }

        if (isset($options['whereNull'])) {
            if (is_array($options['whereNull'])) {
                foreach ($options['whereNull'] as $key => $value) {
                    $query->whereNull($key, $value);
                }
            } else {
                $query->whereNull($options['whereNull']);
            }
        }

        if (isset($options['where'])) {
            if (is_array($options['where'])) {
                foreach ($options['where'] as $key => $value) {
                    $sign = "=";
                    if (strpos($key, " ") !== false) {
                        $parts = explode(" ", $key);
                        $sign = $parts[1];
                        $key = $parts[0];
                    }
                    $query->where($key, $sign, $value);
                }
            } else {
                $query->where($options['where']);
            }
        }

        if (isset($options['withtrashed'])) {
            $query->withTrashed();
        }

        if (isset($options['match']) && count($options['match'])) {
            $matches = $options['match'];
            $query->where(function($query) use ($matches, $options) {
                foreach ($matches as $key => $value) {
                    $query->orWhere($key, 'like', "%" . $value . "%");
                }

                if (isset($options['matchRaw']) && is_array($options['matchRaw'])) {

                    $matcheRaws = $options['matchRaw'];
                    foreach ($matcheRaws as $key => $value) {
                        $query->orWhereRaw("$key like  '%" . $value . "%'");
                    }
                }
            });
        }
        if (isset($options['limit'])) {
            $query->limit($options['limit']);
        }
        if (isset($options['offset'])) {
            $query->offset($options['offset']);
        }
        if (isset($options['firstOrFail']) && $options['firstOrFail'] == true) {
            $data = $query->firstOrFail($columns);
        } else if (isset($options['getFirst']) && $options['getFirst'] == true) {
            $data = $query->first($columns);
        } else if (isset($options['count']) && $options['count'] == true) {
            $data = $query->count();
        } else {
            $data = $query->get($columns);
        }

        if (isset($options["debug"]) && $options["debug"] == true) {
            echo ($query->toSql());
        }
        return $data;
    }

    /**
     * Get query information
     * @param type $options
     * @return type
     * @author Vijay Vyas <visicrux@gmail.com>
     */
    protected function _getQuery($options = []) {
        return parent::query();
    }

    /**
     * It will find record based on passing parameter
     * @param type $id
     * @param type $options
     * @return type
     * @author Vijay Vyas <visicrux@gmail.com>
     */
    public function findById($id, $options = []) {
        $data = $this->find(["where" => [$this->getTable() . ".id" => $id], "getFirst" => true] + $options);
        return $data;
    }

    /**
     * It will fetch column based on passing parameter. By default fetch all column.
     * @return type
     * @author Vijay Vyas <visicrux@gmail.com>
     */
    public function getFetchCols() {
        return ["*"];
    }

}
