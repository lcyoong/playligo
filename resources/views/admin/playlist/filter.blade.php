{{ Form::open(['url'=>url('admin/playlist/search'), 'method'=>'post' ]) }}
<div class="row">
  <div class="col-md-3">
    <div class="form-group">
    {{ Form::label('pl_title', trans('playlist.pl_title'), ['class'=>'control-label']) }}
    {{ Form::text('pl_title', array_get($search, 'pl_title'), ['class'=>'form-control']) }}
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
    {{ Form::label('pl_user', trans('playlist.pl_user'), ['class'=>'control-label']) }}
    {{ Form::text('pl_user', array_get($search, 'pl_user'), ['class'=>'form-control']) }}
    </div>
  </div>
</div>
<div class="form-group">
{{ Form::button(trans('form.btn_search'), ['type'=>'submit', 'class'=>'btn btn-primary']) }}
{{ Form::button(trans('form.btn_clear_search'), ['type'=>'submit', 'class'=>'btn btn-primary btn-clear']) }}
</div>
{{ Form::close() }}
