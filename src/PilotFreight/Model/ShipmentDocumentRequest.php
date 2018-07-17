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
	
	const TYPE_LABEL4X6 = "Label4x6";
	const TYPE_LABEL8X11 = "Label8x11";
	const TYPE_LABEL2X4 = "Label2x4";
	
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