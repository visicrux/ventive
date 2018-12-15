<?php

/**
 * All common function goes here.
 * @author Vijay Vyas <visicrux@gmail.com>
 */

/**
 * it will print array in format
 * @param type $arr
 * @author Vijay Vyas <visicrux@gmail.com>
 */
function printarr($arr) {
    echo "<pre>";
    print_r($arr);
    echo "<pre>";
}

/**
 * It will print the SQL with all parameter
 * @param type $builder
 * @return type
 * @author Vijay Vyas <visicrux@gmail.com>
 */
function getSQL($builder) {
    $sql = $builder->toSql();
    foreach ($builder->getBindings() as $binding) {
        $value = is_numeric($binding) ? $binding : "'" . $binding . "'";
        $sql = preg_replace('/\?/', $value, $sql, 1);
    }
    return $sql;
}
