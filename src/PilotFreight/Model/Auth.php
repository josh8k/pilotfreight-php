<?php

namespace PilotFreight\Model;

/**
 * @author josh8k
 */
class Auth extends Model
{
	
	protected $data =
	[
		'env' => 'dev',
		'username' => false,
		'password' => false,
		'locationid' => false,
		'addressid' => false,
		'controlstation' => false,
		'tariffheaderid' => false,
		'apiversion' => false,
		'apikey' => false
	];
	
}
	
?>