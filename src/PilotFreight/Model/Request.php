<?php
namespace PilotFreight\Model;

abstract class Request extends Model
{
	/**
	 * adding this method which will be overriden by the child classes
	 * param Auth $auth
	 * @return void
	 */
	protected function prep(Auth $auth)
	{
		return '';
	}
}
?>