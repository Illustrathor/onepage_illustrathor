<?php
session_start();

if(isset($_GET['locale']))
{
  switch($_GET['locale']) {
    case 'fr':
      $_SESSION['locale'] = 'fr';
      break;
    case 'en':
      $_SESSION['locale'] = 'en';
      break;
    default:
      $_SESSION['locale'] = 'fr';
      break;
  }
}


$locale = $_SESSION['locale'] ?? 'fr';
require 'translations/'. $locale .'.php';
?>
