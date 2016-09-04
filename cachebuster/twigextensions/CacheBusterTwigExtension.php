<?php
namespace Craft;

use Twig_Extension;
use Twig_Filter_Method;
use Twig_Function_Method;

class CacheBusterTwigExtension extends \Twig_Extension
{

	public function getName()
	{
		return 'Cache Buster';
	}


	public function getFilters()
	{
		return array(
			'cacheBuster' => new Twig_Filter_Method($this, 'cacheBuster'),
		);
	}

	public function getFunctions()
	{
		return array(
			'cacheBuster' => new Twig_Function_Method($this, 'cacheBuster'),
		);
	}

	public function cacheBuster($string, $name = 'v=')
	{
		return craft()->cacheBuster->bustThatCache($string, $name);
	}
}