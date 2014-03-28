<?php

require_once DIR . '/components/controller.php';

class PeerreviewController extends Controller
{
	public function admin() {

		require_once 'peerreview.lib.php';

		return parent::pluginview();
	}
}

?>