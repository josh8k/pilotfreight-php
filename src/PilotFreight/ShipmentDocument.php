<?php
namespace PilotFreight;
/**
 * ShipmentDocument
 * Available Doc Types (as of 3/19): Look in Model\ShipmentDocumentRequest at the constants available
 * Available Call Names: HAWBDocument & HAWBLabel
 *
 * Used to retrieved the relevant shipping documents, either a BOL or Label
 *
 * @author josh8k
 */
class ShipmentDocument extends AbstractSoapConnection
{
	protected static $wsdlPath;
	protected static $responseClass = "PilotFreight\Model\ShipmentDocumentResponse";
	
	/**
	 * @param Model\Auth $auth Fully constructed Mode\Auth object
	 */
	public function __construct(Model\Auth $auth)
	{
		static::$wsdlPath = dirname ( dirname ( __FILE__ ) ) . DIRECTORY_SEPARATOR .  "wsdl" . DIRECTORY_SEPARATOR . "shipmentdocument.wsdl";
		parent::__construct($auth);
	}
	
	/**
	 * Override parent method
	 * @param array $rawResponse The raw response array that's been set in the request method
	 * @return mixed Usually will return Model\Response child class but may also return an array of the last rawResponse
	 */
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
}
?>