@extends('layouts.modal')
@section('content')
<h1>{{ $user->name }}</h1>
<h4>{{ $user->email }}</h4>
<h2>{{ $stat['playlist_count'] }} playlists | {{ $stat['poll_count'] }} polls</h2>
@endsection
