<?php
namespace PilotFreight\Model;

/**
 * @author josh8k
 */
abstract class AbstractResponse
{
	protected $rawResponse = null;
	protected $response = [];
	
	/**
	 * constructor Will be overriden as necesarry by child classes
	 */
	public function __construct() {}
	
	/**
	 * @param array $rawResponseData Array of relevant raw response data from the API call
	 * @return Model\AbstractResponse
	 */
	public function setRawResponse($rawResponseData)
	{
		$this->rawResponse = $rawResponseData;
		return $this;
	}
	
	/**
	 * @param array $rawResponseData Array of relevant raw response data from the API call
	 * @return Model\AbstractResponse Uses late static binding to return the actual child object instance
	 */
	public static function create(array $rawResponseData)
	{
		$obj = new static();
		$obj->setRawResponse($rawResponseData)->parse();
		return $obj;
	}
	
	/**
	 * Include this so that the child classes can define it
	 */
	protected function parse() {}
	
	/**
	 * @return Model\AbstractResponse Child class instance
	 */
	public function get()
	{
		return $this->response;
	}
}
?>