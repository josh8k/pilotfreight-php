<?php
namespace PilotFreight;
/**
 * Rating
 *
 * @package PilotFreight
 * @class Rating
 * @extends AbstractConnection
 */
class Rating extends AbstractConnection
{
	protected $requestUrl = "https://www.pilotssl.com/pilotapi/v1/Ratings";
	protected static $responseClass = "PilotFreight\Model\RatingResponse";
	
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