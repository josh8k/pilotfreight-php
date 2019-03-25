<?php
namespace PilotFreight;

use GuzzleHttp;

/**
 * Contains most of the code for handling the REST connections
 * @author josh8k
 */
abstract class AbstractConnection implements ConnectionInterface
{
	/**
	* It's important for the child classes to declare their own responseClass, requestUrl. 
	* The other instance & static variables needed will be clear based on the individual requirements of the API call
	*/
	protected $auth = null;
	protected $rawRequest = null;
	protected $rawResponse = null;
	protected $requestUrl;
	protected static $httpRequestMethod = 'POST';
	protected static $responseClass = null;
	protected static $requestDebug = false;
	protected static $requestAllowRedirects = true;
	protected $headers = [];
	
	/**
	* @param Model\Auth $auth Fully constructed Mode\Auth object
	*/
	public function __construct(Model\Auth $auth)
	{
		$this->auth = $auth;
	}
	
	/**
	* @param Model\Request $request Specific request object for the desired call
	* @return Model\Response Will return specific response object based on the request, otherwise, the raw response
	* @todo Better standardize this response. Maybe an \Exception instead?
	*/
	public function send(Model\Request $request) 
	{
		$rawRequest = $request->prep($this->auth);
		$rawResponse = $this->request($rawRequest);
		
		// this allows all of the children classes to define this how they'd like
		return $this->response($rawResponse);
	}
	
	/**
	* Sets standard Headers
	*/
	protected function prepHeaders()
	{
		$this->addHeader('Accept', 'application/json');
		$this->addHeader('Content-Type', 'application/json');
	}
	
	/**
	* @return array Returns array of headers
	*/
	protected function formatHeaders()
	{
		return $this->headers;
	}
	
	/**
	* @param string $headerName
	* @param mixed $headerValue Scalar value
	*/
	protected function addHeader($headerName, $headerValue)
	{
		$this->headers[$headerName] = $headerValue;
	}
	
	/**
	* @param string $rawRequest Receives raw request, usually either XML or JSON, depending on the API call to Pilot
	* @return array Returns the raw response array
	* @throws \Exception
	*/
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
	
	/**
	* @param array $rawResponse The raw response array that's been set in the request method
	* @return mixed Usually will return Model\Response child class but may also return an array of the last rawResponse
	*/
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