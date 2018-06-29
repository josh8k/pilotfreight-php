<?php
namespace PilotFreight\Model;

class TrackResponse extends Response
{
	
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
	
	// then have some getters
		
}
?>