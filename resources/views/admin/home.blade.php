@extends('layouts.dashboard')

@section('content')
    <div class="contaier">
        <h2>Bentornato {{ucfirst($user->name)}}</h2>
        <h3>Email: {{$user->email}}</h3>
    </div>
@endsection