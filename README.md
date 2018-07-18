# pilotfreight-php
PHP Client for Pilot Freight REST API

## Installation

Install using composer. However, for now, you need to do it by adding the repository (add this to your composer.json file)

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
- ShipmentDocumentCached

## Examples

```
require 'vendor/autoload.php';
$auth = new \PilotFreight\Model\Auth;

// fill in the auth variables


```

## TODO
1. Documentation
3. Commenting

last updated: 7-18-18
