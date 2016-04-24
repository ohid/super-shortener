@extends('layouts.app')

@section('jumbo')
<h3>Reset your password</h3>
@stop

@section('content')


<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">

			<div class="panel panel-default user_form">
			  <div class="panel-heading">Reset password</div>
			  <div class="panel-body">

				{!! Form::open() !!}
					{!! Form::hidden('token', $token) !!}

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

					{!! Form::submit('Reset password', ['class' => 'btn-success btn  btn-lg']) !!}

				{!! Form::close() !!}

			  </div>
			</div>

		</div>
	</div>
</div>



@endsection