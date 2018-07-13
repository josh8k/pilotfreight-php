<?php
namespace PilotFreight;
/**
 * ShipmentDocument
 *
 * @package PilotFreight
 * @class ShipmentDocument
 * @extends AbstractConnection
 */
class ShipmentDocument extends AbstractSoapConnection
{
	protected static $wsdlPath = "src/wsdl/shipmentdocument.wsdl";
	protected static $responseClass = "PilotFreight\Model\ShipmentDocumentResponse";
	const TYPE_LABEL4X6 = "Label4x6";
	const TYPE_LABEL8X11 = "Label8x11";
	const TYPE_LABEL2X4 = "Label2x4";
	
	protected function response($rawResponse)
	{
		// we need to overwrite this and ignore the passed rawResponse
		// we will need to retrieve the raw soap data
		$rawSoapResponse = $this->getLastSoapResponse();
		if (!is_null(static::$responseClass)) {
			// instead of passing it the PHP parsed SOAP client response we need to pass it the raw soap response
			$responseClass = static::$responseClass;
			return $responseClass::create(['body' => $rawSoapResponse]);
		}
		return $rawSoapResponse;
	}
} // END class 

?>