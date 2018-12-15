<?php
/**
 * @author Vijay Vyas <visicrux@gmail.com>
 */

namespace App\Modules\Product\Models;

use App\Models\Ventive;
use Auth;
use DB;
use Yajra\DataTables\DataTables;

class Product extends Ventive {

    protected $table = 'products';
    protected $fillable = [
        'category_id',
        'product_title',
        'product_sku',
        'product_desc',
        'product_type',
        'product_pic',
        'status',
        'created_by',
        'modified_by',
        'created_at',
        'modified_at',
    ];
    
    /**
     * Relation between Country & Product
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
     * It will prepare query for datatable
     * @return type
     * @author Vijay Vyas <visicrux@gmail.com>
     */
    public function fetchAllDatatable() {
        $q = parent::query();
        return Datatables::of($q)
                        ->addColumn('status', function ( $q ) {
                            if ($q->status == 1) {
                                return '<lable class="label bg-success-400">Active</lable>';
                            } else {
                                return '<lable class="label bg-danger-400">Deactive</lable>';
                            }
                        })
                        ->addColumn('created_at', function ( $q ) {
                            return date("d/m/Y", strtotime($q->created_at));
                        })
                        ->addColumn('product_pic', function ( $q ) {
                            if(!empty($q->product_pic)){
                                return '<img width=100 src="'.url("public/uploads/products/")."/".$q->product_pic.'" />';
                            }
                            else {
                                return '-';
                            }
                        })
                        ->addColumn('actions', function ( $q ) {
                            $action = '<ul class="icons-list text-center">';
                            $action .= '<li class="text-primary-600"><a href="' . route('product.edit', $q->id) . '" title="Edit"><i class="icon-pencil7"></i></a></li>';
                            $action .= view('layouts.delete')->with('model', $q)->with('route', 'product.destroy');
                            $action .= '</ul>';
                            return $action;
                        })
                        ->rawColumns(['status', 'actions','product_pic'])
                        ->make(true);
    }

}
