<?php

namespace SShortener;

use Illuminate\Database\Eloquent\Model;
use SShortener\Url;


class Option extends Model
{
	protected $fillable = [
		'url_id', 'user_agent', 'referer',  'ip', 'country_code', 'added'
	];

    public function url() 
    {
    	return $this->belongsTo(Url::class);
    }

    public static function urlHits($url)
    {
    	return Option::select('added', \DB::raw('count(added) AS hitsCount'))
		    		->where('url_id', '=', $url->id)
		    		->groupBy('added')
		    		->get();
    }

    public static function refererListCount($url) 
    {
    	return Option::select('referer', \DB::raw('count(referer) AS refererCount'))
		    		->where('url_id', '=', $url->id)
		    		->groupBy('referer')
		    		->get();
    }

    public static function browser($url) 
    {
    	$browser_data = Option::where('url_id', $url->id)->get();

		// Initialize some variables
		$msie = 0;
		$edge = 0;
		$chrome = 0;
		$firefox = 0;
		$safari = 0;
		$opera = 0;
		$netscape = 0;
		$maxthon = 0;
		$konqueror = 0;
		$mobile = 0;
		$unknown = 0;

		if($browser_data) {
			foreach($browser_data as $s_browser_data) {
				$user_agent = $s_browser_data->user_agent;
				if(strpos($user_agent, 'MSIE') !== FALSE)  {
					$msie++;
				} 
				elseif(strpos($user_agent, 'edge') !== FALSE)  {
					$edge++;
				}
				elseif(strpos($user_agent, 'Firefox') !== FALSE) {
					$firefox++;
				}
				elseif(strpos($user_agent, 'Chrome') !== FALSE) {
					$chrome++;
				}
				elseif(strpos($user_agent, 'Opera') !== FALSE) {
					$opera++;
				}
				elseif(strpos($user_agent, 'Safari') !== FALSE) {
					$safari++;
				}
				elseif(strpos($user_agent, 'netscape') !== FALSE) {
					$netscape++;
				}
				elseif(strpos($user_agent, 'Maxthon') !== FALSE) {
					$maxthon++;
				}
				elseif(strpos($user_agent, 'konqueror') !== FALSE) {
					$konqueror++;
				}
				elseif(strpos($user_agent, 'mobile') !== FALSE) {
					$mobile++;
				}
				else {
					$unknown++;
				}
			}
		}

		$browser_data = array(
			'msie' => $msie,
			'edge' => $edge,
			'firefox' => $firefox,
			'chrome' => $chrome,
			'opera' => $opera,
			'safari' => $safari,
			'netscape' => $netscape,
			'maxthon' => $maxthon,
			'konqueror' => $konqueror,
			'mobile' => $mobile,
			'unknown' => $unknown
		);
		return $browser_data;
    }

