<?phpdefined ('_JEXEC') or die('Restricted access');require_once dirname(__FILE__).'/helper.php';
$list	= modDJSelectMenuHelper::getList($params);
$app	= JFactory::getApplication();
$menu	= $app->getMenu();
$active	= $menu->getActive();
$active_id = isset($active) ? $active->id : $menu->getDefault()->id;
$path	= isset($active) ? $active->tree : array();

require(JModuleHelper::getLayoutPath('mod_djselectmenu'));
?>
