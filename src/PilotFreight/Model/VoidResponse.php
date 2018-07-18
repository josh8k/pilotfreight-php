<?php
namespace PilotFreight\Model;
use SimpleXMLElement;

class VoidResponse extends AbstractResponse
{
	protected static $SUCCESSFUL_VOID_MESSAGE = "shipment void success";
	
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
	
	public function isError()
	{
		if (!is_null($this->response) && isset($this->response->VoidResult))
		{
			return $this->response->VoidResult->IsError;
		}
		return true; // if the response isn't set or VoidResult isn't present, it's an error
	}
	
	public function isSuccess()
	{
		return (!$this->isError() && strtolower((string)$this->response->VoidResult->Message) == static::$SUCCESSFUL_VOID_MESSAGE);
	}

}
?>