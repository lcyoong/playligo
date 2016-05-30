@extends('layouts.email')
@section('email_content')
  <p>Dear {{ $owner->name }},</p>
  <p>The time has come. A choice has been made!</p>
  <p>See the results of your Playligo poll here:<br/> <a href="{{ url('public_poll/' . $poll->pol_id) }}">{{ url('public_poll/' . $poll->pol_id) }}</a></p>
  <img src="{{ asset('img/cute-happy-earth-animation.gif') }}">
  @include('email.footer')
@endsection
