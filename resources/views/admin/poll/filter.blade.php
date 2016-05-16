{{ Form::open(['url'=>url('admin/poll/search'), 'method'=>'post' ]) }}
<div class="row">
  <div class="col-md-3">
    <div class="form-group">
    {{ Form::label('pol_title', trans('poll.pol_title'), ['class'=>'control-label']) }}
    {{ Form::text('pol_title', array_get($search, 'pol_title'), ['class'=>'form-control']) }}
    </div>
  </div>
  <div class="col-md-3">
    <div class="form-group">
    {{ Form::label('pol_user', trans('poll.pol_user'), ['class'=>'control-label']) }}
    {{ Form::text('pol_user', array_get($search, 'pol_user'), ['class'=>'form-control']) }}
    </div>
  </div>
</div>
<div class="form-group">
{{ Form::button(trans('form.btn_search'), ['type'=>'submit', 'class'=>'btn btn-primary']) }}
{{ Form::button(trans('form.btn_clear_search'), ['type'=>'submit', 'class'=>'btn btn-primary btn-clear']) }}
</div>
{{ Form::close() }}
