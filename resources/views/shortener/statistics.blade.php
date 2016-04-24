@extends('layouts.app')

@section('title', 'Statistics | Super Shortener - URL Shortener')

@section('header_script')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi?autoload={'modules':[{'name':'visualization','version':'1.1','packages':['corechart', 'timeline']}]}"></script>
@stop

@section('jumbo')
	@include('shortener.stats_jumbo')
@stop

@section('content')

{{-- Get browser data from Option model --}}
@if($url_browser)
<?php $browser = $url_browser; ?>
<?php $os = $url_os; ?>
@endif


<div class="container ">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default statistics_panel">
			  <div class="panel-body">
				
				<!-- Show URL HITS -->
			  	<div class="row hits-row">
		  			@if(count($url_hits))
				  	   	<div class="col-md-12">
				  	   		<div class="unique-hits">
				  	   			<h4> {{ $option_count }} <br> <span>unique hits</span></h4>
				  	   		</div>
				  	   		<div class="total-hits">
				  	   			<h4> {{ $url->clicks }} <br> <span>total hits</span></h4>
				  	   		</div>
					   	    <div id="chart_div"></div>
					   	</div>
				   	@else
					   	<div class="col-md-12">	
					   	    <div class="no-graph">Sorry, not enought data to show hits graphs</div>
					   	</div>
				   	@endif
			  		
			  	</div>
				
				<!-- Show browser data -->
			  	<div class="row row-main">
				  	<div class="graphs-row browsers-row">
						<h5>Top Browsers</h5>
						
							@if(count($refererList))
				  			<div class="col-md-8 graph-row-left">
					  	   		<div id="browsers"  class="charts"></div>						
							</div>
							<div class="col-md-4 graph-row-right">
								<div class="graphs-right">
									<ul>
										@foreach($browser as $browserName => $browserCount)
											<?php 
												if($browserCount > 0) {
													echo "<li> $browserName - <strong> $browserCount </strong> <small>clicks</small></li>";		
												}
											?>
										@endforeach
									</ul>
								</div>
							</div>
						@else 
						   	<div class="col-md-12">	
						   	    <div class="no-graph">Sorry, not enought data to show browser graphs</div>
						   	</div>
						@endif
				  	</div>
			  	</div>

				<!-- Show referrel websites -->
			  	<div class="row row-main">
				  	<div class="graphs-row referrals-row">
						<h5>Top Referrel Websites</h5>
						@if(count($refererList))
							<div class="col-md-8 graph-row-left">
					  	   		<div id="referrals"  class="charts"></div>						
							</div>
							<div class="col-md-4 graph-row-right">
								<div class="graphs-right">
									<ul>
							          	@foreach($refererList as $referralList)
							          		<li> {{ $referralList->referer }} - <small>{{$referralList->refererCount}}</small></li>
							          	@endforeach
									</ul>
								</div>
							</div>
						@else
							<div class="no-graph">Sorry, not enought data to show referrals graphs</div>
						@endif
			  			
				  	</div>
			  	</div>


				<!-- Show Operating system data -->
			  	<div class="row row-main">
				  	<div class="graphs-row browsers-row">
						<h5>Top Operating Systems</h5>
							@if(count($refererList))
				  			<div class="col-md-8 graph-row-left">
					  	   		<div id="os"  class="charts"></div>						
							</div>
							<div class="col-md-4 graph-row-right">
								<div class="graphs-right">
									<ul>
										@foreach($os as $osName => $osCount)
											<?php 
												if($osCount > 0) {
													echo "<li> ". 
													str_replace('_', ' ', $osName) .
													" - <strong> $osCount </strong> <small>clicks</small></li>";		
												}
											?>
										@endforeach					
									<ul>
								</div>
							</div>
							@else 
							<div class="no-graph">Sorry, not enought data to show operating system graphs</div>
							@endif
				  		</div>
			  	</div>


				<!-- Show browser data -->
			  	<div class="row row-main">
				  	<div class="graphs-row browsers-row">
						<h5>Top Countries</h5>
						@if(count($url_country))
							<div class="col-md-8 graph-row-left">
					  	   		<div id="regions_div"  class="charts"></div>						
							</div>
							<div class="col-md-4 graph-row-right">
								<div class="graphs-right">
									<ul>
										@foreach($url_country as $country)
							          		<li> {{ $country->country_code }} - <small>{{$country->countryCount}}</small></li>
							          	@endforeach		
									</ul>
								</div>
							</div>
						@else
							<div class="no-graph">Sorry, not enought data to show country graphs</div>
						@endif				  			
				  	</div>
			  	</div>

				<div class="row browsers">

					<!-- Google chart api script for Sshortener Statistics -->
					@include('shortener.chart_api')
				    			   
				</div>


				<a href="http://url.ohidul.com" class="back_home"><i class='fa fa-angle-double-left'></i> Back to home</a>		
				
			  </div>
			</div>
		</div>
	</div>
</div>

@endsection