@extends('layouts.app')

@section('title', 'Super Shortener - URL Shortener')

@section('jumbo')
<h3>Super Shortenar - <small>PHP URL shortener</small></h3>
@stop

@section('content')

<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				{!! Form::open(['route' => 'store', 'method' => 'post', 'class' => 'shorten_form']) !!}
					<div class="form-group">
						<label for="url">Paste your long url to get shorten</label>
						<input id="url" type="url" name="url" id="url" class="form-control" required>
						<button type="submit" class="btn btn-success shortbtn">Shorten</button>
					</div>

					<div class="form-group">
						<!-- Advanced search -->
					</div>
				{!! Form::close() !!}
			</div>
		</div>
		<div class="row">
			<div class="col-md-8 col-md-offset-2">

				<div class="shorten_url_wrapper">
					<div class="url_status"></div>

					<div class="shorten_url_info_wrap">
						<div class="row url_info">
							<div class="col-md-12 url_go_detail">
							  	<input type="text" class="form-control shorted_url" id="copyTarget">
							  	<button class="url_copy_btn" id="copyButton">Click to copy</button>
							</div>
						</div>
						<div class="row urlImgWrap">
							<div class="col-md-3 padding_l_less">
								<div class="more_short_url_info">
									<span class="time"></span> <br>
									<span> <a class="shorted_url_stats" href="">Show statistics</a></span>
									<br>
									<div class="share">
										<h5>Share this</h5>
										<ul class="list-inline">
											<li><a class="shr_fb" href="" target="_blank"><i class="fa fa-facebook"></i></a></li>
											<li><a class="shr_tw" href="" target="_blank"><i class="fa fa-twitter"></i></a></li>
											<li><a class="shr_gp" href="" target="_blank"><i class="fa fa-google-plus"></i></a></li>
											<li><a class="shr_lnk" href="" target="_blank"><i class="fa fa-linkedin"></i></a></li>
											<li><a class="shr_pin" href="" target="_blank"><i class="fa fa-pinterest"></i></a></li>
										</ul>
									</div>
									
								
								</div>
							</div>
							<div class="col-md-9 padding_r_less">
								<div class="urlScreenshot"></div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
	<div class="test"></div>
	<div class="container all_links_table">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				
				@if(Auth::check())
					<div class="panel panel-default">
						<div class="panel-heading">
							<span class="panel-title">Recent Shorten URL's</span>
						</div>
						<div class="panel-body">
							<table class="table" id="table">
								<thead>
									<tr>
										<th style="width:30%;padding-left:20px;">Long Url</th>
										<th style="width:15%">Short Url</th>
										<th style="width:15%" class="mb-hidden">Added</th>
										<th style="width:10%">Stats</th>
										<th style="width:10%">Hits</th>
										<th style="width:10%" class="mb-hidden">Action</th>
									</tr>
								</thead>

								<tbody id="tbody">
									@if($urls->count())
										@foreach($urls as $url)
											<tr id="short_url_{{ $url->short_url }}">
												<td><a href="{{ $url->url }}">{{ str_limit($url->url, 25) }}</a></td>
												@foreach($url->options() as $option)
													<td>option-- {{$option->referer}} </td>
												@endforeach
												<td><a href="/{{ $url->short_url }}">{{ $url->short_url }}</a></td>
												<td class="mb-hidden">{{ $url->created_at->diffForHumans() }}</td>
												<td><a href="/statistics/{{ $url->short_url }}">Stats</a></td>
												<td>{{ $url->clicks }}</td>
												<td class="mb-hidden">
													{!! Form::open(['route' => ['destroyUrl', $url->id], 'method' => 'post', 'class' => 'url_delete']) !!}
														<button type="button" value="{{$url->short_url}}" class="remove_link"><i class="fa fa-times" title="remove"></i></button>
													{!! Form::close() !!}
												</td>
											</tr>
										@endforeach
									@else
										<tr id="no_url">
											<td style="padding-left:20px;">No url</td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
									@endif

								</tbody>
							</table>	

							<span class="pull-left number-of-pages">							
							<small>Total <b class="total_links">{{ Auth::user()->urls()->count() }}</b> links</small>
							</span>
							<div class="paginations pull-right">
								{!! $urls->render() !!}
							</div>
						</div>
					</div>
				@else
					<p class="please_login">Please <a href="{{url('auth/login/')}}">login</a> to track all your links.</p>
				@endif
					
			</div>
		</div>

	</div>
	</div>
	</div>

@stop

@include('shortener.shorten_script')
