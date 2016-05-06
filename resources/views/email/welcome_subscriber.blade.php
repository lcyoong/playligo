@extends('layouts.email')
@section('email_content')
  <h2>{{ trans('email.new_subscriber_title') }}</h2>
  <p>Dear {{ $subscriber->sub_name }},<p>
  <p>Thanks for subscribing<p>
  @include('email.footer')
@endsection
