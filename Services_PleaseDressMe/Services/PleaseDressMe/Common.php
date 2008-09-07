<?php


class Services_PleaseDressMe_Common
{
    protected $user = '';
    protected $pass = '';

    public function __construct($user = '', $pass = '')
    {
        $this->user = $user;
        $this->pass = $pass;
    }

    /**
     * Send a request to the PleaseDressMe API
     *
     * @param string $endPoint The API endpoint WITHOUT the extension
     * @param array  $params   The API endpoint arguments to pass
     * @param string $method   Whether to use GET or POST 
     *
     * @throws Services_PLeaseDressMe_Exception
     * @return object Instance of SimpleXMLElement 
     */
    protected function sendRequest($endPoint, 
                                   array $params = array(),
                                   $method = 'GET')
    {
        $uri = Services_PleaseDressMe::$uri . $endPoint . '.xml';    

        if ($method != 'GET' && $method != 'POST') {
            throw new Services_PleaseDressMe_Exception(
                'Unsupported method: ' . $method
            );
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Services_PleaseDressMe');
        curl_setopt($ch, CURLOPT_HEADER, false);

        $sets = array();
        foreach ($params as $key => $val) {
            $sets[] = $key . '=' . urlencode($val);
        }

        if ($method == 'POST') {
            curl_setopt($ch, CURLOPT_USERPWD, $this->user . ':' . $this->pass);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, implode('&', $sets));
        } else {
            if (count($sets)) {
                $uri .= '?' . implode('&', $sets);
            }
        }

        curl_setopt($ch, CURLOPT_URL, $uri);
        $res = trim(curl_exec($ch));

        $err = curl_errno($ch);
        if ($err !== CURLE_OK) {
            throw new Services_PleaseDressMe_Exception(
                curl_error($ch), $err, $uri
            );
        }

        $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (substr($code, 0, 1) != '2') {
            $xml = @simplexml_load_string($res);
            if ($xml instanceof SimpleXMLElement && isset($xml->error)) {
                throw new Services_PleaseDressMe_Exception(
                    (string)$xml->error['message'], 0, $uri
                );
            }

            throw new Services_PleaseDressMe_Exception(
                'Unexpected HTTP status returned from API', $code, $uri
            );
        }

        curl_close($ch);

        if (!strlen($res)) {
            throw new Services_PleaseDressMe_Exception(
                'Empty response was received from the API', 0, $uri
            );
        }

        $xml = @simplexml_load_string($res);
        if (!$xml instanceof SimpleXMLElement) {
            throw new Services_PleaseDressMe_Exception(
                'Could not parse response received by the API', 0, $uri
            );
        }

        return $xml;
    }
}

?>
