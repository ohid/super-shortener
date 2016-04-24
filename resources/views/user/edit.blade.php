@extends('layouts.app')
	
@section('jumbo')
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h3>Profile settings</h3>
			</div>
		</div>
	</div>
@endsection

@section('content')
	
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				@if(Session::has('message'))
					<div class="alert alert-success alert-dismissible" role="alert">
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					  {{ Session::get('message') }}
					</div>
				@endif
				<div class="panel panel-default user_form">
					<div class="panel-heading">
						Edit
					</div>

					<div class="panel-body">
						{!! Form::model($user, [
							'route' => ['user.update', Auth::user()->id],
							'method' => 'PUT'
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

						{!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
				
						{!! Form::close() !!}
					</div>
				</div>
			</div>
		</div>
	</div>

@endsection