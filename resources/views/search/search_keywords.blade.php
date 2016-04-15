@extends('layouts.app')

@section('content')
<div class="container">
    <h1><span class="label label-success">Destination: {{ $location }}</span></h1>
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <h1>Any specific places to visit? Specific food and things to do?<br/>How would you describe this trip? Enter each keyword/phase in a box below...</h1>
            {{ Form::open(['url'=>'results', 'method'=>'get']) }}
            {{ Form::hidden('location', $location) }}
            <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    {{ Form::text('search_key[1]', old('search_key[1]'), ['class'=>'form-control', 'placeholder'=> 'e.g. Adventure' ]) }}
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    {{ Form::text('search_key[2]', old('search_key[2]'), ['class'=>'form-control', 'placeholder'=> 'e.g. Exotic food' ]) }}
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    {{ Form::text('search_key[3]', old('search_key[3]'), ['class'=>'form-control', 'placeholder'=> 'e.g. Off beaten track' ]) }}
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    {{ Form::text('search_key[4]', old('search_key[4]'), ['class'=>'form-control', 'placeholder'=> 'e.g. Beautiful scenery' ]) }}
                  </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    {{ Form::text('search_key[5]', old('search_key[5]'), ['class'=>'form-control', 'placeholder'=> '' ]) }}
                  </div>
                </div>
            </div>
            {{ Form::button(trans('form.btn_back'), ['type'=>'submit', 'class'=>'btn cancel-button btn-primary', 'goto'=>url('/search')]) }}
            {{ Form::button(trans('form.btn_search'), ['type'=>'submit', 'class'=>'btn btn-primary']) }}
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection
