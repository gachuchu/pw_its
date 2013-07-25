<?php /*@charset "utf-8"*/
/*********************************************************************
 Plugin Name:   PW_Its
 Plugin URI:    http://syncroot.com/
 Description:   itunes storeリンクを適当に更新
 Author:        gachuchu
 Version:       1.0.0
 Author URI:    http://syncroot.com/
 *********************************************************************/

/*********************************************************************
 Copyright 2010 gachuchu  (email : syncroot.com@gmail.com)

 This program is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License
 along with this program; if not, write to the Free Software
 Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *********************************************************************/

require_once(WP_PLUGIN_DIR . "/libpw/libpw.php");

if(!class_exists('PW_Its')){
    /**
     *********************************************************************
     * 本体
     *********************************************************************/
    class PW_Its extends libpw_Plugin_Substance {
        //---------------------------------------------------------------------
        const UNIQUE_KEY = 'PW_Its';
        const CLASS_NAME = 'PW_Its';

        /**
         *====================================================================
         * 初期化
         *===================================================================*/
        public function init() {
            add_action('wp_print_scripts',      array(&$this, 'execute_wp_print_scripts'));
        }

        /**
         *====================================================================
         * スクリプト追加
         *===================================================================*/
        public function execute_wp_print_scripts() {
            if(!is_admin()){
                wp_enqueue_script('jquery',
                                  'http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js',
                                  array(),
                                  '1.9.0');

                wp_enqueue_script('jquery.pw_its',
                                  WP_PLUGIN_URL . '/' . plugin_basename(dirname(__FILE__)) . '/jquery.pw_its.js',
                                  array('jquery'),
                                  '1.0.0');
            }
        }
    }


    /**
     *********************************************************************
     * 初期化
     *********************************************************************/
    PW_Its::create(PW_Its::UNIQUE_KEY,
                   PW_Its::CLASS_NAME,
                   __FILE__);
}
