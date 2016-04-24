<?php

namespace SShortener\Http\Controllers;

use SShortener\Url;
use SShortener\Option;
use Illuminate\Http\Request;
use SShortener\Http\Requests;
use SShortener\Http\Controllers\Controller;

class ShortenerController extends Controller
{
    public function __construct(Url $urls) 
    {
        $this->$urls = $urls;   
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::check()) :                
            $user = \Auth::user();
            $urls = $user->urls()->orderBy('id', 'desc')->paginate(5);
        endif;

        return view('shortener.home', compact('urls'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'url' => 'required|url'
        ]);

        // Host url
        $hostUrl = url('/');

        // Generate a short url string
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $short_url = substr(str_shuffle($chars), 0, 7);

        $db_shortUrl = Url::where('short_url', $short_url)->first();

        if($db_shortUrl) {
            return \Response::json(['error' => 'error_occured'], 200);
        } else {
            if(\Auth::check()) {
                $url = \Auth::user()->urls()->create([
                    'url'       => $request->get('url'),
                    'short_url' => $short_url
                ]);
            } else {
                $url = Url::create([
                    'url'       => $request->get('url'),
                    'short_url' => $short_url
                ]);
            }

            $urlText = str_limit($request->get('url'), 20);

            return \Response::json(['url' => $url, 'hostUrl' => $hostUrl, 'urlText' => $urlText], 200);
        }

        
    }


    public function showUrl($shortUrl)
    {
        $url = Url::where('short_url', $shortUrl)->first();
        if($url) {
            // Initialize variables
            $ip = $this->clientIp();
            $countryCode = $this->countryCode();
            $referer = $_SERVER['HTTP_REFERER'];
            $user_agent = $_SERVER['HTTP_USER_AGENT'];
            $added = date('Y, m, d', strtotime('-1 month'));

            $urlOptionExists = Option::where(['ip' => $ip, 'url_id' => $url->id])->first();

            if(count($urlOptionExists) < 1) {
                if(
                    preg_match("/\bfacebookexternalhit\b/i", $user_agent) ||
                    preg_match("/\btwitterbot\b/i", $user_agent)

                ) {

                } else {
                    if($referer != '') {
                         if(strlen($referer) > 20) {
                            $referer = substr($referer, 0, 20) . '...';
                         }
                    } else {
                         $referer =  url('/');
                    }
                    $url_options = Option::create([
                        'url_id' => $url->id,
                        'user_agent' => $user_agent,
                        'referer' => $referer,
                        'ip' => $ip,
                        'country_code' => $countryCode,
                        'added' => $added,
                    ]);
                }
            }

            // Increment clicks
            Url::where('short_url', $shortUrl)->increment('clicks');

            // redirect url
            return redirect($url->url);

        } else {
            return redirect(route('index'));
        }
    }

    /**
     * Show the statistics page
     */
    public function statistics($short_url)
    {
        $url = Url::where('short_url', $short_url)->first();
        $option = Option::where('url_id', $url->id)->first();
        $option_count = Option::where('url_id', $url->id)->count();
        $url_hits = Option::urlHits($url);
        $url_browser = Option::browser($url);
        $url_os = Option::operatingSystem($url);
        $refererList = Option::refererListCount($url);
        $url_country = Option::Country($url);
        
        if($url) {
            return view('shortener.statistics', compact('url',  'option_count', 'url_hits', 'url_browser', 'url_os', 'refererList', 'url_country'));            
        } else {
            return redirect(route('index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyUrl($id)
    {
        $url = Url::find($id);

        $url->delete();

        return \Response::json(['success' => 'true', 200]);

    }


    /**
     * Get the client Id
     */
    public function clientIp() 
    {
        $ip = '';
        if (getenv('HTTP_CLIENT_IP'))
            $ip = getenv('HTTP_CLIENT_IP');
        else if(getenv('HTTP_X_FORWARDED_FOR'))
            $ip = getenv('HTTP_X_FORWARDED_FOR');
        else if(getenv('HTTP_X_FORWARDED'))
            $ip = getenv('HTTP_X_FORWARDED');
        else if(getenv('HTTP_FORWARDED_FOR'))
            $ip = getenv('HTTP_FORWARDED_FOR');
        else if(getenv('HTTP_FORWARDED'))
            $ip = getenv('HTTP_FORWARDED');
        else if(getenv('REMOTE_ADDR'))
            $ip = getenv('REMOTE_ADDR');
        else
            $ip = 'UNKNOWN';
     
        return $ip;   
    }

    /**
     * Get the country code
     */
    public function countryCode() 
    {
        $country = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='. $this->clientIp()));
        $country_code = $country['geoplugin_countryName'];
        return $country_code;
    }


}
