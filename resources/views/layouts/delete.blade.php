<li>
    {!! Form::open(['name'=>'delete','method'=> 'delete','class'=> 'form-inline pull-right' , 'route' => [$route, $model->id] ]) !!}
    <a href="javascript:void(0);" class="text-danger-600"
       onclick="if (confirm('Are you sure want to delete ?')) { $(this).closest('form').submit(); }"
       title="Delete"><i style="top:4px;" class="{{ (isset($icon)) ? $icon : 'icon-trash'}}"></i></a>
    {!! Form::close() !!}
</li>