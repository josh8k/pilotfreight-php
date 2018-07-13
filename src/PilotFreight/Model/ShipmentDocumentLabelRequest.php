<?php
namespace PilotFreight\Model;
use SoapVar;

class ShipmentDocumentLabelRequest extends ShipmentDocumentRequest
{
	
	public function prep(Auth $auth)
	{
		$requestParams = parent::prep($auth);
		$requestParams->eLabelType = new SoapVar($this->getDocType(), XSD_STRING, '', '', '', static::$xmlns);
		return $requestParams;
	}
}
?>