@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h1>{{ trans('form.search_description') }}</h1>
            {{ Form::open(['url'=>'search', 'action'=>'post']) }}
            <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    {{ Form::text('search', old('search'), ['class'=>'form-control']) }}
                  </div>
                </div>
            </div>
            {{ Form::button(trans('form.btn_search'), ['type'=>'submit', 'class'=>'btn btn-primary']) }}
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
