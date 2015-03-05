<?php/*** @version		1.0.1* @package		DJ Select Menu* @subpackage	DJ Select Menu Module* @copyright	Copyright (C) 2010 DJ-Extensions.com LTD, All rights reserved.* @license		http://www.gnu.org/licenses GNU/GPL* @autor url    http://design-joomla.eu* @autor email  contact@design-joomla.eu* @Developer    Lukasz Ciastek - lukasz.ciastek@design-joomla.eu* * * DJ Select Menu Module is free software: you can redistribute it and/or modify* it under the terms of the GNU General Public License as published by* the Free Software Foundation, either version 3 of the License, or* (at your option) any later version.** DJ Select Menu Module is distributed in the hope that it will be useful,* but WITHOUT ANY WARRANTY; without even the implied warranty of* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the* GNU General Public License for more details.** You should have received a copy of the GNU General Public License* along with DJ Select Menu Module. If not, see <http://www.gnu.org/licenses/>.* */
defined ('_JEXEC') or die('Restricted access');
require_once dirname(__FILE__).'/helper.php';
$list	= modDJSelectMenuHelper::getList($params);
$app	= JFactory::getApplication();
$menu	= $app->getMenu();
$active	= $menu->getActive();
$active_id = isset($active) ? $active->id : $menu->getDefault()->id;
$path	= isset($active) ? $active->tree : array();

require(JModuleHelper::getLayoutPath('mod_djselectmenu'));
?>



