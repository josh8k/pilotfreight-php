<?php
namespace PilotFreight\Model;
use SimpleXMLElement;

/**
 * Handles the response from a ShipmentDocument call
 * A little more heavy lifting required to parse the response from this SOAP call
 */
class ShipmentDocumentResponse extends AbstractResponse
{
	protected function parse()
	{
		if (is_array($this->rawResponse) && isset($this->rawResponse['body']) && strlen($this->rawResponse['body']))
		{
			$respXml = new SimpleXMlElement($this->rawResponse['body']);
			$respXml->registerXPathNamespace('d', 'http://tempuri.org/dsReturnStream.xsd');
			$result = $respXml->xpath("//d:ReturnData");
			$resultArray = (count($result) ? $result[0] : null);
			$this->response = $resultArray;
		}
		else {
			throw new \Exception("Invalid raw response parse attept");
		}
	}
	
	public function getDocument()
	{
		return ($this->get() != null ? (string)$this->get()->DataStream_Byte : false);
	}
	
	public function getDocumentLength()
	{
		return ($this->get() != null ? (int)$this->get()->DataLength : false);
	}
}
?>