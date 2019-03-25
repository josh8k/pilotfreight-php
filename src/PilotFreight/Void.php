<?php
namespace PilotFreight;
/**
  * Void
  * Used to void an existing shipment
  *
  * @author josh8k
  */
class Void extends AbstractSoapConnection
{
	protected static $wsdlPath;
	protected static $responseClass = "PilotFreight\Model\VoidResponse";
	protected static $callName = "Void";
	
	/**
	 * @param Model\Auth $auth Fully constructed Mode\Auth object
	 */
	public function __construct(Model\Auth $auth)
	{
		static::$wsdlPath = dirname ( dirname ( __FILE__ ) ) . DIRECTORY_SEPARATOR .  "wsdl" . DIRECTORY_SEPARATOR . "shipment.wsdl";
		parent::__construct($auth);
	}
} // END class 

?>