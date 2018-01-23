<?php

namespace Moskalyovd\FDLBundle\Service;

use GuzzleHttp\ClientInterface;

class DynamicLink
{
    const REQUEST_URI = 'https://firebasedynamiclinks.googleapis.com/v1/shortLinks/?key=%s';

    /**
     * @var string $key
     */
    private $key;

    /**
     * @var string $dynamicLinkDomain
     */
    private $dynamicLinkDomain;

    /**
     * @var GuzzleHttp\ClientInterface $guzzleClient
     */
    private $guzzleClient;

    /**
     * __construct
     *
     * @param string $key
     * @param string $dynamicLinkDomain
     */
    public function __construct($key, $dynamicLinkDomain)
    {
        $this->key = $key;
        $this->dynamicLinkDomain = $dynamicLinkDomain;
    }

    /**
     * injectHttpClient
     *
     * @param ClientInterface $guzzleClient
     */
    public function injectHttpClient(ClientInterface $guzzleClient)
    {
        $this->guzzleClient = $guzzleClient;
    }

    /**
     * createLink
     *
     * @param mixed $link
     * @param mixed $parameters
     *
     * @return Psr\Http\Message\ResponseInterface
     */
    public function createLink($link, $dynamicLinkInfo = null, $suffix)
    {
        $requestBody = [];

        if ($parameters) {
            /** @todo add parameters validation */
            $requestBody['dynamicLinkInfo'] = $parameters;
        }

        $requestBody['dynamicLinkInfo']['link'] = $link;
        $requestBody['dynamicLinkInfo']['dynamicLinkDomain'] = $this->dynamicLinkDomain;

        /** @todo handle error responses **/
        $response =  $this->guzzleClient->post(
            $this->getRequestUri(),
            [
                'headers' => [
                    'Content-Type' => 'application/json'
                ],
                'body' => json_encode($requestBody)
            ]
        );

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * getRequestUri
     *
     * @return string
     */
    private function getRequestUri()
    {
        return sprintf(self::REQUEST_URI, $this->key);
    }
}