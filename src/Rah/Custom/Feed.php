<?php

/*
 * rah_custom_feed - Customized RSS and Atom feeds for Textpattern CMS
 * https://github.com/gocom/rah_custom_feed
 *
 * Copyright (C) 2019 Jukka Svahn
 *
 * This file is part of rah_custom_feed.
 *
 * rah_custom_feed is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation, version 2.
 *
 * rah_custom_feed is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with rah_custom_feed. If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Plugin class.
 */
final class Rah_Custom_Feed
{
    /**
     * Form name.
     */
    private const FORM_NAME = 'rah_feed_body';

    /**
     * Constructor.
     */
    public function __construct()
    {
        register_callback([$this, 'install'], 'plugin_lifecycle.rah_custom_feed', 'installed');
        register_callback([$this, 'item'], 'atom_entry');
        register_callback([$this, 'item'], 'rss_entry');
    }

    /**
     * Installer.
     */
    public function install(): void
    {
        create_form(self::FORM_NAME, 'misc', '');
    }

    /**
     * Invoked on every feed item.
     */
    public function item(): void
    {
        global $thisarticle;

        if (fetch_form(self::FORM_NAME) === false) {
            return;
        }

        $form = parse_form(self::FORM_NAME);
        $thisarticle['excerpt'] = $form;
        $thisarticle['body'] = $form;
    }
}
