<?php
namespace PilotFreight;
/**
 * Track
 *
 * @package PilotFreight
 * @class Track
 * @extends AbstractConnection
 */
class Track extends AbstractConnection
{
	protected $requestUrl = "https://www.pilotssl.com/pilotdetailpartnertracking.aspx";
	protected static $responseClass = "PilotFreight\Model\TrackResponse";
	
} // END class 

?>