    public static function operatingSystem($url) 
    {
    	$os = Option::where('url_id', $url->id)->get();

		$windows_10 			= 0;
		$windows_81 			= 0;
		$windows_8 				= 0;
		$windows_7 				= 0;
		$windows_vista 			= 0;
		$windows_server_2003 	= 0;
		$windows_xp 			= 0;
		$windows_2000 			= 0;
		$windows_me 			= 0;
		$windows_98 			= 0;
		$windows_95 			= 0;
		$windows_3 				= 0;
		$mac_os_x 				= 0;
		$mac_os_9				= 0;
		$linux 					= 0;
		$ubuntu 				= 0;
		$iPhone 				= 0;
		$iPod 					= 0;
		$iPad 					= 0;
		$android 				= 0;
		$blackberry 			= 0;
		$mobile 				= 0;
		$unknown 				= 0;

		if($os) {
			foreach($os as $s_os) {
				$user_os = $s_os->user_agent;

				$os_platform    =   "Unknown OS Platform";

			    $os_array       =   array(
			        '/windows nt 10/i'     =>  'Windows 10',
			        '/windows nt 6.3/i'     =>  'Windows 8.1',
			        '/windows nt 6.2/i'     =>  'Windows 8',
			        '/windows nt 6.1/i'     =>  'Windows 7',
			        '/windows nt 6.0/i'     =>  'Windows Vista',
			        '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
			        '/windows nt 5.1/i'     =>  'Windows XP',
			        '/windows xp/i'         =>  'Windows XP',
			        '/windows nt 5.0/i'     =>  'Windows 2000',
			        '/windows me/i'         =>  'Windows ME',
			        '/win98/i'              =>  'Windows 98',
			        '/win95/i'              =>  'Windows 95',
			        '/win16/i'              =>  'Windows 3.11',
			        '/macintosh|mac os x/i' =>  'Mac OS X',
			        '/mac_powerpc/i'        =>  'Mac OS 9',
			        '/linux/i'              =>  'Linux',
			        '/ubuntu/i'             =>  'Ubuntu',
			        '/iphone/i'             =>  'iPhone',
			        '/ipod/i'               =>  'iPod',
			        '/ipad/i'               =>  'iPad',
			        '/android/i'            =>  'Android',
			        '/blackberry/i'         =>  'BlackBerry',
			        '/webos/i'              =>  'Mobile'
			    );

			    foreach ($os_array as $regex => $value) { 

			        if (preg_match($regex, $user_os)) {
			            if($value == 'Windows 10') {
			            	$windows_10++;
			            } else if($value == 'Windows 8.1') {
			            	$windows_81++;
			            } else if($value == 'Windows 8') {
			            	$windows_8++;
			            } else if($value == 'Windows 7') {
			            	$windows_7++;
			            } else if($value == 'Windows Vista') {
			            	$windows_vista++;
			            } else if($value == 'Windows Server 2003/XP x64') {
			            	$windows_server_2003++;
			            } else if($value == 'Windows XP') {
			            	$windows_xp++;
			            } else if($value == 'Windows 2000') {
			            	$windows_2000++;
			            } else if($value == 'Windows ME') {
			            	$windows_me++;
			            } else if($value == 'Windows 98') {
			            	$windows_98++;
			            } else if($value == 'Windows 95') {
			            	$windows_95++;
			            } else if($value == 'Windows 3.11') {
			            	$windows_3++;
			            } else if($value == 'Mac OS X') {
			            	$mac_os_x++;
			            } else if($value == 'Mac OS 9') {
			            	$mac_os_9++;
			            } else if($value == 'Linux') {
			            	$linux++;
			            } else if($value == 'Ubuntu') {
			            	$ubuntu++;
			            } else if($value == 'iPhone') {
			            	$iPhone++;
			            } else if($value == 'iPod') {
			            	$iPod++;
			            } else if($value == 'iPad') {
			            	$iPad++;
			            } else if($value == 'Android') {
			            	$android++;
			            } else if($value == 'BlackBerry') {
			            	$blackberry++;
			            } else if($value == 'Mobile') {
			            	$mobile++;
			            } else {
			            	$unknown++;
			            }
			        }

			    }
			}
		}

		$user_os_data = array(
			'windows_10' 			=> $windows_10,
			'windows_81' 			=> $windows_81,
			'windows_8' 			=> $windows_8,
			'windows_7' 			=> $windows_7,
			'windows_vista' 		=> $windows_vista,
			'windows_server_2003' 	=> $windows_server_2003,
			'windows_xp' 			=> $windows_xp,
			'windows_2000' 			=> $windows_2000,
			'windows_me' 			=> $windows_me,
			'windows_98' 			=> $windows_98,
			'windows_95' 			=> $windows_95,
			'windows_3' 			=> $windows_3,
			'mac_os_x' 				=> $mac_os_x,
			'mac_os_9'				=> $mac_os_9,
			'linux' 				=> $linux,
			'ubuntu' 				=> $ubuntu,
			'iPhone' 				=> $iPhone,
			'iPod' 					=> $iPod,
			'iPad' 					=> $iPad,
			'android' 				=> $android,
			'blackberry' 			=> $blackberry,
			'mobile' 				=> $mobile,
			'unknown' 				=> $unknown,
		);
		return $user_os_data;
    }

    public static function Country($url) 
    {
    	return Option::select('country_code', \DB::raw('count(country_code) AS countryCount'))
		    		->where('url_id', '=', $url->id)
		    		->groupBy('country_code')
		    		->get();
    }

}
