<?php
namespace PilotFreight\Model;
use SoapVar;

class ShipmentDocumentRequest extends Request
{
	protected static $xmlns = "http://tempuri.org/";
	protected $data = [
		"hawb" => false,
		"zipcode" => false,
		"doctype" => false,
		"callname" => false
	];
	
	public function prep(Auth $auth)
	{
		
		// we need to format the soap params for this
		$docParams = new \stdClass;
		$docParams->shawb = new SoapVar($this->getHawb(), XSD_STRING, '', '', '', static::$xmlns);
		$docParams->szip = new SoapVar($this->getZipcode(), XSD_STRING, '', '', '', static::$xmlns);
		return $docParams;
	}
}
?>