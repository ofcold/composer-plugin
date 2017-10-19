<?php

namespace Anomaly\AddnsComposerPlugin;

use Composer\Composer;
use Composer\Installer\InstallationManager;
use Composer\Installer\LibraryInstaller;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;

/**
 *	Plugin
 *
 *	@link		https://anomalylab.org
 *	@author		Anomaly lab, Inc <support@anomalylab.org>
 *	@author		Bill Li <bill@anomalylab.org>
 */
class Plugin implements PluginInterface
{

	/**
	 *	Installers
	 *
	 *	@var		array
	 */
	protected $installers = [
		'AddonInstaller',
		'SystemInstaller'
	];

	/**
	 *	Activate plugin
	 *
	 *	@param		Composer		$composer
	 *	@param		IOInterface		$IOInterface
	 */
	public function activate(Composer $composer, IOInterface $io)
	{
		/** @var $installationManager InstallationManager */
		$installationManager = $composer->getInstallationManager();

		foreach ( $this->installers as $class )
		{
			$installationManager->addInstaller($this->getInstaller($class, $composer, $io));
		}
	}

	/**
	 *	Get Library Installer
	 *
	 *	@param		string			$class
	 *	@param		Composer		$composer
	 *	@param		IOInterface		$io
	 *
	 *	@return		LibraryInstaller
	 */
	public function getInstaller(string $class, Composer $composer, IOInterface $io)
	{
		$installer = __NAMESPACE__ . '\\Installer\\' . $class;
		return new $installer($io, $composer);
	}

}
