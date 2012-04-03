<?php

/**
 * Rah_custom_feed plugin for Textpattern CMS.
 *
 * @author Jukka Svahn
 * @date 2008-
 * @license GNU GPLv2
 * @link http://rahforum.biz/plugins/rah_custom_feed
 *
 * Copyright (C) 2011 Jukka Svahn <http://rahforum.biz>
 * Licensed under GNU Genral Public License version 2
 * http://www.gnu.org/licenses/gpl-2.0.html
 */

	register_callback('rah_custom_feed','atom_entry');
	register_callback('rah_custom_feed','rss_entry');

	if (@txpinterface == 'admin') {
		if(gps('event') == 'form' && safe_count('txp_form',"name='rah_feed_body'") == 0) {
			safe_insert('txp_form',"name='rah_feed_body', type='article', Form='<txp:body />'");
		}
	}

/**
 * Modifies feeds excerpt and body content
 */

	function rah_custom_feed() {
		global $thisarticle;
		@$form = fetch_form('rah_feed_body');
		
		if($form !== '') {
			$form = parse($form);
			$thisarticle['excerpt'] = $form;
			$thisarticle['body'] = $form;
		}
	}
?>