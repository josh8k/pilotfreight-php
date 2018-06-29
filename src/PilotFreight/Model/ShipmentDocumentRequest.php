<?php
namespace PilotFreight\Model;

class ShipmentDocumentRequest extends Request
{
	protected $data = [
		"hawb" => false,
		"zipcode" => false,
		"doctype" => false
	];
}
?>