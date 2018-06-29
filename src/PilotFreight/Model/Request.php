<?php
namespace PilotFreight\Model;

abstract class Request extends Model
{
	protected function prep(Auth $auth)
	{
		return '';
	}
}
?>