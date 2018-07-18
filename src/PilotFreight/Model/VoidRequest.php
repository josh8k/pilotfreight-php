<?php
namespace PilotFreight\Model;
use SoapVar;

class VoidRequest extends Request
{
	protected static $xmlns = "http://tempuri.org/";
	protected $data = [
		"pronumber" => false,
		'callname' => false
	];
	
	public function prep(Auth $auth)
	{
		
		// we need to format the soap params for this
		// we could spend a lot of time using language constructs, instead i'm just going to use XML directly
		$xml = '<dsVoid xmlns="' . static::$xmlns . '"><dsVoid xmlns="http://tempuri.org/dsVoid.xsd" xmlns:msdata="urn:schemas-microsoft-com:xml-msdata" xmlns:diffgr="urn:schemas-microsoft-com:xml-diffgram-v1">
                  <Void diffgr:id="Void1" msdata:rowOrder="0" diffgr:hasChanges="inserted" >
                     <LocationID>' . $auth->getLocationId() . '</LocationID>
                     <AddressID>' . $auth->getAddressId() . '</AddressID>
                     <ControlStation>' . $auth->getControlStation(). '</ControlStation>
                     <TariffHeaderID>' . $auth->getTariffHeaderId(). '</TariffHeaderID>
                     <ProNumber>' . $this->getProNumber(). '</ProNumber>
                  </Void>
               </dsVoid></dsVoid>';
		
		$voidObject = new \stdClass;
		$voidObject->dsVoid = new SoapVar(new SoapVar($xml, XSD_ANYXML), SOAP_ENC_OBJECT, '', '', '', static::$xmlns);
		
		return $voidObject;
	}
}
?>