@extends('layouts.app')

@section('jumbo')
	<h4>Forget your password?</h4>
@endsection

@section('content')
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 user_form">
					<div class="panel panel-default user_form">
					  <div class="panel-heading">Forget Password?</div>
						  <div class="panel-body">
								{!! Form::open() !!}

									<div class="form-group form-email {{ $errors->has('email') ? 'has-error' : '' }}">
										{!! Form::label('email', 'Email', ['class' => 'btn-label']) !!}
										{!! Form::email('email', null, ['class' => 'form-control']) !!}
										<span class="help-block">							
											{{ $errors->first('email')  }}
										</span>
									</div>

									{!! Form::submit('Send email', ['class' => 'btn-success btn  btn-lg']) !!}

								{!! Form::close() !!}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
@endsection