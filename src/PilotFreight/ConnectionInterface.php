<?php
	
namespace PilotFreight;

interface ConnectionInterface
{
	
	public function __construct(Model\Auth $auth);
	
	public function send(Model\Request $request);
	
	public function getLastRequest();
	
	public function getLastResponse();
}
?>