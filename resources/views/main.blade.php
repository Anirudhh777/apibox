@extends('app')
@section('front-page')
	<div class="admin">
		<div class="wrapper fadeInDown">
		  <div id="formContent">
		  	@if(Route::currentRouteName() === 'main')
		  		<form role="form" method="POST" action="{{ url('/login') }}">
			    	 @csrf
			      <input type="email" class="fadeIn second" name="email" placeholder="login" required="">
			      <input type="password" class="fadeIn third" name="password" placeholder="password" required="">
			      <input type="submit" class="fadeIn fourth" value="Log In">
			    </form>
			    @if(!empty(Session::get('error_code')) && Session::get('error_code') == 2)
						<p class="login-error">Credentials do not match, please try again.</p>
				@endif
			@elseif(Route::currentRouteName() === 'register')
				<form role="form" method="POST" action="{{ url('/register') }}">
			    	@csrf
			    	<input type="text" class="fadeIn second" name="name" placeholder="name" required="">
			     	<input type="email" class="fadeIn second" name="email" placeholder="email" required="">
			      	<input type="password" class="fadeIn third" name="password" placeholder="password" required="">
			      	<input type="submit" class="fadeIn fourth" value="Register">
			    </form>
			     @if(!empty(Session::get('error_code')) && Session::get('error_code') == 2)
						<p class="login-error">Email ID already Registered</p>
				@endif
			 @endif
			</div>
		</div>
	</div>
@endsection