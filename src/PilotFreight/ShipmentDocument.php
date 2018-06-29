<?php
namespace PilotFreight;
/**
 * ShipmentDocument
 *
 * @package PilotFreight
 * @class ShipmentDocument
 * @extends AbstractConnection
 */
class ShipmentDocument extends AbstractConnection
{
	protected static $requestUrlTpl = "https://copilot2.pilotdelivers.com/HAWBorLabel/HAWB_ZIP.aspx?HAWB=^HAWB^&Zip=^ZIP^&Document=^DOCTYPE^";
	protected static $responseClass = "PilotFreight\Model\ShipmentDocumentResponse";
	protected static $httpRequestMethod = 'GET';
	protected static $requestAllowRedirects = false;
	
	public function send(Model\Request $request) 
	{
		
		// instead of the request knowing how to prep itself, in this case, we need to use the request data to build the request URL
		// which is essentially the raw Request
		$this->setRequestUrl($request->getHawb(), $request->getZipcode(), $request->getDocType());
		$rawRequest = $this->getRequestUrl();
		$rawResponse = $this->request($rawRequest);
		
		// now kick the response back to being handled the normal way
		return $this->response($rawResponse);
	}
	
	protected function setRequestUrl($hawb, $zipcode, $doctype)
	{
		$this->requestUrl = str_replace(["^HAWB^", "^ZIP^", "^DOCTYPE^"], [$hawb, $zipcode, $doctype], static::$requestUrlTpl);
	}
	
	// overwrite the headers to not add anything
	protected function prepHeaders() {}
} // END class 

?>