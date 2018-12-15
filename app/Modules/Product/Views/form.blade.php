@extends('layouts.master')
@if(empty($data["info"]))
@section('title','Product - Create' )
@else
@section('title','Product - Edit' )
@endif
@section('breadcrumb')
<h4><i class="icon-arrow-left52 position-left"></i>Product - @if(empty($data["info"])) Create @else Edit @endif</h4>
@stop
@section('quick_link')
<a href="{{ route('product.index') }}" class="btn btn-info btn-labeled" title="List"><b><i class="icon-list-unordered"></i></b>List</a>
@stop
@section('js')
<script type="text/javascript" src="{{ asset("public/assets/js/plugins/forms/styling/switch.min.js") }}"></script>
<script type="text/javascript" src="{{ asset("public/assets/js/plugins/forms/styling/switchery.min.js") }}"></script>
@stop
@section('content')
<form class="form-validate-jquery" enctype="multipart/form-data"  action="{{URL::route("product.store")}}" method="post">
    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>" />
    <div class="panel panel-flat">
        <div class="panel-body">
            <div class="row">

                <div class="col-md-12">
                    <fieldset>
                        <legend class="text-semibold">Product Detail</legend>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label required">Product Title <span style="color:red;">*</span></label>
                                    <input maxlength="100" autocomplete="off" value="@if(!empty($data['info'])){{$data['info']->product_title}}@endif" name="txtproducttitle" id="txtfname" type="text" placeholder="Product Title" class="form-control required">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label required">Category <span style="color:red;">*</span></label>
                                    <select name="category_id">
                                        <option value="">Select Category</option>
                                        @foreach($data["cat_list"] as $val)
                                            @if(!empty($data['info']) && $data['info']->category_id == $val->id)
                                                <option selected="" value="{{$val->id}}">{{$val->category_title}}</option>
                                            @else
                                                <option value="{{$val->id}}">{{$val->category_title}}</option>
                                            @endif
                                            @if(!empty($val->children))
                                                @foreach($val->children as $cval)
                                                    @if(!empty($data['info']) && $data['info']->category_id == $cval->id)
                                                        <option selected="" value="{{$cval->id}}">-- {{$cval->category_title}}</option>
                                                    @else
                                                        <option value="{{$cval->id}}">-- {{$cval->category_title}}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label required">SKU <span style="color:red;">*</span></label>
                                    <input maxlength="150" autocomplete="off" value="@if(!empty($data['info'])){{$data['info']->product_sku}}@endif" name="txtsku" id="txtsku" type="text" placeholder="Product SKU" class="form-control required">
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label required">Description</label>
                                    <textarea placeholder="Write about product description" class="form-control required" name="txtdesc">@if(!empty($data['info'])){{$data['info']->product_desc}}@endif</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label required">Product Type <span style="color:red;">*</span></label>
                                    <select name="product_type" id="product_type" >
                                        <option value="">Select Product Type</option>
                                        @foreach(Config::get("constant.product_type") as $key => $val)
                                            @if(!empty($data['info']) && $data['info']->product_type == $key)
                                                <option selected="" value="{{$key}}">{{$val}}</option>
                                            @else
                                                <option value="{{$key}}">{{$val}}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label required">Gallery</label>
                                    <input type="file" name="product_pic" id="product_pic" class="form-control" />
                                </div>
                            </div>
                        </div>
                        @if(!empty($data['info']))
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label required"></label>
                                    <img src="{{url('/public/uploads/products/')}}/{{$data["info"]->product_pic}}" width="100">
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="form-group">
                            <label class="control-label">Is Active ? </label>
                            <div class="checkbox checkbox-switch">
                                <label>
                                    <input name="status" id="status" value="1" type="checkbox" data-on-color="primary" data-off-color="danger" data-on-text="Active" data-off-text="Deactive" class="switch" checked="checked">
                                </label>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>

            <div class="text-right">
                <input type="hidden" name="id" id="id" value="{{$data["id"]}}" />
                <input type="hidden" name="oimg" id="oimg" value="@if(!empty($data['info'])){{$data['info']->product_pic}}@endif" />
                <button type="button" class="btn btn-default" onclick="javascript:location.href ='{{URL::route("product.index")}}'">Cancel</button>
                <button type="submit" class="btn btn-primary">Save <i class="icon-arrow-right14 position-right"></i></button>
            </div>
        </div>
    </div>
</form>
@stop
@push("scripts")
<script type="text/javascript">
    $(document).ready(function () {
        $(".switch").bootstrapSwitch();
        
        @if(empty($data["info"]) || $data["info"]->status == 1)
            $('#status').bootstrapSwitch('state',true);
        @else
            $('#status').bootstrapSwitch('state',false);
        @endif

        $("select").select2();
        
        $(".form-validate-jquery").validate({
                focusInvalid: false, // do not focus the last invalid input
                ignore: "input[type=hidden], .select2-input",
                invalidHandler: function (event, validator) { //display error alert on form submit              
                    $('.alert-danger').show();
                    $('html, body').animate({
                    scrollTop: $("body").offset().top
                    }, 2000);
                },
                highlight: function (element) { // hightlight error inputs
                    $(element).closest('.form-group').addClass('error'); // set error class to the control group
                },
                unhighlight: function (element) { // revert the change done by hightlight
                    $(element).closest('.form-group').removeClass('error'); // set error class to the control group
                },
                rules: {
                    txtsku : {
                        remote: '{{URL::route("product.skuvalidation",[$data["id"]])}}',
                    }
                },
                messages: {
                    txtsku : {
                        remote: 'Product SKU is already exits.',
                    }
                }
        });
       
    });

</script>
@endpush

