<?php
/*
 * PHP library for Mixpanel data API -- http://www.mixpanel.com/
 * Requires PHP 5.2 with JSON
 */

class Mixpanel
{
    private $api_url = 'https://data.mixpanel.com/api';
    private $version = '2.0';
    private $api_secret;

    public function __construct($api_secret) {
        $this->api_secret = $api_secret;
    }

    public function request($params, $format='json') {
        // $end_point is an API end point such as events, properties, funnels, etc.
        // $method is an API method such as general, unique, average, etc.
        // $params is an associative array of parameters.
        // See http://mixpanel.com/api/docs/guides/api/

        $params['format'] = $format;

        $param_query = '';
        foreach ($params as $param => &$value) {
            if (is_array($value))
                $value = json_encode($value);
            $param_query .= '&' . urlencode($param) . '=' . urlencode($value);
        }

        $uri = '/' . $this->version . '/export/';
        $request_url = $uri . '?' . $param_query;
        $headers = array("Authorization: Basic " . base64_encode($this->api_secret));
        $curl_handle=curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, $this->api_url . $request_url);
        curl_setopt($curl_handle, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($curl_handle);
        curl_close($curl_handle);


        //echo($data);
        function str_replace_json($search, $replace, $subject)
        {
            return json_decode(str_replace($search, $replace, json_encode($subject)));
        }


        //Conversion of Mixpanel's JSONP to JSON to be read by AwesometableJs
        $search = '\n';
        $replace = ',';
        $json_formatted = str_replace_json($search, $replace, $data);

        $search2 = '\"properties\":{';
        $replace2 = ':';
        $json_without_props = str_replace_json($search2, $replace2, $json_formatted);

        $search3 = '}}';
        $replace3 = '}';
        $json_without_doubles = str_replace_json($search3, $replace3, $json_without_props);

        $search4 = ',:';
        $replace4 = ',';
        $json_end_formated = str_replace_json($search4, $replace4, $json_without_doubles);

        $json_end_formated = rtrim($json_end_formated, ',');

        $json_data_array = "[" . $json_end_formated . "]";

        echo($json_data_array);

        return json_decode($data);
    }
}

?>