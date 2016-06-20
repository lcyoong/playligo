@extends('layouts.teaser')

@section('content')
<div class="container homepage-main">
<div class="row">
  <div class="col-md-7">
    <img src="{{ asset('img/logo_rgb_white_lg.png') }}">
    <h1>Your travel experience begins now!</h1>
    <h2>Visualize your travel itinerary in minutes with Playligo's inspirational video playlist tool!</h2>
    {{ Form::open(['method'=>'post', 'url'=>url('enter_prelaunch'), 'class'=>'form-homepage submit-ajax']) }}
    <div class="row">
      <div class="col-md-7">
        <h4>Welcome to Playligo's Pre-Launch! Enter your invitation code for early access to the site now!</h4>
      </div>
      <div class="col-md-7">
        <div class="form-group">
        {{ Form::text('inv_code', '', ['class'=>'form-control input-lg', 'placeholder'=>'Invite Code']) }}
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-7">
        <div class="form-group">
        {{ Form::button('Enter invite code', ['type'=>'submit', 'class'=>'btn btn-primary button-homepage btn-lg']) }}
        </div>
      </div>
    </div>
    {{ Form::close() }}
  </div>
  <div class="col-md-5">
    <div id="explainer_video_section" class="text-center">
      <!-- <a href="{{ url('home/video_popup') }}" class="btn-modal"><img src="{{ asset('img/playvideo.jpg') }}"></a> -->
      <a href="{{ url('explainer_popup') }}" class="btn-modal"><div id="explainer_standin"></div></a>
      <img class="img-responsive" src="{{ asset('img/phone-mockup-2.png') }}"/>
    </div>
    <!-- <div id="explainer_video_section" class="text-center">
      <iframe id="explainer_video" width="373" height="240" src="https://www.youtube.com/embed/NDbsSGZB0hQ" frameborder="0" allowfullscreen></iframe>
      <img src="{{ asset('img/phone-mockup.png') }}" style="visibility: hidden;" />
    </div> -->
    <!-- <img src="{{ asset('img/phone-mockup.png') }}" class="img-responsive img-center"> -->
  </div>
</div>
</div>
<div class="modal fade" id="messageModal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		</div>
	</div>
</div>
@endsection

@section('script')
<script>
$( window ).resize(function() {
  offsetVideo();
});

@if(!empty($play))
$('#basicModal').find('.modal-content').html('');
$('#basicModal').modal('show');
$('#basicModal').find('.modal-content').load('{{ url('explainer_popup') }}');
@endif

$(document).ready(function() {

  offsetVideo();
	// $('body').on('submit', '.form-homepage', function (event) {
	// 		event.preventDefault();
	// 		$.ajax({
	// 				url: $(this).attr('action'),
	// 				type: 'POST',
	// 				dataType: 'json',
	// 				data: $(this).serialize(),
	// 				success: function (data) {
  //           console.log(data);
  //           errorsHtml = '<div class="pop_message"><ul>';
  //           errorsHtml += '<li>'+data.message+'</li>';
  //           errorsHtml += '</ul></div>';
  //           $('#messageModal').modal('hide');
  //           $('#messageModal').find('.modal-content').html(errorsHtml);
  //           $('#messageModal').modal('show');
  //           setTimeout(function () {
  //             $('#messageModal').modal('hide');
  //             location.reload();
  //           }, 2000);
	// 				},
  //         error: function(data) {
  //           var errors = data.responseJSON;
  //           errorsHtml = '<div class="pop_message"><ul>';
  //           $.each( errors, function( key, value ) {
  //             errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
  //           });
  //           errorsHtml += '</ul></div>';
  //           $('#messageModal').modal('hide');
  //           $('#messageModal').find('.modal-content').html(errorsHtml);
  //           $('#messageModal').modal('show');
  //           setTimeout(function () {
  //             $('#messageModal').modal('hide');
  //           }, 2000);
  //         }
	// 		});
  //
	// 		return false;
	// });
});

function offsetVideo()
{
  // alert($("#explainer_video_section").width());
  var leftpos = (($("#explainer_video_section").width() - 425) / 2) + 40;
  if (leftpos <= 40) {
    leftpos = 40;
  }
  $("#explainer_standin").css({left: leftpos});
}
</script>
@endsection
