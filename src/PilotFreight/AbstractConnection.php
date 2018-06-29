<?php
	
namespace PilotFreight;

use GuzzleHttp;

abstract class AbstractConnection
{
	
	protected $auth = null;
	protected $rawRequest = null;
	protected $rawResponse = null;
	protected $requestUrl;
	protected static $httpRequestMethod = 'POST';
	protected static $responseClass = null;
	protected static $requestDebug = false;
	protected static $requestAllowRedirects = true;
	protected $headers = [];
	
	public function __construct(Model\Auth $auth)
	{
		$this->auth = $auth;
	}
	
	public function send(Model\Request $request) 
	{
		$rawRequest = $request->prep($this->auth);
		$rawResponse = $this->request($rawRequest);
		
		// this allows all of the children classes to define this how they'd like
		return $this->response($rawResponse);
	}
	
	protected function prepHeaders()
	{
		$this->addHeader('Accept', 'application/json');
		$this->addHeader('Content-Type', 'application/json');
	}
	
	protected function formatHeaders()
	{
		return $this->headers;
	}
	
	protected function addHeader($headerName, $headerValue)
	{
		$this->headers[$headerName] = $headerValue;
	}
	
	protected function request($rawRequest)
	{
		$this->rawRequest = $rawRequest;
		$this->prepHeaders();
		$headers = $this->formatHeaders();
		// contains all of the transport code
		try
		{
			$client = new GuzzleHttp\Client();
			$res = $client->request(static::$httpRequestMethod, $this->requestUrl, [
				'headers' => $headers,
				'body' => $this->rawRequest,
				'debug' => static::$requestDebug,
				'allow_redirects' => static::$requestAllowRedirects
			]);
				
			// i also want to save the content type that's responded
			$responseHeaders = $res->getHeaders();
			$responseContentType = "text/plain"; // by default
			if (isset($responseHeaders['Content-Type']) && is_array($responseHeaders['Content-Type']) && count($responseHeaders['Content-Type']))
			{
				$responseContentType = (string)$responseHeaders['Content-Type'][0];
			}
				
			// then sets this
			$this->rawResponse = [
				'body' => (string)$res->getBody(),
				'statusCode' => (string)$res->getStatusCode(),
				'contentType' => $responseContentType
			];
		} catch (\Exception $e)
		{
			throw $e;
		}
		return $this->rawResponse;
	}
	
	protected function response($rawResponse)
	{
		if (!is_null(static::$responseClass)) {
			$responseClass = static::$responseClass;
			return $responseClass::create($rawResponse);
		}
		
		return $this->getLastResponse(); // by default
	}
	
	public function getLastRequest()
	{
		return $this->rawRequest;
	}
	
	public function getLastResponse()
	{
		return $this->rawResponse;
	}
	
	public function getRequestUrl()
	{
		return $this->requestUrl;
	}
}
?>