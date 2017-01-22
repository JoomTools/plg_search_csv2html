<?php
/**
 * @Copyright  JoomTools
 * @package    JT - Csv2Html - Plugin for Joomla! 3.x
 * @author     Guido De Gobbis
 * @link       http://www.joomtools.de
 *
 * @license    GNU/GPL v3 <http://www.gnu.org/licenses/>
 *             This program is free software: you can redistribute it and/or modify
 *             it under the terms of the GNU General Public License as published by
 *             the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
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
			$db     = JFactory::getDbo();
			$query  = $db->getQuery(true);

			$fields1 = $db->quoteName('enabled') . ' = ' . (int) 1;
			$fields2 = $db->quoteName('enabled') . ' = ' . (int) 0;

			$conditions1 = array(
				$db->quoteName('folder') . ' = ' . $db->quote('search'),
				$db->quoteName('element') . ' = ' . $db->quote('jtcsv2html'),
				$db->quoteName('type') . ' = ' . $db->quote('plugin')
			);

			$conditions2 = array(
				$db->quoteName('folder') . ' = ' . $db->quote('search'),
				$db->quoteName('element') . ' = ' . $db->quote('content'),
				$db->quoteName('type') . ' = ' . $db->quote('plugin')
			);

			$query->update($db->quoteName('#__extensions'))
				->set($fields1)->where($conditions1);

			$db->setQuery($query);
			$db->execute();

			$query1  = $db->getQuery(true);

			$query1->update($db->quoteName('#__extensions'))
				->set($fields2)->where($conditions2);

			$db->setQuery($query1);
			$db->execute();
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
			$db     = JFactory::getDbo();
			$query  = $db->getQuery(true);

			$fields1 = $db->quoteName('enabled') . ' = ' . (int) 0;
			$fields2 = $db->quoteName('enabled') . ' = ' . (int) 1;

			$conditions1 = array(
				$db->quoteName('folder') . ' = ' . $db->quote('search'),
				$db->quoteName('element') . ' = ' . $db->quote('jtcsv2html'),
				$db->quoteName('type') . ' = ' . $db->quote('plugin')
			);

			$conditions2 = array(
				$db->quoteName('folder') . ' = ' . $db->quote('search'),
				$db->quoteName('element') . ' = ' . $db->quote('content'),
				$db->quoteName('type') . ' = ' . $db->quote('plugin')
			);

			$query->update($db->quoteName('#__extensions'))
				->set($fields1)->where($conditions1);

			$db->setQuery($query);
			$db->execute();

			$query1  = $db->getQuery(true);

			$query1->update($db->quoteName('#__extensions'))
				->set($fields2)->where($conditions2);

			$db->setQuery($query1);
			$db->execute();
		}
	}
}
