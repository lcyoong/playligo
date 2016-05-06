@extends('layouts.teaser')

@section('content')
<div class="container homepage-main">
<div class="row">
  <div class="col-md-7">
    <img src="{{ asset('img/logo-main.png') }}">
    <h1>Revolutionize the way you travel! Watch short curated destination video playlists before you go.</h1>
    <h2>Be inspired. Decide with confidence.</h2>
    <h4>Be among the first to enjoy this amazing travel tool!</h4>
    {{ Form::open(['method'=>'post', 'url'=>url('subscribe'), 'class'=>'form-homepage']) }}
    <div class="row">
      <div class="col-md-7">
        <div class="form-group">
        {{ Form::text('sub_name', '', ['class'=>'form-control input-lg', 'placeholder'=>'Your Name']) }}
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-7">
        <div class="form-group">
        {{ Form::email('sub_email', '', ['class'=>'form-control input-lg', 'placeholder'=>'Your Email']) }}
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-7">
        <div class="form-group">
        {{ Form::button('Count me in!', ['type'=>'submit', 'class'=>'btn btn-primary button-homepage btn-lg']) }}
        </div>
      </div>
    </div>
    {{ Form::close() }}
  </div>
  <div class="col-md-5">
    <img src="{{ asset('img/phone-mockup.png') }}" class="img-responsive img-center">
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
$(document).ready(function() {

	$('body').on('submit', '.form-homepage', function (event) {
			event.preventDefault();
			$.ajax({
					url: $(this).attr('action'),
					type: 'POST',
					dataType: 'json',
					data: $(this).serialize(),
					success: function (data) {
            console.log(data);
            errorsHtml = '<div class="pop_message"><ul>';
            errorsHtml += '<li>'+data.message+'</li>';
            errorsHtml += '</ul></div>';
            $('#messageModal').modal('hide');
            $('#messageModal').find('.modal-content').html(errorsHtml);
            $('#messageModal').modal('show');
            setTimeout(function () {
              $('#messageModal').modal('hide');
              location.reload();
            }, 2000);
					},
          error: function(data) {
            var errors = data.responseJSON;
            errorsHtml = '<div class="pop_message"><ul>';
            $.each( errors, function( key, value ) {
              errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
            });
            errorsHtml += '</ul></div>';
            $('#messageModal').modal('hide');
            $('#messageModal').find('.modal-content').html(errorsHtml);
            $('#messageModal').modal('show');
            setTimeout(function () {
              $('#messageModal').modal('hide');
            }, 2000);
          }
			});

			return false;
	});
});
</script>
@endsection
