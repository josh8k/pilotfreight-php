<?php
namespace PilotFreight\Model;

/**
 * Primary response object for Track call
 */
class TrackResponse extends Response
{
	/**
	 * Contains code for parsing through the XML of the track response
	 * @return void But sets the response instance variables for later use
	 */
	protected function parse()
	{
		// we know that for the track method, we should be received XML back.
		// if we don't have XML, then give an error
		$xml = simplexml_load_string($this->rawResponse['body']);
		if ($xml === false)
		{
			throw new \Exception("non-xml response from tracking response");
		} // end if
		
		// otherwise we have a valid object and can continue
		$resp = [];
		foreach ($xml->xpath('PackageTrackingInfo') as $shipment)
		{
			// going to do something very simple here and convert each shipment into an associative array
			$this->response[] = json_decode(json_encode($shipment), true);
		}
	}	
}
?>