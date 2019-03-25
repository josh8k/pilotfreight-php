<?php
namespace PilotFreight;

/**
* @author josh8k
*/
interface ConnectionInterface
{
	public function __construct(Model\Auth $auth);
	public function send(Model\Request $request);
	public function getLastRequest();
	public function getLastResponse();
}
?>