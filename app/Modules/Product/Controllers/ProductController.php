<?php

namespace App\Modules\Product\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use App\Modules\Product\Models\Product;
use App\Modules\Category\Models\Category;
use Auth;
use Session;

class ProductController extends Controller {

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Response
     * @author Vijay Vyas <visicrux@gmail.com>
     */
    public function index(Request $request) {
        if ($request->ajax()) {
            $acc_obj = new Product();
            $data = $acc_obj->fetchAllDatatable();
            return $data;
        }
        return view("Product::index");
    }

    /**
     * It will create form
     * @return type
     * @author Vijay Vyas <visicrux@gmail.com>
     */
    public function create() {
        $data["id"] = 0;
        $cat_obj = new Category();
        $data["cat_list"] = $cat_obj->getActiveCategory();
        return view("Product::form")->with("data", $data);
    }

    /**
     * It will store product data
     * @param Request $request
     * @return type
     * @author Vijay Vyas <visicrux@gmail.com>
     */
    public function store(Request $request) {
        try {

            $id = $request->input("id");
            $arr = array();
            $arr["category_id"] = $request->input("category_id");
            $arr["product_title"] = $request->input("txtproducttitle");
            $arr["product_sku"] = $request->input("txtsku");
            $arr["product_desc"] = $request->input("txtdesc");
            $arr["product_type"] = $request->input("product_type");

            $arr["status"] = !empty($request->input("status")) ? 1 : 0;


            if ($request->hasFile('product_pic')) {
                $image = $request->file('product_pic');
                if(!empty($request->input("oimg"))){
                    @unlink(public_path('/uploads/products/').$request->input("oimg"));
                }
                $name = time() . '.' . $image->getClientOriginalExtension();
                $destinationPath = public_path('/uploads/products/');
                $image->move($destinationPath, $name);
                $arr["product_pic"] = $name;
            }
            else {
                $arr["product_pic"] = $request->input("oimg");
            }

            if (empty($id)) {
                $arr["created_by"] = Auth::user()->id;
            } else {
                $arr["modified_by"] = Auth::user()->id;
            }
            Product::updateOrCreate(["id" => $id], $arr);
            Session::flash('flash_message', "Product has been saved successfully.");
        } catch (\Illuminate\Database\QueryException $e) {
          Session::flash('error_message', "Oops! Something went wrong. Please contact to productistrator.");
        }  catch (Exception $ex) {
            Session::flash('error_message', "Oops! Something went wrong. Please contact to productistrator.");
        }
        return Redirect::route("product.index");
    }

    /**
     * fetch edit data
     * @param type $id
     * @author Vijay Vyas <visicrux@gmail.com>
     */
    public function edit($id) {
        try {
            $data["id"] = $id;
            $product_obj = new Product();
            $data["info"] = $product_obj->findById($id);

            if (empty($data["info"])) {
                Session::flash('error_message', "Oops! Product not found.");
                return Redirect::route("product.index");
            }

            //---- get category list
            $cat_obj = new Category();
            $data["cat_list"] = $cat_obj->getActiveCategory();

            return view("Product::form")->with("data", $data);
        } catch (Illuminate\Database\QueryException $e) {
            Session::flash('error_message', "Oops! Something went wrong. Please contact to administrator");
            return Redirect::route("product.index");
        } catch (Exception $ex) {
            Session::flash('error_message', "Oops! Something went wrong. Please contact to administrator");
            return Redirect::route("product.index");
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param  int $id
     * @return Response
     * @author Vijay Vyas <visicrux@gmail.com>
     */
    public function destroy($id) {
        try {
            $model = new Product();
            $data = $model->findById($id);
            $data->delete();

            Session::flash('flash_message', "Product has been deleted successfully.");
        } catch (\Illuminate\Database\QueryException $e) {
            Session::flash('error_message', "Oops! Something went wrong. Please contact to productistrator.");
        } catch (Exception $ex) {
            Session::flash('error_message', "Oops! Something went wrong. Please contact to productistrator.");
        }
        return Redirect::route("product.index");
    }

    /**
     * It will check product sku if is exits in our database
     * @param Request $request
     * @author Vijay Vyas <visicrux@gmail.com>
     */
    public function skuvalidation(Request $request, $id) {
        $email = $request->input("txtsku");
        $query = Product::where("product_sku", $email);
        if (!empty($id)) {
            $query->where("id", "<>", $id);
        }
        $isFound = $query->count();
        if ($isFound > 0) {
            echo "false";
        } else {
            echo "true";
        }
    }

}
