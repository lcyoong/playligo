@extends('layouts.app')

@section('content')
<div class="container">
  <div class="section">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
          @foreach($continents as $continent)
          <div>
            <a href="{{ url('/suggest_location/' . $continent->coun_continent) }}">{{ $continent->coun_continent }} {{ $continent->city_count }}</a>
          </div>
          @endforeach
        </div>
    </div>
  </div>
</div>

@endsection
