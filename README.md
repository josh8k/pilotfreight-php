# pilotfreight-php
PHP Client for Pilot Freight REST (and sometimes SOAP) API

## Installation

Install using composer. However, for now, you need to do it by adding the repository directly to your composer.json file.

```
"repositories": [
	{
		"type": "vcs",
	 	"url": "https://github.com/josh8k/pilotfreight-php"
	 }
 ]
```

and then this to the require section:
```
"josh8k/pilotfreight-php": "dev-master"
```

But in the future, this will be added to packagist for easier install.

## Methods

- Rating
- Track
- Shipment
- Void
- ShipmentDocument
- ShipmentDocumentCached (not really needed as much)

## Examples

Add Auth Information (needed for all uses):
```
require 'vendor/autoload.php';
$auth = new \PilotFreight\Model\Auth;

// fill in values from config file (assuming those values have been imported into a variable called $config)
$auth
	->setApiKey($config['apiKey'])
	->setPassword($config['password'])
	->setApiVersion($config['apiversion'])
	->setTariffHeaderId($config['tariffHeaderId'])
	->setLocationId($config['locationId'])
	->setUserName($config['username'])
	->setControlStation($config['controlStation'])
	->setAddressId($config['addressId']);
		
```

Rating:
```
// create rating object
$rating = new \PilotFreight\Rating($auth);

// prep the request itself
$request = new \PilotFreight\Model\RatingRequest;

// prep the shipper data
$shipper = new \PilotFreight\Model\Shipper;
$shipper->setZipcode($ship_zipcode)
	->setState($ship_state)
	->setCity($ship_city);
	
// consignee
$consignee = new \PilotFreight\Model\Consignee;
$consignee->setZipcode($consignee_zip)
	->setState($consignee_state)
	->setCity($consignee_city);
	
// set line items
$lineItemsList = [];
for ($package_idx = 0; $package_idx < count($package_array); $package_idx++)
{
	$lineItems = new \PilotFreight\Model\LineItems;
	$lineItems->setLength(floor($package_array[$package_idx]['length']))
		->setWidth(floor($package_array[$package_idx]['width']))
		->setHeight(floor($package_array[$package_idx]['height']))
		->setWeight(floor($package_array[$package_idx]['weight']))
		->setPieces(1)
		->setDescription("Package " . ($package_idx+1));
	$lineItemsList[] = $lineItems;
}

// set the request
$request->setShipper($shipper)
	->setConsignee($consignee)
	->setLineItems($lineItemsList)
	->setDeclaredValue($declared_value)
	->setShipDate(date('c'));

// then make the call
$response = $rating->send($request);

// now, get the quote response and parse it from there
$ratingResponse = $response->get();

```

Tracking:
```
$track = new \PilotFreight\Track($auth);

// next, prep the request
$request = new \PilotFreight\Model\TrackRequest;

// assuming the tracking number variable has already been set. Can pass more than one tracking number to get multiple at once
$request->setTrackingNumbers([$trackingNumber]);

// lastly, make request
$trackResult = $track->send($request);

// based on what we get back, we need to format it in a useful way
$response = $trackResult->get();
```

## TODO
1. More Examples
2. Improved Error Handling
last updated: 7-18-18
