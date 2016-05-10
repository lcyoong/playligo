@extends('layouts.app')

@section('content')
<div class="container">
  <div class="section">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
          @foreach($cities as $city)
          <div>
            <a href="{{ url('/search_keywords?location=' . $city->cit_name . ", " . $city->coun_name) }}">{{ $city->cit_name }}, {{ $city->coun_name }} ({{ $city->cit_hotels }})</a>
          </div>
          @endforeach
        </div>
    </div>
  </div>
</div>

@endsection
