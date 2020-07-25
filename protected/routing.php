<?php 
if(!array_key_exists('P', $_GET) || empty($_GET['P']))
$_GET['P'] = 'login';

switch ($_GET['P'])
{
    case 'page':  IsUserLoggedIn() ? require_once PROTECTED_DIR.'page.php' : header('Location: index.php'); break;
    case 'raklap':  IsUserLoggedIn() ? require_once PROTECTED_DIR.'raklap.php' : header('Location: index.php');break;
    case 'napi':  IsUserLoggedIn() ? require_once PROTECTED_DIR.'napi.php' : header('Location: index.php'); break;
    case 'havi': IsUserLoggedIn() ? require_once PROTECTED_DIR.'havi.php' : header('Location: index.php'); break;
    case 'osszes': IsUserLoggedIn() ? require_once PROTECTED_DIR.'osszes.php' : header('Location: index.php'); break;
    case 'csoport': IsUserLoggedIn() ? require_once PROTECTED_DIR.'csoport.php' : header('Location: index.php');break;
    case 'logout': IsUserLoggedIn() ? UserLogout() : header('Location: index.php'); break;
    case 'login': !(IsUserLoggedIn()) ? require_once PROTECTED_DIR.'login.php' : header('Location: ?P=page');break;
    default: require_once PROTECTED_DIR.'404.php'; break;
}




?>