<?php
namespace Craft;

class CacheBusterService extends BaseApplicationComponent
{
	public function bustThatCache($string, $name = 'v=')
	{

		$separator = '?' . $name;
		$rootPath  = $_SERVER['DOCUMENT_ROOT'];
		$filePath  = realpath($rootPath . $string);

		if (! is_file($filePath))
		{
			return $string;
		}

		$time = filemtime($filePath);

		if ($time !== FALSE)
		{
			$string .= $separator . $time;
		}

		return $string;
	}
}