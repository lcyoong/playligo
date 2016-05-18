@extends('layouts.app')

@section('content')
<div class="container">
  <div class="section" id="canvasSection">
    <div id="myCanvasContainer">
     <canvas width="" height="500" id="myCanvas">
      <p>Anything in here will be replaced on browsers that support the canvas element</p>
     </canvas>
    </div>
    <div id="tags">
      <ul>
        <?php $divider = $cities[count($cities)-1]->cit_hotels; ?>
        @foreach($cities as $city)
        <?php $size = ($city->cit_hotels/$divider) <= 6 ? $city->cit_hotels/$divider : 6 ?>
        <li>
          <a data-weight="{{ $size*10 }}" href="{{ url('/search_keywords?location=' . $city->cit_name . ", " . $city->coun_name) }}">{{ $city->cit_name }}, {{ $city->coun_name }}</a>
        </li>
        @endforeach
        <!-- <li><a href="http://www.google.com" target="_blank">Google</a></li>
        <li><a href="/fish">Fish</a></li>
        <li><a href="/chips">Chips</a></li>
        <li><a href="/salt">Salt</a></li>
        <li><a href="/vinegar">Vinegar</a></li> -->
      </ul>
    </div>
    <!-- <div class="row">
        <div class="col-md-10 col-md-offset-1">
          @foreach($cities as $city)
          <div>
            <a href="{{ url('/search_keywords?location=' . $city->cit_name . ", " . $city->coun_name) }}">{{ $city->cit_name }}, {{ $city->coun_name }} ({{ $city->cit_hotels }})</a>
          </div>
          @endforeach
        </div>
    </div> -->
  </div>

</div>

@endsection

@section('script')
<script src="{{ asset('js/jquery.tagcanvas.min.js') }}"></script>

<script type="text/javascript">
$(document).ready(function() {
  $("#myCanvas").attr("width", $("#canvasSection").width());
    if(!$('#myCanvas').tagcanvas({
      textColour: '#333333',
      outlineColour: '#cccccc',
      reverse: true,
      depth: 0.1,
      maxSpeed: 0.05,
      clickToFront: 100,
      freezeDecel: true,
      weight: true,
      // weightMode: "colour",
      weightMode: "size",
      weightFrom: "data-weight",
      weightSize: 1,
      pinchZoom: true,
      shape: "sphere",
      shuffleTags: true,
    },'tags')) {
      // something went wrong, hide the canvas container
      $('#myCanvasContainer').hide();
    }
  });
</script>
@endsection
