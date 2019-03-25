<?php
namespace PilotFreight\Model;
use SimpleXMLElement;

/**
 * Primary response object for Void Call
 * The documentation on this from Pilot was a little fuzzy, so I had to create my own sort of structure to it
 */
class VoidResponse extends AbstractResponse
{
	protected static $SUCCESSFUL_VOID_MESSAGE = "shipment void success";
	
	/** 
	 * @return void Sets response instance variable for later use
	 */
	protected function parse()
	{
		if (is_array($this->rawResponse) && isset($this->rawResponse['body']))
		{
			$this->response = $this->rawResponse['body'];
		}
		else {
			throw new \Exception("Invalid raw response parse attept");
		}
		
	}
	
	/**
	 * defines when there's been an error in the response
	 * @return boolean Returns either true or false depending on whether there's an error or not
	 */
	public function isError()
	{
		if (!is_null($this->response) && isset($this->response->VoidResult))
		{
			return $this->response->VoidResult->IsError;
		}
		return true; // if the response isn't set or VoidResult isn't present, it's an error
	}
	
	/**
	 * Determines success of the SOAP call
	 * @return boolean Depending on whether or not the call was a success
	 */
	public function isSuccess()
	{
		return (!$this->isError() && strtolower((string)$this->response->VoidResult->Message) == static::$SUCCESSFUL_VOID_MESSAGE);
	}

}
?>