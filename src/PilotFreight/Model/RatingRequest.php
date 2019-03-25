<?php
namespace PilotFreight\Model;

/**
 * Primary Rating call request object
*/
class RatingRequest extends Request
{
	protected $data = [
		"tqsquoteid" => false,
		"quoteid" => false,
		"tariffid" => false,
		"scale" => false,
		"locationid" => false,
		"transportbyair" => false,
		"calculatebillcode" => false,
		"issavequote" => false,
		"iata_classifications" => false,
		"packingcontainers" => false,
		"declaredvalue" => false,
		"insurancevalue" => false,
		"cod" => false,
		"tariffname" => false,
		"notes" => false,
		"service" => false,
		"quotedate" => false,
		"chargeweight" => false,
		"totalpieces" => false,
		"shipper" => false,
		"consignee" => false,
		"lineitems" => false,
		"quote" => false,
		"shipdate" => false,
		"tariffheaderid" => false,
		"userid" => false,
		"quoteconfirmationemail" => false,
		"debrisremoval" => false,
		"gateway" => false,
		"isinternational" => false
	];
	
	/**
	 * Overriding default method
	 * @param Auth $auth
	 * @return string Returns a json object encodeed as a string for the request
	 */	
	public function prep(Auth $auth)
	{
		
		// first recursively go through and remove all "false" data
		// and turn into array
		
		// add the auth info
		$this->setLocationId($auth->getLocationId())->setTariffHeaderId($auth->getTariffHeaderId());
		
		$data = $this->toArray(true); // true means that it "prunes" it as it goes
		// then, json encode it
		$output = [
			'Rating' => $data
		];
		$o = json_encode($output);
		return $o;
	}
	
	
}
?>