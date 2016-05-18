@extends('layouts.app')

@section('content')
<div class="main-search text-center section">
  <div class="main-search-inner">
      <div class="row">
        <div class="col-md-6 col-md-offset-3">
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

<div class="container">
  <a name="suggest">
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
                <div class="pull-left">
                  <h3>Western Europe</h3>
                  <!-- London . Barcelona . Lisbon . Frankfurt -->
                </div>
                <div class="pull-right"><a href="{{ url('/suggest_location/Western Europe') }}">{{ Form::button('Show Me', ['class'=>'btn btn-primary']) }}</a></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-xs-6">
          <div class="suggest_region" id="suggest_nea">
            <div class="suggest_region_gradient">
              <div class="suggest_region_inner">
                <div class="pull-left">
                  <h3>North East Asia</h3>
                  <!-- Tokyo . Shanghai . Seoul . Hong Kong -->
                </div>
                <div class="pull-right"><a href="{{ url('/suggest_location/North East Asia') }}">{{ Form::button('Show Me', ['class'=>'btn btn-primary']) }}</a></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-xs-6">
          <div class="suggest_region" id="suggest_sea">
            <div class="suggest_region_gradient">
              <div class="suggest_region_inner">
                <div class="">
                  <h3>South East Asia</h3>
                  <!-- Kuala Lumpur . Bangkok . Singapore -->
                </div>
                <div><a href="{{ url('/suggest_location/South East Asia') }}">{{ Form::button('Show Me', ['class'=>'btn btn-primary']) }}</a></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4 col-xs-6">
          <div class="suggest_region" id="suggest_sca">
            <div class="suggest_region_gradient">
              <div class="suggest_region_inner">
                <div class="">
                  <h3>South &amp; Central Asia</h3>
                  <!-- Mumbai . Bangalore . Kathmandu -->
                </div>
                <div><a href="{{ url('/suggest_location/South & Central Asia') }}">{{ Form::button('Show Me', ['class'=>'btn btn-primary']) }}</a></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-xs-6">
          <div class="suggest_region" id="suggest_eeu">
            <div class="suggest_region_gradient">
              <div class="suggest_region_inner">
                <div class="">
                  <h3>Eastern Europe</h3>
                  <!-- Moscow . Budapest . Prague . Vienna -->
                </div>
                <div><a href="{{ url('/suggest_location/Eastern Europe') }}">{{ Form::button('Show Me', ['class'=>'btn btn-primary']) }}</a></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-xs-6">
          <div class="suggest_region" id="suggest_africa">
            <div class="suggest_region_gradient">
              <div class="suggest_region_inner">
                <div class="">
                  <h3>Africa</h3>
                  <!-- Cape Town . Lagos -->
                </div>
                <div><a href="{{ url('/suggest_location/Africa') }}">{{ Form::button('Show Me', ['class'=>'btn btn-primary']) }}</a></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4 col-xs-6">
          <div class="suggest_region" id="suggest_ocenia">
            <div class="suggest_region_gradient">
              <div class="suggest_region_inner">
                <div class="">
                  <h3>Oceania</h3>
                  <!-- Melbourne . Sydney . Adelaide . Auckland -->
                </div>
                <div><a href="{{ url('/suggest_location/Oceania') }}">{{ Form::button('Show Me', ['class'=>'btn btn-primary']) }}</a></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-xs-6">
          <div class="suggest_region" id="suggest_nam">
            <div class="suggest_region_gradient">
              <div class="suggest_region_inner">
                <div class="">
                  <h3>North America</h3>
                  <!-- New York . San Francisco . Toronto -->
                </div>
                <div><a href="{{ url('/suggest_location/North America') }}">{{ Form::button('Show Me', ['class'=>'btn btn-primary']) }}</a></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4 col-xs-6">
          <div class="suggest_region" id="suggest_scam">
            <div class="suggest_region_gradient">
              <div class="suggest_region_inner">
                <div class="">
                  <h3>South & Central America</h3>
                  <!-- Sao Paulo . Bueno Aires -->
                </div>
                <div><a href="{{ url('/suggest_location/South & Central America') }}">{{ Form::button('Show Me', ['class'=>'btn btn-primary']) }}</a></div>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
  </a>
</div>
@endsection
