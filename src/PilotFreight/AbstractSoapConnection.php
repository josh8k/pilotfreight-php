<?php
	
namespace PilotFreight;
use SoapClient;

/**
* Contains the code for the API connection if it's SOAP related, like the void call
* @author josh8k
*/
abstract class AbstractSoapConnection implements ConnectionInterface
{
	
	protected $auth = null;
	protected $soapClient = null;
	protected $rawRequest = null;
	protected $rawResponse = null;
	protected static $wsdlPath = null;
	protected static $responseClass = null;
	protected static $callName = null;
	
	/**
	* @param Model\Auth $auth Fully constructed Mode\Auth object
	*/
	public function __construct(Model\Auth $auth)
	{
		$this->auth = $auth;
		$this->soapClient = new SoapClient(static::$wsdlPath, ['trace' => 1, 'cache_wsdl' => WSDL_CACHE_NONE]);
	}
	
	/**
	* @param Model\Request $request Specific request object for the desired call
	* @return Model\Response Will return specific response object based on the request, otherwise, the raw response
	* @todo Better standardize this response. Maybe an \Exception instead?
	*/
	public function send(Model\Request $request) 
	{
		// FOR the soap connection, we're going to assume that the REQUEST will specify what the method being called is. but if not, then there can be a default
		// instantiate the soap client
		$rawRequest = $request->prep($this->auth);
		$callName = ($request->getCallName() !== false ? $request->getCallName() : static::$callName);
		$rawResponse = $this->request($rawRequest, $callName);
		
		// this allows all of the children classes to define this how they'd like
		return $this->response($rawResponse);
	}
	
	/**
	* @param array $requestParams The raw params array that need to sent in the soap call
	* @param string $callName The name of the SOAP method call
	* @return array Returns the raw response array
	* @throws \Exception
	*/
	protected function request($requestParams, $callName)
	{
		$this->rawRequest = $requestParams;
		try {
			$raw_response = $this->soapClient->__soapCall($callName, [$requestParams]);
		} catch (\Exception $e) 
		{
			// this way it'll pass along any of the types of exceptions thrown and allow the code down the pipeline to handle it
			$this->rawResponse = null;
			throw $e;
		}
		$this->rawResponse = $raw_response;
		return $this->rawResponse;
	}
	
	/**
	* @param array $rawResponse The raw response array that's been set in the request method
	* @return mixed Usually will return Model\Response child class but may also return an array of the last rawResponse
	*/
	protected function response($rawResponse)
	{
		// rawresponse should be an object. if not, should be overwritten
		// in the default version, it just returns the full contents fo the SOAP reply
		if (!is_null(static::$responseClass)) {
			$responseClass = static::$responseClass;
			return $responseClass::create(['body' => $rawResponse]);
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
	
	protected function getLastSoapResponse() 
	{
		return $this->soapClient->__getLastResponse();
	}
	
	protected function getLastSoapRequest() 
	{
		return $this->soapClient->__getLastRequest();
	}
	
}
?>