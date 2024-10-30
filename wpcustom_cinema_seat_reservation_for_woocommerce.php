<?php
/**
 * Plugin Name: Cinema Seat Reservation for WooCommerce
 * Plugin URI: https://wpcustom.ca/cinema-seat-reservation-for-woocommerce/
 * Description: Cinema Seat Reservation For WooCommerce
 * Author: Wpcustom.ca
 * Author URI: https://wpcustom.ca/
 * GitHub Plugin https://github.com/Wpcustomca/Cinema-Seat-Reservation-For-Woocommerce.git
 * Domain Path: /languages/
 * Text Domain: cinema-seat-reservation
 * Version: 2.2.2
 * License: GPL v2 or later
 * Stable tag: 2.2.2
 * License URI: https://wpcustom.ca/license
 * Tags: Cinema Seat Reservation For WooCommerce,Booking Seats For WooCommerce, Online Seats booking , Seats book, booking Seats
 * @package WPCustomCinemaSeatReservation
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class WPCustom_Cinema_Seat_Reservation_for_WooCommerce {

    const VERSION = '2.2.2';
    const TEXT_DOMAIN = 'cinema-seat-reservation'; // Change this to your actual text domain

    /**
     * Constructor to initialize the plugin.
     */
    public function __construct() {
        // Check if WooCommerce is active
        if ($this->is_woocommerce_active()) {
            $this->setup_actions();
        } else {
            // Display notice if WooCommerce is not active
            add_action('admin_notices', array($this, 'woocommerce_not_active_notice'));

            // Deactivate the plugin
            add_action('admin_init', array($this, 'deactivate_plugin'));
        }
    }

    /**
     * Setup actions and hooks for the plugin.
     */
    private function setup_actions() {
        // Register activation, deactivation, and uninstall hooks
        register_activation_hook(__FILE__, array($this, 'activate'));
        register_deactivation_hook(__FILE__, array($this, 'deactivate'));
        register_uninstall_hook(__FILE__, array(__CLASS__, 'uninstall')); // Use __CLASS__ for static method

        // Include additional files
        $this->include_additional_files();
    }

    /**
     * Include additional files required by the plugin.
     */
    private function include_additional_files() {
        require_once(dirname(__FILE__) . "/wpcustom_cinema_seat_reservation_for_woocommerce_setting_page.php");
        require_once(dirname(__FILE__) . "/wpcustom_cinema_seat_reservation_for_woocommerce_functions.php");
    }

    /**
     * Activation hook callback - used for setting up the plugin on activation.
     */
    public function activate() {
        global $wpdb;

        // Define table name and charset collate
        $table_name = $wpdb->prefix . "wpcustom_booking_seat";
        $charset_collate = $wpdb->get_charset_collate();

        // SQL query for creating the database table
        $sql = "CREATE TABLE IF NOT EXISTS $table_name (
            id mediumint(9) NOT NULL AUTO_INCREMENT,
            pro_id mediumint(9) NOT NULL,
            pro_value VARCHAR(255) NOT NULL,
            booking_date DATE NOT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";

        // Include necessary upgrade script
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

        // Execute the database query
        dbDelta($sql);
    }

    /**
     * Deactivation hook callback - used for actions on deactivation.
     */
    public function deactivate() {
        // Deactivation code goes here
    }

    /**
     * Uninstall hook callback - used for actions on uninstallation.
     */
    public static function uninstall() {
        // Uninstall code goes here
    }

    /**
     * Check if WooCommerce is active.
     *
     * @return bool Whether WooCommerce is active.
     */
    private function is_woocommerce_active() {
        return in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')));
    }

    /**
     * Display a notice if WooCommerce is not active.
     */
    public function woocommerce_not_active_notice() {
        ?>
        <div class="notice notice-error is-dismissible">
            <p><?php esc_html_e('Cinema Seat Reservation for WooCommerce requires WooCommerce to be active. Please activate WooCommerce.','cinema-seat-reservation'); ?></p>
        </div>
        <?php
    }

    /**
     * Deactivate the plugin and display a notice.
     */
    public function deactivate_plugin() {
        deactivate_plugins(plugin_basename(__FILE__));
        add_action('admin_notices', array($this, 'plugin_deactivated_notice'));
    }

    /**
     * Display a notice after the plugin is deactivated.
     */
    public function plugin_deactivated_notice() {
        ?>
        <div class="notice notice-error is-dismissible">
            <p><?php esc_html_e('Cinema Seat Reservation for WooCommerce has been deactivated because WooCommerce is not active.','cinema-seat-reservation'); ?></p>
        </div>
        <?php
    }
}

// Initialize the Seat Reservation plugin
new WPCustom_Cinema_Seat_Reservation_for_WooCommerce();
