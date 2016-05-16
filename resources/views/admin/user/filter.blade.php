{{ Form::open(['url'=>url('admin/user/search'), 'method'=>'post' ]) }}
<div class="row">
  <div class="col-md-3">
    <div class="form-group">
    {{ Form::label('name', trans('user.name'), ['class'=>'control-label']) }}
    {{ Form::text('name', array_get($search, 'name'), ['class'=>'form-control']) }}
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
    {{ Form::label('email', trans('user.email'), ['class'=>'control-label']) }}
    {{ Form::text('email', array_get($search, 'email'), ['class'=>'form-control']) }}
    </div>
  </div>
</div>
<div class="form-group">
{{ Form::button(trans('form.btn_search'), ['type'=>'submit', 'class'=>'btn btn-primary']) }}
{{ Form::button(trans('form.btn_clear_search'), ['type'=>'submit', 'class'=>'btn btn-primary btn-clear']) }}
</div>
{{ Form::close() }}
