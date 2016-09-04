<?php

namespace Craft;

class CacheBusterPlugin extends BasePlugin
{
	public function getName()
	{
		return Craft::t('Cache Buster');
	}

	public function getVersion()
	{
		return '1.0.0';
	}

	public function getDeveloper()
	{
		return 'Focus Lab';
	}

	public function getDeveloperUrl()
	{
		return 'http://focuslabllc.com';
	}

	public function getDocumentationUrl() {
		return 'https://github.com/focuslabllc/craftcms-cachebuster/blob/master/readme.md';
	}

	public function getReleaseFeedUrl() {
		return 'https://raw.githubusercontent.com/focuslabllc/craftcms-cachebuster/master/changelog.json';
	}

	public function hasCpSection()
	{
		return false;
	}

	public function addTwigExtension()
	{
		Craft::import('plugins.cachebuster.twigextensions.CacheBusterTwigExtension');
		return new CacheBusterTwigExtension();
	}
}