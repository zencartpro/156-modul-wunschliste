<?php
/**
 * @package Wishlist
 * @copyright Copyright 2003-2019 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart-pro.at/license/2_0.txt GNU Public License V2.0
 * @version $Id: wishlists.php 2019-09-16 19:13:51Z webchills $
 */  

	// Includes
  require('includes/application_top.php');
	require_once(DIR_WS_CLASSES . 'wishlist_class.php');
  
  // Instantiate
	$oWishlist = new un_wishlist();
  
  // Process action
  $action = (isset($_GET['action']) ? $_GET['action'] : '');
  if (zen_not_null($action)) {
    switch ($action) {
      case 'delete':
      	$oWishlist->deleteWishlist($_GET['wid']);
        break;
    }
  }
  
  // Get records
	$records = $oWishlist->getWishlists();
	
?><!doctype html>
<html <?php echo HTML_PARAMS; ?>>
  <head>
    <meta charset="<?php echo CHARSET; ?>">
    <title><?php echo TITLE; ?></title>
    <link rel="stylesheet" href="includes/stylesheet.css">
    <link rel="stylesheet" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
    <script src="includes/menu.js"></script>
    <script src="includes/general.js"></script>

    <script>
      function init() {
          cssjsmenu('navbar');
          if (document.getElementById) {
              var kill = document.getElementById('hoverJS');
              kill.disabled = true;
          }
      }
    </script>
    
  </head>
<body onLoad="init()" >
      <!-- header //-->
      <?php require(DIR_WS_INCLUDES . 'header.php'); ?>
      <!-- header_eof //-->
      <div class="container-fluid">
        <!-- body //-->

<h1><?php echo HEADING_TITLE; ?></h1>

<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr class="dataTableHeadingRow">
		<td class="dataTableHeadingContent"><?php echo TABLE_HEADING_CUSTOMER; ?></td>
		<td class="dataTableHeadingContent"><?php echo TABLE_HEADING_WISHLIST; ?></td>
		<td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_COUNT; ?></td>
		<td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
	</tr>
              
<?php if ( $records->RecordCount() > 0 ) { ?>

<?php while (!$records->EOF) { ?>
	<tr>
		<td class="dataTableContent"><?php echo un_get_fullname($records->fields['customers_firstname'], $records->fields['customers_lastname'], $records->fields['customers_email_address']); ?></td>
		<td class="dataTableContent"><a href="<?php echo zen_href_link(FILENAME_WISHLIST, 'wid=' . $records->fields['id']);?>"><?php echo $records->fields['name']; ?></a></td>
		<td class="dataTableContent" align="right"><?php echo $records->fields['items_count']; ?></td>
		<td class="dataTableContent" align="right">
			<a href="<?php echo zen_href_link(FILENAME_WISHLISTS, 'wid=' . $records->fields['id'] . '&action=delete'); ?>" onclick="javascript:return confirm('Wollen Sie diesen Eintrag wirklich löschen?')"><?php echo zen_image(DIR_WS_IMAGES . 'icon_delete.gif', ICON_DELETE); ?></a>
		</td>
	</tr>
	<?php $records->MoveNext(); ?>
<?php } ?>

<?php } else { ?>
	<tr>
		<td class="dataTableContent" colspan="99"><?php echo TEXT_NO_RECORDS; ?></td>
	</tr>
<?php } ?>


</table>
        
        
<!-- body_text_eof //-->
      </div>
      <!-- body_eof //-->
      <!-- footer //-->
  <?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
      <!-- footer_eof //-->
    </body>
  </html>