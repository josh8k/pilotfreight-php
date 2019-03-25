<?php
namespace PilotFreight;
/**
 * Shipment
 * Used to actually generate a shipment within Pilot's internal system and generate a HAWB/tracking bumber
 *
 * @author josh8k
 */
class Shipment extends AbstractConnection
{
	protected $requestUrl = "https://www.pilotssl.com/pilotapi/v1/Shipments";
	protected static $responseClass = "PilotFreight\Model\ShipmentResponse";
	
	/**
	* Overrides parent
	* @return void
	*
	*/
	protected function prepHeaders()
	{
		parent::prepHeaders();
		if ($this->auth->getApiKey() !== false)
		{
			$this->addHeader('api-key', $this->auth->getApiKey());
		}
	}
	
}
?>