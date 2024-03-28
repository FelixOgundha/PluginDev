<?php

/*
    Plugin Name: Our Test Plugin
    Description: A truly amazing plugin
    Version: 1.0
    Author: Felix Ogundha
    Author URI: https://www.felix.co.ke/user/bradchiff
*/

class WordCountAndTimePlugin {
    function __construct(){
        add_action('admin_menu',array($this,'adminPage'));
        add_action('admin_init',array($this,'settings'));
    }

    function settings(){
        add_settings_section('wcp_first_section',null,null,'word-count-settings');
        add_settings_field('wcp_location','Display Location',array($this,'locationHtml'),'word-count-settings','wcp_first_section');
        register_setting('wordcountplugin','wcp_location',array('sanitize_callback'=>'sanitize_text_field','default'=>'0'));
    }

    function adminPage(){
        add_options_page('word count settings','word count','manage_options','word-count-settings',array($this,'ourHtml'));
    }
    
    function locationHtml(){ ?>
           <select name="wcp_location" >
                <option value="0" <?php selected(get_option('wcp_location'),'0')?> >Begining of post</option>
                <option value="1" <?php selected(get_option('wcp_location'),'1')?>>End of post</option>
           </select>
   <?php }
    
    function ourHtml(){?>
        <div class="wrap">
            <h1>Word Count Settings</h1>
            <form action="options.php" method="POST">
                <?php
                    settings_fields('wordcountplugin');  
                    do_settings_sections('word-count-settings');
                    submit_button();
                ?>
            </form>
        </div>
    <?php }

    
}

$wordCountAndTimePlugin = new WordCountAndTimePlugin();




