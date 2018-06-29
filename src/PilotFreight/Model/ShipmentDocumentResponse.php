<?php
namespace PilotFreight\Model;

class ShipmentDocumentResponse extends Response
{
	protected function parse()
	{
		// in this case, parsing the response is different than the others
		if ($this->rawResponse['statusCode'] != "200")
		{
			throw new ShipmentDocumentException("Unable to find document requested");
		} // end if
		
		// otherwise
		$this->response = $this->rawResponse['body'];
	}
}
?>