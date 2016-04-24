<?php 

namespace SShortener\Traits;
use SShortener\Url;

trait ShortenerControllerTrait{

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
    

    /**
     * Create shorturl
     * @param  [type] $db_shortUrl [description]
     * @param  [type] $short_url   [description]
     * @param  [type] $hostUrl     [description]
     * @param  [type] $request     [description]
     * @return [type]              [description]
     */
    public function createUrl($db_shortUrl, $short_url, $hostUrl, $request) 
    {
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
}