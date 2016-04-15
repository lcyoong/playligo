@if (session('status'))
	<div class="alert alert-success">
		{{ session('status') }}
	</div>
@endif

@if(isset($errors) && $errors->has())
<div class="alert alert-danger">
    @foreach ($errors->all() as $error)
        {{ $error }}<br>
    @endforeach
</div>
@endif
