@extends('layouts.app')

@section('content')
<div class="container">
  <div class="section">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h1>{{ trans('form.enter_first_destination') }}</h1>
            {{ Form::open(['url'=>'search_keywords', 'method'=>'get']) }}
            <div class="form-group">
              {{ Form::text('location', old('location'), ['class'=>'form-control', 'placeholder'=> trans('form.eg_destination')]) }}
            </div>
            {{ Form::button(trans('form.btn_search'), ['type'=>'submit', 'class'=>'btn btn-primary']) }}
            {{ Form::close() }}
        </div>
    </div>
  </div>
</div>

@endsection
