@extends('layouts.admin')

@section('content_admin')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
          {{ $users }}
        </div>
    </div>
</div>
@endsection
