
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>@yield('title')</title>

	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="{{ URL::asset('assets/css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('assets/css/font-awesome.min.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('assets/css/style.css') }}">
	<link rel="stylesheet" href="{{ URL::asset('assets/css/responsive.css') }}">
	@yield('header_script')

</head>
<body>
<nav class="navbar navbar-default">
  <div class="container">
	  <div class="row">
		<div class="col-md-8 col-md-offset-2">
	    <!-- Brand and toggle get grouped for better mobile display -->
	    <div class="navbar-header">
	      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	        <span class="sr-only">Toggle navigation</span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	        <span class="icon-bar"></span>
	      </button>
	      <a class="navbar-brand" href="{{ route('index') }}">Short.ner</a>
	    </div>

	    <!-- Collect the nav links, forms, and other content for toggling -->
	    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	      <ul class="nav navbar-nav navbar-right">
	      	@if(Auth::check())
				<li class="dropdown">
		          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
						{{ Auth::user()->username }}
		          <span class="caret"></span></a>
		          <ul class="dropdown-menu">
		            <li><a href="{{ route('user.edit', Auth::user()->id) }}">Profile Setting</a></li>
					<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
		          </ul>
		        </li>
	      	@else
				<li><a href="{{ url('/auth/login') }}">Login</a></li>
				<li><a href="{{ url('/auth/register') }}">Signup</a></li>
	      	@endif
	      </ul>
	    </div><!-- /.navbar-collapse -->
	    </div>
	  </div>
  </div><!-- /.container-fluid -->
</nav>
 

	<div class="jumbotron">		
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					@yield('jumbo')
				</div>
			</div>
		</div>
	</div>

	@yield('content')

	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="well text-center copyright">
					<p>copyright &copy; <a href="http://ohidul.com">Ohidul Islam</a> 2016</p>
				</div>
			</div>
		</div>
	</div>

	<script src="{{ URL::asset('assets/js/jquery-1.11.3.min.js') }}"></script>
	<script src="{{ URL::asset('assets/js/bootstrap.min.js') }}"></script>
	<script src="{{ URL::asset('assets/js/script.js') }}"></script>
	@yield('footer_script')

</body>
</html>