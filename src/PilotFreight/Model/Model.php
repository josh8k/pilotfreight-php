<?php

namespace PilotFreight\Model;

/**
 * Main data storage for request objects
 * The child classes will define the $data instance variable with their specific needs
 * Not going to put much commenting into the child classes because it's relatively straightforward
 * @author josh8k
 */
class Model
{
	protected $data = [];
	
	/**
	 * constructor
	 * @method __construct
	 * @return void
	 */
	public function __construct() {}
	
	public function __call($name, $args)
	{
		if (substr(strtolower($name), 0, 3) == "get")
		{
			$field = substr(strtolower($name), 3);
			if (isset($this->data[$field]))
			{
				return $this->data[$field];
			} // end if
		} // end if
		else if (substr(strtolower($name), 0, 3) == "set")
		{
			$field = substr(strtolower($name), 3);
			if (isset($this->data[$field]))
			{
				$this->data[$field] = $args[0];
				return $this;
			} // end if
		} // end if
		throw new \Exception("unknown method '" . $name . "'");
	} // end
	
	protected function getData()
	{
		return $this->data;
	}
	
	public function toArray($prune = false)
	{
		$output = [];
		foreach ($this->data as $key => $value)
		{
			if (is_array($value))
			{
				$inner = [];
				foreach ($value as $v1)
				{
					if (is_object($v1))
					{
						$inner[] = $v1->toArray($prune);
					}
					else if ($v1 !== false)
					{
						$inner[] = $v1;
					}
				}
				$output[$key] = $inner;
			}
			else
			{
				if (is_object($value))
				{
					$output[$key] = $value->toArray($prune);
				}
				else if ($value !== false)
				{
					$output[$key] = $value;
				}
			}
			
		}
		return $output;
	}
		
}
	
?>