<?php
namespace PilotFreight\Model;

class TrackRequest extends Request
{
	protected $data = ['trackingnumbers' => false];
	private static $defaultXmlTpl = '<?xml version="1.0" encoding="utf-8"?><PilotTrackingRequest><Validation><UserID>^USERNAME^</UserID><Password>^PASSWORD^</Password></Validation><APIVersion>^APIVERSION^</APIVersion>^TRACKING^</PilotTrackingRequest>';
	public function prep(Auth $auth)
	{
		// need to take all of this data and prep 
		$trackingNumbers = $this->getTrackingNumbers();
		if (!count($trackingNumbers))
		{
			throw new \Exception("No tracking numbers have been set for this request, cannot make request");
		} // end if
		
		$trackingXml = "";
		foreach ($trackingNumbers as $tracking)
		{
			$trackingXml .= "<TrackingNumber>" . $tracking . "</TrackingNumber>";
		}
		
		// put it all together
		$templateArray = [
			'^USERNAME^',
			'^PASSWORD^',
			'^APIVERSION^',
			'^TRACKING^'
		];
		$valuesArray = [
			$auth->getUserName(),
			$auth->getPassword(),
			$auth->getApiVersion(),
			$trackingXml
		];
		$requestXml = str_replace($templateArray, $valuesArray, static::$defaultXmlTpl);
		return $requestXml;
	}
}
?>