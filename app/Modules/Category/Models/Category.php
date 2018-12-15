<?php
/**
 * @author Vijay Vyas <visicrux@gmail.com>
 */

namespace App\Modules\Category\Models;

use App\Models\Ventive;
use Auth;
use DB;
use Yajra\DataTables\DataTables;

class Category extends Ventive {

    protected $table = 'categories';
    protected $fillable = [
        'parent_id',
        'category_title',
        'status',
        'created_by',
        'modified_by',
        'created_at',
        'modified_at',
    ];
    
    /**
     * Relation between Country & Category
     * @return type
     * @author Vijay Vyas <visicrux@gmail.com>
     */
    public function admin() {
        return $this->belongsTo('App\Modules\Admin\Models\Admin',"created_by");
    }

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
    
    
    /**
     * get category with its different level
     * @param array $elements
     * @param type $parentId
     * @return array
     * @author Vijay Vyas <visicrux@gmail.com>
     */
    public function __getCategory($elements, $parentId = 0) {
        $branch = array();
        foreach ($elements as $element) {
            if ($element->parent_id == $parentId) {
                $children = $this->__getCategory($elements, $element->id);
                if ($children) {
                    $element->children = $children;
                }
                $branch[] = $element;
            }
        }
        return $branch;
    }
    
    /**
     * It will fetch active category
     * @return type
     * @author Vijay Vyas <visicrux@gmail.com>
     */
    public function getActiveCategory(){
        $opt = [];
        $opt["where"] = ["status" => 1];
        $cat_obj = new Category();
        $cat_list = $cat_obj->find($opt);
        $cat_lists = $cat_obj->__getCategory($cat_list);
        return $cat_lists;
    }
    
    
    
    

}
