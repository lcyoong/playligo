@extends('layouts.admin_page')

@section('content_page')
<div class="section details-news">
  <div class="entry-meta">
    <ul class="list-inline">
      <li class="publish-date"><a href="#"><i class="fa fa-clock-o"></i> {{ $user->created_at }} </a></li>
    </ul>
  </div>
  <div class="row">
      <div class="col-md-6">
        {{ Form::open(['url'=>url('admin/user/edit'), 'method'=>'post', 'class'=>'submit-ajax' ]) }}
        {{ Form::hidden('id', $user->id) }}
        <div class="form-group">
          {{ Form::label('name', trans('user.name'), ['class'=>'control-label']) }}
          {{ Form::text('name', $user->name, ['class'=>'form-control']) }}
        </div>
        <div class="form-group">
          {{ Form::label('email', trans('user.email'), ['class'=>'control-label']) }}
          {{ Form::text('email', $user->email, ['class'=>'form-control']) }}
        </div>
        <div class="form-group">
          {{ Form::label('status', trans('user.status'), ['class'=>'control-label']) }}
          {{ Form::text('status', $user->status, ['class'=>'form-control']) }}
        </div>
        <div class="form-group">
            {{ Form::button(trans('form.btn_submit'), ['type'=>'submit', 'class'=>'btn btn-primary']) }}
        </div>
        {{ Form::close() }}
      </div>
    </div>
</div>
@endsection
