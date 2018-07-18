<?php
namespace PilotFreight;
/**
 * ShipmentDocument
 *
 * @package PilotFreight
 * @class Void
 * @extends AbstractSoapConnection
 */
class Void extends AbstractSoapConnection
{
	protected static $wsdlPath;
	protected static $responseClass = "PilotFreight\Model\VoidResponse";
	protected static $callName = "Void";
	
	public function __construct(Model\Auth $auth)
	{
		static::$wsdlPath = dirname ( dirname ( __FILE__ ) ) . DIRECTORY_SEPARATOR .  "wsdl" . DIRECTORY_SEPARATOR . "shipment.wsdl";
		parent::__construct($auth);
	}
} // END class 

?>