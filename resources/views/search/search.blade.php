@extends('layouts.app')

@section('content')
<div class="main-search text-center section">
  <div class="main-search-inner">
      <div class="row">
        <div class="col-md-6 col-md-offset-3 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
            <h1>{{ trans('form.enter_first_destination') }}</h1>
            {{ Form::open(['url'=>'search_keywords', 'method'=>'get', 'class'=>'submit-ajax-get']) }}
            <div class="input-group">
              {{ Form::text('location', old('location'), ['class'=>'form-control', 'placeholder'=> trans('form.eg_destination')]) }}
              <span class="input-group-btn">
                {{ Form::button(trans('form.btn_search'), ['type'=>'submit', 'class'=>'btn btn-primary form-control']) }}
              </span>
            </div>

            {{ Form::close() }}
        </div>
    </div>
  </div>
</div>

<a name="discover">
<div class="container">
    <div class="section">
      <div class="text-center suggest_heading">
        <h1 style="font-size: 60px;"><i class="fa fa-lightbulb-o"></i></h1>
        <h2>Some Suggestions</h2>
      </div>
      <div class="row">
        <div class="col-md-4 col-xs-6">
          <div class="suggest_region" id="suggest_weu">
            <div class="suggest_region_gradient">
              <div class="suggest_region_inner">
                <div class="pull-left region_name">
                  Western Europe
                  <!-- London . Barcelona . Lisbon . Frankfurt -->
                </div>
                <div class="pull-right"><a href="{{ url('/suggest_location/Western Europe') }}">{{ Form::button(trans('form.btn_discover'), ['class'=>'btn btn-primary btn-small']) }}</a></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-xs-6">
          <div class="suggest_region" id="suggest_nea">
            <div class="suggest_region_gradient">
              <div class="suggest_region_inner">
                <div class="pull-left region_name">
                  North East Asia
                  <!-- Tokyo . Shanghai . Seoul . Hong Kong -->
                </div>
                <div class="pull-right"><a href="{{ url('/suggest_location/North East Asia') }}">{{ Form::button(trans('form.btn_discover'), ['class'=>'btn btn-primary btn-small']) }}</a></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-xs-6">
          <div class="suggest_region" id="suggest_sea">
            <div class="suggest_region_gradient">
              <div class="suggest_region_inner">
                <div class="pull-left region_name">
                  South East Asia
                  <!-- Kuala Lumpur . Bangkok . Singapore -->
                </div>
                <div class="pull-right"><a href="{{ url('/suggest_location/South East Asia') }}">{{ Form::button(trans('form.btn_discover'), ['class'=>'btn btn-primary btn-small']) }}</a></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-xs-6">
          <div class="suggest_region" id="suggest_sca">
            <div class="suggest_region_gradient">
              <div class="suggest_region_inner">
                <div class="pull-left region_name">
                  South &amp; Central Asia
                  <!-- Mumbai . Bangalore . Kathmandu -->
                </div>
                <div class="pull-right"><a href="{{ url('/suggest_location/South & Central Asia') }}">{{ Form::button(trans('form.btn_discover'), ['class'=>'btn btn-primary btn-small']) }}</a></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-xs-6">
          <div class="suggest_region" id="suggest_eeu">
            <div class="suggest_region_gradient">
              <div class="suggest_region_inner">
                <div class="pull-left region_name">
                  Eastern Europe
                  <!-- Moscow . Budapest . Prague . Vienna -->
                </div>
                <div class="pull-right"><a href="{{ url('/suggest_location/Eastern Europe') }}">{{ Form::button(trans('form.btn_discover'), ['class'=>'btn btn-primary btn-small']) }}</a></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-xs-6">
          <div class="suggest_region" id="suggest_africa">
            <div class="suggest_region_gradient">
              <div class="suggest_region_inner">
                <div class="pull-left region_name">
                  Africa
                  <!-- Cape Town . Lagos -->
                </div>
                <div class="pull-right"><a href="{{ url('/suggest_location/Africa') }}">{{ Form::button(trans('form.btn_discover'), ['class'=>'btn btn-primary btn-small']) }}</a></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-xs-6">
          <div class="suggest_region" id="suggest_ocenia">
            <div class="suggest_region_gradient">
              <div class="suggest_region_inner">
                <div class="pull-left region_name">
                  Oceania
                  <!-- Melbourne . Sydney . Adelaide . Auckland -->
                </div>
                <div class="pull-right"><a href="{{ url('/suggest_location/Oceania') }}">{{ Form::button(trans('form.btn_discover'), ['class'=>'btn btn-primary btn-small']) }}</a></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-xs-6">
          <div class="suggest_region" id="suggest_nam">
            <div class="suggest_region_gradient">
              <div class="suggest_region_inner">
                <div class="pull-left region_name">
                  North America
                  <!-- New York . San Francisco . Toronto -->
                </div>
                <div class="pull-right"><a href="{{ url('/suggest_location/North America') }}">{{ Form::button(trans('form.btn_discover'), ['class'=>'btn btn-primary btn-small']) }}</a></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-xs-6">
          <div class="suggest_region" id="suggest_scam">
            <div class="suggest_region_gradient">
              <div class="suggest_region_inner">
                <div class="pull-left region_name">
                  South & Central America
                  <!-- Sao Paulo . Bueno Aires -->
                </div>
                <div class="pull-right"><a href="{{ url('/suggest_location/South & Central America') }}">{{ Form::button(trans('form.btn_discover'), ['class'=>'btn btn-primary btn-small']) }}</a></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-xs-6">
          <div class="suggest_region" id="suggest_mide">
            <div class="suggest_region_gradient">
              <div class="suggest_region_inner">
                <div class="pull-left region_name">
                  Middle East
                  <!-- Sao Paulo . Bueno Aires -->
                </div>
                <div class="pull-right"><a href="{{ url('/suggest_location/Middle East') }}">{{ Form::button(trans('form.btn_discover'), ['class'=>'btn btn-primary btn-small']) }}</a></div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
</div>
@endsection
