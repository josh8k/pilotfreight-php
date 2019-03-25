<?php
namespace PilotFreight\Model;
use SoapVar;

/**
 * ShipmentDocumentRequest for primarily the non-cached ShipmentDocument version, but has some overlap w/ the cached version.
 * Also contains imortant/useful constants for the doc type
*/
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
	const TYPE_HAWB = "HAWB";
	
	/**
	 * @param Auth $auth
	 * @return object Returns an object for the SOAP call containing the relevant docs, using the appropriate namespace
	 */
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