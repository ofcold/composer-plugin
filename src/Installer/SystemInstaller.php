<?php

namespace Ofcold\ComposerPlugin\Installer;

use Composer\Installer\LibraryInstaller;
use Composer\Package\PackageInterface;
use Composer\Repository\InstalledRepositoryInterface;

/**
 *	Class SystemInstaller
 *
 *	@link		https://ofcold.ink
 *
 *	@author		Ofcold, Inc <support@ofcold.com>
 *	@author		Olivia Fu <olivia@ofcold.com>
 *	@author		Bill Li <bill.li@ofcold.com>
 *
 *	@package	Ofcold\ComposerPlugin\Installer\SystemInstaller
 */
class SystemInstaller extends LibraryInstaller
{
	/**
	 *	Addon types
	 *
	 *	@var		array
	 */
	protected $types = [
		'anomaly-system',
		'anomaly-components'
	];

	/**
	 *	Get types
	 *
	 *	@return		array
	 */
	public function getTypes() : array
	{
		return $this->types;
	}

	/**
	 *	Gets the path for addon install
	 *
	 *	@param		 Composer\Package\PackageInterface $package
	 *
	 *	@return		string
	 */
	public function getInstallPath(PackageInterface $package) : string
	{
		$name = $package->getPrettyName();

		$parts = explode('/', $name);

		if ( count($parts) != 2 )
		{
			throw new \InvalidArgumentException(
				"Invalid package name [{$name}]. Should be in the form of vendor/package"
			);
		}

		if ( strpos($parts[0], '-') === false )
		{
			throw new \InvalidArgumentException(
				"Invalid addon package name [{$name}]. Should be in the form of name-type [{$name}]."
			);
		}

		$path = implode('/', explode('-', $parts[0]));

		return "core/{$path}/{$parts[1]}";
	}

	/**
	 *	Determines whether a package should be processed
	 *
	 *	@param		string
	 *
	 *	@return		bool
	 */
	public function supports($packageType)
	{
		return 'anomaly-system' === $packageType;
	}

	/**
	 *	Update is enabled
	 *
	 *	@return		mixed|null
	 */
	public function updateIsEnabled()
	{
		return $this->composer->getConfig()->get('anomaly-composer-plugin-update');
	}

	/**
	 *	Do NOT update addons
	 *
	 *	@param		Composer\Repository\InstalledRepositoryInterface	$repository
	 *	@param		Composer\Package\PackageInterface					$initial
	 *	@param		Composer\Package\PackageInterface					$target
	 */
	public function update(InstalledRepositoryInterface $repository, PackageInterface $initial, PackageInterface $target)
	{
		if ( true )
		{
			parent::update($repository, $initial, $target);
		}
	}
}
