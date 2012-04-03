<?php

/**
 * Rah_custom_feed plugin for Textpattern CMS.
 *
 * @author Jukka Svahn
 * @date 2008-
 * @license GNU GPLv2
 * @link http://rahforum.biz/plugins/rah_custom_feed
 *
 * Requires Textpattern v4.2.0 or newer.
 *
 * Copyright (C) 2011 Jukka Svahn <http://rahforum.biz>
 * Licensed under GNU Genral Public License version 2
 * http://www.gnu.org/licenses/gpl-2.0.html
 */

	register_callback(array('rah_custom_feed', 'install'), 'plugin_lifecycle.rah_custom_feed');
	register_callback(array('rah_custom_feed', 'feed_item'), 'atom_entry');
	register_callback(array('rah_custom_feed', 'feed_item'), 'rss_entry');

class rah_custom_feed {
	
	/**
	 * Installer
	 * @param string $event Admin-side event.
	 * @param string $step Admin-side, plugin-lifecycle step.
	 */
	
	static public function install($event='', $step='') {
		
		if($step == 'deleted') {
			
			safe_delete(
				'txp_form',
				"name='rah_feed_body'"
			);
			
			return;
		}
		
		if(!safe_row('name', 'txp_form', "name='rah_feed_body'")) {
			safe_insert(
				'txp_form',
				"name='rah_feed_body', type='article', Form='<txp:body />'"
			);
		}
	}

	/**
	 * Modifies feeds excerpt and body content
	 */

	static public function feed_item() {
		global $thisarticle;
		@$form = fetch_form('rah_feed_body');
		
		if($form !== '') {
			$form = parse($form);
			$thisarticle['excerpt'] = $form;
			$thisarticle['body'] = $form;
		}
	}
}

?>