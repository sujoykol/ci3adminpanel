<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Custom CSRF Helper for CodeIgniter 3
 */

if (!function_exists('csrf_field')) {
    /**
     * Generates a hidden input field with the CSRF token
     * Usage: <?= csrf_field(); ?>
     */
    function csrf_field() {
        $ci =& get_instance();
        $name = $ci->security->get_csrf_token_name();
        $hash = $ci->security->get_csrf_hash();
        
        return '<input type="hidden" name="' . $name . '" value="' . $hash . '" style="display:none;">';
    }
}

if (!function_exists('csrf_token')) {
    /**
     * Returns the current CSRF hash value
     * Useful for AJAX headers or JSON responses
     */
    function csrf_token() {
        $ci =& get_instance();
        return $ci->security->get_csrf_hash();
    }
}
