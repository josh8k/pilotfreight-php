<?php
namespace PilotFreight\Model;

/**
 * Primary response class. Will usually be accessed by child classes
*/
class Response extends AbstractResponse
{
	protected $rawResponse = null;
	protected $response = [];
	public function __construct() {}

	/**
	 * Parse the response that comes in and is already set in the rawResponse instance variable
	 * @return void But sets the response array into the response instance variable for access later
	 */
	protected function parse()
	{
		if (substr($this->rawResponse['statusCode'], 0, 1) != "2")
		{
			// then there was an error
			throw new \PilotFreight\Exception("Unsuccessful status code returned " . $this->rawResponse['statusCode']);
		}
		// response should be in json
		// this is going to be the default because most cases are like this
		// however, in other cases, like Tracking, it's not, so that can be handled locally
		$this->response = json_decode($this->rawResponse['body'], true);
	}	
	
	public function getStatusCode()
	{
		if (!is_null($this->rawResponse) && isset($this->rawResponse['statusCode']))
		{
			return $this->rawResponse['statusCode'];
		}
		return false;
	}
	
	public function getContentType()
	{
		if (!is_null($this->rawResponse) && isset($this->rawResponse['contentType']))
		{
			return $this->rawResponse['contentType'];
		}
		return false;
	}
}
?>