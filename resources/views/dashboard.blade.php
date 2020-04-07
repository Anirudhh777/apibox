@extends('app')
@section('front-page')

<div class="container">
	<p>API Token: <span> {{ Auth::user()->api_token }} </span> </p>
</div>


@endsection