<?php
namespace PilotFreight\Model;
use SimpleXMLElement;

class VoidResponse extends AbstractResponse
{
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

}
?>