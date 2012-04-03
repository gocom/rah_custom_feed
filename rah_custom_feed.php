<?php	##################
	#
	#	rah_custom_feed-plugin for Textpattern
	#	version 0.1
	#	by Jukka Svahn
	#	http://rahforum.biz
	#
	###################

	register_callback('rah_custom_feed','atom_entry');
	register_callback('rah_custom_feed','rss_entry');

	if (@txpinterface == 'admin') {
		if(gps('event') == 'form' && safe_count('txp_form',"name='rah_feed_body'") == 0) {
			safe_insert('txp_form',"name='rah_feed_body', type='article', Form='<txp:body />'");
		}
	}

	function rah_custom_feed() {
		global $thisarticle;	
		$form = fetch_form('rah_feed_body');
		$form = parse($form);
		$thisarticle['excerpt'] = $form;
		$thisarticle['body'] = $form;
	}
?>