<?php
namespace PilotFreight;
/**
  * ShipmentDocumentCached
  * Used to retrieved the relevant shipping documents, either a BOL or Label
  *
  * Why does this class exist in addition to ShipmentDocument?
  * Pilot's system stores a copy of the shipment documents (i.e. labels, BOLs) to their servers in a cron-based manner. That means that if you need to
  *   retrieve the label immediately, you'll likely receive an error. The ShipmentDocument request allows you to retrieve it immediately. However,
  *   Pilot seems to prefer serving up the cached documents rather then generating on the fly. So, if you know that you'll be able to retrieve the
  *   document about 5 minutes after initially creating the shipment, then use this request rather than ShipmentDocument.
  * *HOWEVER* Practically speaking, this doesn't really need to be used.
  * @author josh8k
  */
class ShipmentDocumentCached extends AbstractConnection
{
	protected static $requestUrlTpl = "https://copilot2.pilotdelivers.com/HAWBorLabel/HAWB_ZIP.aspx?HAWB=^HAWB^&Zip=^ZIP^&Document=^DOCTYPE^";
	protected static $responseClass = "PilotFreight\Model\ShipmentDocumentCachedResponse";
	protected static $httpRequestMethod = 'GET';
	protected static $requestAllowRedirects = false;
	
	/**
	 * @param Model\Request $request Specific request object for the desired call
	 * @return Model\Response Will return specific response object based on the request, otherwise, the raw response
	 * @todo Better standardize this response. Maybe an \Exception instead?
	 */
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
	
	/**
	* Preps the request url param with the additional variables needed for making the call to the API
	* @param string $hawb The BOL/tracking number
	* @param string $zipcode The zip code of recipient/consignee
	* @param string $doctype Usually one of the following values: HAWB
	* @return void
	*/
	protected function setRequestUrl($hawb, $zipcode, $doctype)
	{
		$this->requestUrl = str_replace(["^HAWB^", "^ZIP^", "^DOCTYPE^"], [$hawb, $zipcode, $doctype], static::$requestUrlTpl);
	}
	
	/**
	* overwrite the headers not to add anything
	* @return void
	**/
	protected function prepHeaders() {}
} // END class 

?>