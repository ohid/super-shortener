@extends('layouts.app')

@section('title', 'Login | Super Shortener - URL Shortener')

@section('jumbo')
<h3>Super Shortenar - <small>PHP URL shortenar</small></h3>
@stop

@section('content')


<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<div class="panel panel-default user_form">
			  <div class="panel-heading">Login</div>
			  <div class="panel-body">

				{!! Form::open(['url' => 'auth/login', 'method' => 'post', 'id' => 'login']) !!}

					<div class="form-group form-email {{ $errors->has('email') ? 'has-error' : '' }}">
						{!! Form::label('email', 'Email', ['class' => 'btn-label']) !!}
						{!! Form::email('email', null, ['class' => 'form-control']) !!}
						<span class="help-block">							
							{{ $errors->first('email')  }}
						</span>
					</div>

					<div class="form-group form-password {{ $errors->has('password') ? 'has-error' : '' }}">
						{!! Form::label('password', 'Password', ['class' => 'btn-label']) !!}
						{!! Form::password('password', ['class' => 'form-control']) !!}
						<span class="help-block">
							{{ $errors->first('password')  }}
						</span>
					</div>

					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<label>
									<input type="checkbox" name="remember"> Remember me
								</label>
							</div>
							<div class="col-md-6 loginms">
								<a href="{{route('auth.password.email')}}">Forget password?</a>
							</div>
						</div>
					</div>


					{!! Form::submit('Login', ['class' => 'btn-success btn  btn-lg']) !!}

				{!! Form::close() !!}

			  </div>
			</div>

		</div>
	</div>
</div>



@endsection