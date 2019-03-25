<?php
namespace PilotFreight;
/**
 * Track
 * Used to track the status of a shipment, given a HAWB/tracking number
 * @author josh8k
 */
class Track extends AbstractConnection
{
	protected $requestUrl = "https://www.pilotssl.com/pilotdetailpartnertracking.aspx";
	protected static $responseClass = "PilotFreight\Model\TrackResponse";
	
}

?>