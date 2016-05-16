@extends('layouts.email')
@section('email_content')
  <p>Dear {{ $subscriber->sub_name }},</p>
  <p>Congratulations!</p>
  <p>You’ve taken the first step to make travel research painless. With Playligo, you decide where to go by watching travel video playlists. It’s easy as ABC!</p>
  <p>Hang in there and we’ll let you know as soon as we go live..</p>
  <p>See you soon!</p>
  @include('email.footer')
@endsection
