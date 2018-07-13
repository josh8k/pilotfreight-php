<?php
namespace PilotFreight\Model;

abstract class AbstractResponse
{
	protected $rawResponse = null;
	protected $response = [];
	public function __construct() {}
	
	public function setRawResponse($raw_response_data)
	{
		$this->rawResponse = $raw_response_data;
		return $this;
	}
	
	// raw_response_data is array w/ statusCode and body
	public static function create(array $raw_response_data)
	{
		$obj = new static();
		$obj->setRawResponse($raw_response_data)->parse();
		return $obj;
	}
	
	protected function parse() {}
	
	public function get()
	{
		return $this->response;
	}
}
?>