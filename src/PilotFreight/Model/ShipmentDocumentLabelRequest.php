<?php
namespace PilotFreight\Model;
use SoapVar;

class ShipmentDocumentLabelRequest extends ShipmentDocumentRequest
{
	/**
	 * Overrides parent version because the request is a little different because it's a SOAP call
	 * @param Auth $auth
	 * @return array Request params
	 */
	public function prep(Auth $auth)
	{
		$requestParams = parent::prep($auth);
		$requestParams->eLabelType = new SoapVar($this->getDocType(), XSD_STRING, '', '', '', static::$xmlns);
		return $requestParams;
	}
}
?>