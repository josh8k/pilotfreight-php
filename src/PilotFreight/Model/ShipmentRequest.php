<?php
namespace PilotFreight\Model;

class ShipmentRequest extends Request
{
	protected $data = [
		"quoteid" => false,
		"locationid" => false,
		"transportbyair" => false,
		"iata_classifications" => false,
		"packingcontainers" => false,
		"declaredvalue" => false,
		"cod" => false,
		"tariffid" => false,
		"tariffname" => false,
		"tariffcode" => false,
		"notes" => false,
		"service" => false,
		"airtrakservicecode" => false,
		"tariffextension" => false,
		"quotedate" => false,
		"holdatairport" => false,
		"controlstation" => false,
		"pronumber" => false,
		"consigneeattn" => false,
		"thirdpartyauth" => false,
		"shipperref" => false,
		"consigneeref" => false,
		"deliverydate" => false,
		"amountdueconsignee" => false,
		"shipdate" => false,
		"oversized" => false,
		"paytype" => false,
		"pod" => false,
		"satdelivery" => false,
		"specialinstructions" => false,
		"readytime" => false,
		"closetime" => false,
		"homedelivery" => false,
		"shipmentid" => false,
		"lockdate" => false,
		"lockuser" => false,
		"lastupdate" => false,
		"addressid" => false,
		"platinum" => false,
		"isshipper" => false,
		"gbl" => false,
		"isinsurance" => false,
		"condition" => false,
		"packaging" => false,
		"tariffheaderid" => false,
		"productname" => false,
		"productdescription" => false,
		"debrisremoval" => false,
		"isscreeningconsent" => false,
		"emailbol" => false,
		"servicename" => false,
		"hazmat" => false,
		"hazmatnumber" => false,
		"hazmatclass" => false,
		"hazmatphone" => false,
		"isdistribution" => false,
		"deliverystarttime" => false,
		"airtrakquoteno" => false,
		"shipper" => false,
		"consignee" => false,
		"thirdparty" => false,
		"lineitem" => false,
		"quote" => false,
		"internationalservice" => false,
		"international" => false,
		"otherreferences" => false,
		"scheduleblines" => false,
		"shipmentcustomerinfo" => false
	];
	public function prep(Auth $auth)
	{
		// first recursively go through and remove all "false" data
		// and turn into array
		
		// add the auth info
		$this->setLocationId($auth->getLocationId())->setTariffHeaderId($auth->getTariffHeaderId())->setAddressId($auth->getAddressId())->setControlStation($auth->getControlStation());
		
		$data = $this->toArray(true); // true means that it "prunes" it as it goes
		// then, json encode it
		$output = [
			'Shipment' => $data
		];
		$o = json_encode($output);
		return $o;
	}
}
?>