<div class="row">
		<div class="col-md-3 col-sm-3 pl0">
			<div class="card">
				<h5>Short url</h5>
				<div class="lighten-card card-short-url">
					<a href="{{ url('/') . '/' . $url->short_url }}" target="_blank">{{ url('/') . '/' . $url->short_url }}</a>
				</div>
			</div>
		</div>
		<div class="col-md-5 col-sm-5">
			<div class="card">
				<h5>Actual url</h5>
				<div class="lighten-card">
					<a href="{{ $url->url }}" target="_blank">{{ $url->url }}</a>
				</div>
			</div>
		</div>
		<div class="col-md-2 col-sm-2">
			<div class="card">
				<h5>Date created</h5>
				<div class="lighten-card">{{$url->created_at}}</div>
			</div>
		</div>
		<div class="col-md-2 col-sm-2">
			<div class="card">
				<h5>QR code</h5>
				<div class="lighten-card qr-code">
					{!! QrCode::size(100)->generate(url('/') . '/' . $url->short_url); !!}
				</div>
			</div>
		</div>
	</div>
