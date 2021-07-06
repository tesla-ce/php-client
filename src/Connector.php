<?php
namespace tesla_ce\client;

use tesla_ce\client\exceptions\ResponseError;

class Connector
{
    const TESLA_CE_SDK_CONFIGURATION_EXPIRATION = 'tesla_ce_sdk_configuration_expiration';
    const TESLA_CE_SDK_CONFIGURATION = 'tesla_ce_sdk_configuration';
    // Duration of the SDK Cache n minutes
    const TESLA_CE_SDK_EXPIRATION_CACHE = 5;

    private $role_id;
    private $secret_id;
    private $base_url;
    private $verify_ssl;
    private $configuration = null;
    private $module = null;
    private $module_type = null;
    private $token = null;
    private $cache = null;

    public function __construct($role_id, $secret_id, $base_url, $verify_ssl = true, Cache $cache = null)
    {
        $this->role_id = $role_id;
        $this->secret_id = $secret_id;
        $this->base_url = $base_url;
        $this->verify_ssl = $verify_ssl;
        $this->cache = $cache;

        // init configuration
        $this->getConfiguration();
    }

    public function getModule()
    {
        if ($this->module == null) {
            $this->getInternalConfiguration();
        }

        return $this->module;
    }

    public function getModuleType()
    {
        if ($this->module_type == null) {
            $this->getInternalConfiguration();
        }

        return $this->module_type;
    }

    public function getConfiguration()
    {
        if ($this->configuration == null) {
            $this->getInternalConfiguration();
        }

        return $this->configuration;
    }

    public function makeAPIRequest($verb, $url, $data)
    {
        $url = trim($this->base_url, '/').'/'.$url;

        $headers = array(
            'Authorization: JWT '.$this->token['access_token']
        );

        return $this->makeRequest($verb, $url, $data, $headers);
    }

    private function getInternalConfiguration()
    {
        // check if cache is enabled and data is not expired
        if ($this->cache != null) {
            $cacheConfigurationExpiration = $this->cache->get(Connector::TESLA_CE_SDK_CONFIGURATION_EXPIRATION);
            $now = new \DateTime();
            if ($now < $cacheConfigurationExpiration) {
                $cacheConfiguration = $this->cache->get(Connector::TESLA_CE_SDK_CONFIGURATION);
                if ($cacheConfiguration != null) {
                    $this->configuration = $cacheConfiguration['config'];

                    $this->module_type = $cacheConfiguration['type'];
                    $this->module = $cacheConfiguration;
                    $this->token = $cacheConfiguration['token'];
                    return;
                }
            }
        }

        $url = $this->base_url.'/api/v2/auth/approle';
        $data =  array(
            'role_id'=>$this->role_id,
            'secret_id'=>$this->secret_id
        );

        $response = $this->makeRequest('POST', $url, $data);

        if ($response['headers']['http_code'] != 200 || isset($response['error']) && $response['error'] != '') {
            $error = '';
            if ($response['error']['error']) {
                $error = $response['error']['error'];
            }

            throw new ResponseError("Error getting configuration. ".$error);
        }

        if ($this->cache != null) {
            $now = new \DateTime();
            $interval = new \DateInterval('PT' . Connector::TESLA_CE_SDK_EXPIRATION_CACHE . 'M');
            $now->add($interval);

            $this->cache->set(Connector::TESLA_CE_SDK_CONFIGURATION_EXPIRATION, $now);
            $this->cache->set(Connector::TESLA_CE_SDK_CONFIGURATION, $response['content']);
        }

        $this->module_type = $response['content']['type'];
        $this->module = $response['content'];
        $this->configuration = $response['content']['config'];
        $this->token = $response['content']['token'];
    }

    private function makeRequest($verb, $url, $data, $headers = array())
    {
        // Create a new cURL resource
        $curl = curl_init();

        if (!$curl) {
            throw new ResponseError("Couldn't initialize a cURL handle");
        }
        // Set the file URL to fetch through cURL
        curl_setopt($curl, CURLOPT_URL, $url);
        // Set a different user agent string (Googlebot)
        curl_setopt($curl, CURLOPT_USERAGENT, 'TeSLA-PHP-SDK-v1');
        // Follow redirects, if any
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        // Return the actual result of the curl result instead of success code
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        // Wait for 10 seconds to connect, set 0 to wait indefinitely
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 10);
        // Execute the cURL request for a maximum of 30 seconds
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);

        // Check SSL certificates
        if ($this->verify_ssl === true) {
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 2);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 1);
        } else {
            curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        }

        curl_setopt($curl, CURLOPT_NOBODY, false);
        curl_setopt($curl, CURLOPT_VERBOSE, false);
        $headers[] = 'Content-type:application/json';

        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);

        if ($verb != 'GET') {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $verb);
        }

        if (!empty($data)) {
            $json_body = json_encode($data);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $json_body);
        }

        // Fetch the URL and save the content in $html variable
        $response = curl_exec($curl);

        $response_headers = curl_getinfo($curl);

        $response_content = json_decode($response, true);
        $response_error = '';

        // Check if any error has occurred
        if (curl_errno($curl)) {
            $response_error = array(
                'error'=>curl_error($curl),
                'content'=>$response
            );
        }

        // close cURL resource to free up system resources
        curl_close($curl);

        $response = array(
            'headers'=>$response_headers,
            'content'=>$response_content,
            'error'=>$response_error
        );

        return $response;
    }
}
