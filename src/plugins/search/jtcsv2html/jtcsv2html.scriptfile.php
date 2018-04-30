<?php
/**
 * @package      Joomla.Plugin
 * @subpackage   Search.Jtcsv2html
 *
 * @author       Guido De Gobbis <support@joomtools.de>
 * @copyright    (c) 2018 JoomTools.de - All rights reserved.
 * @license      GNU General Public License version 3 or later
 */

defined('_JEXEC') or die('Restricted access');

class PlgSearchJtCsv2htmlInstallerScript
{
	/**
	 * Called after any type of action
	 *
	 * @param   string           $route   Which action is happening (install|uninstall|discover_install|update)
	 * @param   JAdapterInstance $adapter The object responsible for running this script
	 *
	 * @return  boolean  True on success
	 */
	public function postflight($route, JAdapterInstance $adapter)
	{

		// We only need to perform this if the extension is being installed, not updated
		if ($route == 'install')
		{
			$db = JFactory::getDbo();

			$conditions = array(
				array(
					$db->quoteName('enabled') . ' = ' . (int) 1,
					array(
						$db->quoteName('folder') . ' = ' . $db->quote('search'),
						$db->quoteName('element') . ' = ' . $db->quote('jtcsv2html'),
						$db->quoteName('type') . ' = ' . $db->quote('plugin')
					)
				),
				array(
					$db->quoteName('enabled') . ' = ' . (int) 0,
					array(
						$db->quoteName('folder') . ' = ' . $db->quote('search'),
						$db->quoteName('element') . ' = ' . $db->quote('content'),
						$db->quoteName('type') . ' = ' . $db->quote('plugin')
					)
				)
			);

			foreach ($conditions as $condition)
			{
				$query = $db->getQuery(true);
				$query->update($db->quoteName('#__extensions'))
					->set($condition[0])->where($condition[1]);
				$db->setQuery($query);
				$db->execute();
			}
		}
	}

	/**
	 * Called after any type of action
	 *
	 * @param   string           $route   Which action is happening (install|uninstall|discover_install|update)
	 * @param   JAdapterInstance $adapter The object responsible for running this script
	 *
	 * @return  boolean  True on success
	 */
	public function preflight($route, JAdapterInstance $adapter)
	{
		// We only need to perform this if the extension is being uninstalled
		if ($route == 'uninstall')
		{
			$db = JFactory::getDbo();

			$conditions = array(
				array(
					$db->quoteName('enabled') . ' = ' . (int) 1,
					array(
						$db->quoteName('folder') . ' = ' . $db->quote('search'),
						$db->quoteName('element') . ' = ' . $db->quote('jtcsv2html'),
						$db->quoteName('type') . ' = ' . $db->quote('plugin')
					)
				),
				array(
					$db->quoteName('enabled') . ' = ' . (int) 0,
					array(
						$db->quoteName('folder') . ' = ' . $db->quote('search'),
						$db->quoteName('element') . ' = ' . $db->quote('content'),
						$db->quoteName('type') . ' = ' . $db->quote('plugin')
					)
				)
			);

			foreach ($conditions as $condition)
			{
				$query = $db->getQuery(true);
				$query->update($db->quoteName('#__extensions'))
					->set($condition[0])->where($condition[1]);
				$db->setQuery($query);
				$db->execute();
			}
		}
	}
}
