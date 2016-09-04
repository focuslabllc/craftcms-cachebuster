<?php
namespace Craft;

class CacheBusterVariable
{
	public function bust($string, $name = 'v=')
	{
		return craft()->cacheBuster->bustThatCache($string, $name);
	}
}