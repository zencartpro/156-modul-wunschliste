<?php 
if (!zen_is_logged_in()) {
$_SESSION['navigation']->set_snapshot();
zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
}

// Get wishlist class and instantiate
require_once(DIR_WS_CLASSES . 'un_wishlist.php');
$oWishlist = new un_wishlist($_SESSION['customer_id']);

// Use specified wishlist if wid set, else use default wishlist
$id = isset($_REQUEST['wid']) ? (int) $_REQUEST['wid'] : '';
if ( ! un_is_empty($id) ) {
	$oWishlist->setWishlistId($id);
	
} else {
	$id = $oWishlist->getDefaultWishlistId();
}

require(DIR_WS_MODULES . 'require_languages.php');
$breadcrumb->add(NAVBAR_TITLE);