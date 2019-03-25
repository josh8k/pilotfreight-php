<?php
namespace PilotFreight\Model;

/**
 * Primary request object for Shipment call
 * Contains important constants for use in making the Shipment call
 */
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
	
	// set some constants
	const PAYMENT_TYPE_THIRD_PARTY = 'T';
	const PAYMENT_TYPE_PREPAID = 'P';
	const PAYMENT_TYPE_COLLECT = 'C';
	
	const SERVICE_TYPE_BASIC = 'BA';
	const SERVICE_TYPE_BASIC_SIG_RELEASE = 'BR';
	const SERVICE_TYPE_DELUXE = 'DE';
	const SERVICE_TYPE_PREMIER = 'PR';
	const SERVICE_TYPE_STANDARD_ONE = 'S1';
	const SERVICE_TYPE_STANDARD_TWO = 'S2';
	const SERVICE_TYPE_FIRST_FLIGHT = 'NF';
	const SERVICE_TYPE_NEXT_AM = '18';
	const SERVICE_TYPE_NEXT_PM = '24';
	const SERVICE_TYPE_TWO_DAY = '48';
	const SERVICE_TYPE_THREE_DAY = '66';
	const SERVICE_TYPE_ECONOMY = '72';
	
	/**
	 * @param Auth $auth
	 * @return string Returns json object encoded as string
	 */
	public function prep(Auth $auth)
	{
		// first recursively go through and remove all "false" data
		// and turn into array
		
		// add the auth info
		$this->setLocationId($auth->getLocationId())
			->setTariffHeaderId($auth->getTariffHeaderId())
			->setAddressId($auth->getAddressId())
			->setControlStation($auth->getControlStation());
		
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