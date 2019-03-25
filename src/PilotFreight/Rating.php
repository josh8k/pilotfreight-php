<?php
namespace PilotFreight;
/**
 * Rating
 * Used to retrieve the appropriate rates for a shipment, given all of the inputs
 *
 * @author josh8k
 */
class Rating extends AbstractConnection
{
	protected $requestUrl = "https://www.pilotssl.com/pilotapi/v1/Ratings";
	protected static $responseClass = "PilotFreight\Model\RatingResponse";
	

	/**
	* Overrides parent
	* @return void
	*
	*/
	protected function prepHeaders()
	{
		parent::prepHeaders();
		if ($this->auth->getApiKey() !== false)
		{
			$this->addHeader('api-key', $this->auth->getApiKey());
		}
	}
}
?>