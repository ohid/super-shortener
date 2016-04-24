@extends('layouts.app')

@section('title', 'Signup | Super Shortener - URL Shortener')

@section('jumbo')
<h3>Super Shortenar - <small>PHP URL shortenar</small></h3>
@stop

@section('content')

<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<div class="panel panel-default user_form">
			  <div class="panel-heading">Sign Up</div>
			  <div class="panel-body">

				{!! Form::open([
					'url' => 'auth/register',
					'method' => 'post',
					'id' => 'signup'
				]) !!}

					<div class="form-group form-username {{ $errors->has('username') ? 'has-error' : '' }}">
						{!! Form::label('username', 'Username', ['class' => 'btn-label']) !!}
						{!! Form::text('username', null, ['class' => 'form-control']) !!}
						<span class="help-block">							
							{{ $errors->first('username')  }}
						</span>
					</div>

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

					<div class="form-group form-password {{ $errors->has('password') ? 'has-error' : '' }}">
						{!! Form::label('password_confirmation', 'Confirm', ['class' => 'btn-label']) !!}
						{!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
						<span class="help-block">
							{{ $errors->first('password')  }}
						</span>
					</div>


					<div class="form-group">
						<div class="row">
							<div class="col-md-12 loginms">
								<a href="{{ url('/auth/login') }}">Already a user? Login now</a>
							</div>
						</div>
					</div>
					
					{!! Form::submit('Sign Up', ['class' => 'btn-success btn  btn-lg']) !!}

				{!! Form::close() !!}



			  </div>
			</div>

		</div>
	</div>
</div>


@endsection