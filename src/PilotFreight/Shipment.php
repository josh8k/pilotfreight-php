<?php
namespace PilotFreight;
/**
 * Shipment
 *
 * @package PilotFreight
 * @class Shipment
 * @extends AbstractConnection
 */
class Shipment extends AbstractConnection
{
	protected $requestUrl = "https://www.pilotssl.com/pilotapi/v1/Shipments";
	protected static $responseClass = "PilotFreight\Model\ShipmentResponse";
	
	protected function prepHeaders()
	{
		parent::prepHeaders();
		if ($this->auth->getApiKey() !== false)
		{
			$this->addHeader('api-key', $this->auth->getApiKey());
		}
	}
	
} // END class 

?>