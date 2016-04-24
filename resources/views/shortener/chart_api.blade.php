<script type="text/javascript">
				      google.charts.load('current', {
				      	'packages':['corechart', 'geochart', 'line']	
				      });
				      google.charts.setOnLoadCallback(drawChart);

				      function drawChart() {

				      	// Loop through over URL Browsers
				        var data = google.visualization.arrayToDataTable([
				          ['Task', 'Browsers'],
				          @if($url_browser)
					          ['Chrome',   			{{ $browser['chrome'] }}  ],
					          ['Firefox',   		{{ $browser['firefox'] }}  ],
					          ['Internet Explorer', {{ $browser['msie'] }}  ],
					          ['Edge', 				{{ $browser['edge'] }}  ],
					          ['Safari',  			{{ $browser['safari'] }}  ],
					          ['Opera',  			{{ $browser['opera'] }}  ],
					          ['Netscape',			{{ $browser['netscape'] }}  ],
					          ['Maxthon',			{{ $browser['maxthon'] }}  ],
					          ['Konqueror',			{{ $browser['konqueror'] }}  ],
					          ['Mobile',			{{ $browser['mobile'] }}  ],
					          ['Unknown',  			{{ $browser['unknown'] }}  ]
				          @endif
				        ]);

				        // Loop through over URL Referal websites
				        var data2 = google.visualization.arrayToDataTable([
				          ['Task', 'Referral'],
				          
				          @if($refererList)
				          	@foreach($refererList as $referralList)
				          		['{{ $referralList->referer }}', {{$referralList->refererCount}}],
				          	@endforeach
				          @endif						  
						
				        ]);


				        //  Loop through over URL Browsers
				        var data3 = google.visualization.arrayToDataTable([
				          ['Task', 'Browsers'],
				          @if($url_os)
				          ['Windows 10',   			{{ $os['windows_10'] }} ],
				          ['Windows 8.1',   		{{ $os['windows_81'] }} ],
				          ['Windows 8',   			{{ $os['windows_8'] }}  ],
				          ['Windows 7',   			{{ $os['windows_7'] }}   ],
				          ['Windows Vista',   		{{ $os['windows_vista'] }}  ],
				          ['Windows Server 2003',   {{ $os['windows_server_2003'] }}  ],
				          ['Windows XP',   			{{ $os['windows_xp'] }} ],
				          ['Windows 2000',   		{{ $os['windows_2000'] }}  ],
				          ['Windows ME',   			{{ $os['windows_me'] }}  ],
				          ['Windows 98',   			{{ $os['windows_98'] }}  ],
				          ['Windows 95',  			{{ $os['windows_95'] }}  ],
				          ['Windows 3',   			{{ $os['windows_3'] }}  ],
				          ['Mac OS X',   			{{ $os['mac_os_x'] }}  ],
				          ['Mac OS 9',   			{{ $os['mac_os_9'] }}  ],
				          ['Linux',   				{{ $os['linux'] }}   ],
				          ['Ubuntu',   				{{ $os['ubuntu'] }}  ],
				          ['iPhone',   				{{ $os['iPhone'] }}  ],
				          ['iPod',   				{{ $os['iPod'] }}  ],
				          ['iPad',   				{{ $os['iPad'] }}  ],
				          ['Android',   			{{ $os['android'] }}   ],
				          ['BlackBerry',   			{{ $os['blackberry'] }}  ],
				          ['Mobile',   				{{ $os['mobile'] }}  ],
				          ['Unknown',   			{{ $os['unknown'] }}  ]
				          @endif
				        ]);

				        // Loop through over URL Country
						var data4 = google.visualization.arrayToDataTable([
					          ['Country', 'Clicks'],
							  @if($url_country)
					          	@foreach($url_country as $country)
					          		['{{ $country->country_code }}', {{$country->countryCount}}],
					          	@endforeach
					          @endif
				        ]);

				        var data5 = new google.visualization.DataTable();
                  		data5.addColumn('date', 'Month');
                  		data5.addColumn('number', 'Hits');

				        data5.addRows([

				        	/**
				        	 * Loop through over URL Hits
				        	 */
				        	@if($url_hits)

				        		// Add some month before current date
					        	@for($month_ago = 13; $month_ago > 0; $month_ago--)
									[new Date({{ date('Y, m, d', strtotime('-'.$month_ago.' month')) }}), 0],
					        	@endfor

					        	// Echo url options date 
					        	@foreach($url_hits as $hitsRow)
					        		[new Date({{$hitsRow->added}}), {{$hitsRow->hitsCount}}],
					        	@endforeach

				        		// Add some month after current date
					        	@for($month_after = 0; $month_after < 3; $month_after++)
									[new Date({{ date('Y, m, d', strtotime('+'.$month_after.' month')) }}), 0],
					        	@endfor

				        	@endif

				    	]);

				        var options = {
				          title: '',
				          legend: 'none',
				          pieSliceText: 'label',
				          chartArea: {'width': '92%', 'height': '80%'},
        				  colors: ['#54AE2B']
				        };

				        var options2 = {
				          title: '',
				          legend: 'none',
				          pieSliceText: 'label',
		                  chartArea: {'width': '92%', 'height': '80%'},
        				  colors: ['#54AE2B']
				        };

				        var options3 = {
				          title: '',
				          legend: 'none',
				          pieSliceText: 'label',
		                    chartArea: {'width': '92%', 'height': '80%'},
        				colors: ['#54AE2B']
				        };

				        var options4 = {
        					colors: ['#54AE2B'],
		                    chartArea: {'width': '92%', 'height': '80%'}
				        };

				        var options5 = {
		                    title: '',
		                    // Gives each series an axis that matches the vAxes number below.
		                    series: {
		                      0: {targetAxisIndex: 0},
		                      1: {targetAxisIndex: 1}
		                    },
		                    chartArea: {'width': '92%', 'height': '80%'},
        					colors: ['#54AE2B']
			                };

				        var chart = new google.visualization.PieChart(document.getElementById('browsers'));
				        chart.draw(data, options);

				        var chart2 = new google.visualization.PieChart(document.getElementById('referrals'));
				        chart2.draw(data2, options2);

				        var chart3 = new google.visualization.PieChart(document.getElementById('os'));
				        chart3.draw(data3, options3);

				        var chart4 = new google.visualization.GeoChart(document.getElementById('regions_div'));
				        chart4.draw(data4, options4);

						function drawClassicChart() {
	                    var chart5 = new google.visualization.LineChart(document.getElementById('chart_div'));
	                    chart5.draw(data5, options5);
	                  	}
	                  		drawClassicChart();
					    }
				    </script>	