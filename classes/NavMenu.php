<?php
/**
 * Nav menu options controller for Kavro Framework.
 *
 * Adds Kavro fields to each WordPress Appearance -> Menus item and stores the
 * values as one post-meta array on the `nav_menu_item` post object. This keeps
 * menu item metadata grouped and easy to retrieve from themes/plugins.
 *
 * @package Kavro\Core
 */

namespace Kavro;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * NavMenu
 *
 * Provides KAVRO::createNavMenuOptions() support.
 */
class NavMenu {
    /** @var string Unique nav menu meta key. */
    protected $unique;

    /** @var array Nav menu option arguments. */
    protected $args;

    /** @var array Section definitions assigned to menu item options. */
    protected $sections;

    /**
     * Register nav menu hooks.
     *
     * @param string $unique   Unique option ID and menu item meta key.
     * @param array  $args     Nav menu option arguments.
     * @param array  $sections Field sections.
     */
    public function __construct( $unique, $args, $sections ) {
        $this->unique   = sanitize_key( $unique );
        $this->args     = wp_parse_args(
            $args,
            array(
                'title'      => __( 'Kavro Menu Options', 'kavro-framework' ),
                'capability' => 'edit_theme_options',
            )
        );
        $this->sections = is_array( $sections ) ? $sections : array();

        add_action( 'wp_nav_menu_item_custom_fields', array( $this, 'render_menu_item_fields' ), 10, 5 );
        add_action( 'wp_update_nav_menu_item', array( $this, 'save_menu_item_fields' ), 10, 3 );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
    }

    /**
     * Enqueue Kavro assets on Appearance -> Menus.
     *
     * @param string $hook Current admin hook suffix.
     * @return void
     */
    public function enqueue_assets( $hook ) {
        if ( 'nav-menus.php' !== $hook ) {
            return;
        }

        wp_enqueue_media();
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_style( 'dashicons' );
        wp_enqueue_style( 'kavro-admin', KAVRO_URL . 'assets/css/admin.css', array( 'wp-color-picker' ), KAVRO_VERSION );
        wp_enqueue_script( 'kavro-admin', KAVRO_URL . 'assets/js/admin.js', array( 'jquery', 'wp-color-picker', 'jquery-ui-sortable' ), KAVRO_VERSION, true );
    }

    /**
     * Render Kavro fields inside each nav menu item editor.
     *
     * @param int      $item_id Menu item post ID.
     * @param \WP_Post $item    Menu item object.
     * @param int      $depth   Menu item depth.
     * @param array    $args    Menu arguments.
     * @param int      $id      Navigation menu ID.
     * @return void
     */
    public function render_menu_item_fields( $item_id, $item, $depth, $args, $id ) {
        if ( ! current_user_can( $this->args['capability'] ) ) {
            return;
        }

        $item_id = absint( $item_id );
        $values  = get_post_meta( $item_id, $this->unique, true );
        $values  = is_array( $values ) ? $values : array();
        $name    = $this->unique . '[' . $item_id . ']';

        wp_nonce_field( 'kavro_save_nav_menu_' . $this->unique, 'kavro_nav_menu_nonce_' . $this->unique );

        echo '<div class="kavro-nav-menu-options kavro-card">';
        echo '<div class="kavro-metabox-heading">';
        echo '<h4>' . esc_html( $this->args['title'] ) . '</h4>';
        echo '<p>' . esc_html__( 'Extra settings saved for this individual menu item.', 'kavro-framework' ) . '</p>';
        echo '</div>';

        foreach ( $this->sections as $section ) {
            echo '<div class="kavro-nav-menu-section">';

            if ( ! empty( $section['title'] ) ) {
                echo '<div class="kavro-section-mini-title">' . esc_html( $section['title'] ) . '</div>';
            }

            if ( ! empty( $section['fields'] ) && is_array( $section['fields'] ) ) {
                foreach ( $section['fields'] as $field ) {
                    $field_id = isset( $field['id'] ) ? sanitize_key( $field['id'] ) : '';
                    $value    = $field_id && array_key_exists( $field_id, $values ) ? $values[ $field_id ] : ( $field['default'] ?? '' );
                    Fields::render( $field, $value, $name );
                }
            }

            echo '</div>';
        }

        echo '</div>';
    }

    /**
     * Save Kavro fields for each nav menu item.
     *
     * @param int   $menu_id         Navigation menu ID.
     * @param int   $menu_item_db_id Menu item post ID.
     * @param array $args            Menu item arguments from WordPress.
     * @return void
     */
    public function save_menu_item_fields( $menu_id, $menu_item_db_id, $args ) {
        $nonce_key = 'kavro_nav_menu_nonce_' . $this->unique;

        if ( empty( $_POST[ $nonce_key ] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST[ $nonce_key ] ) ), 'kavro_save_nav_menu_' . $this->unique ) ) {
            return;
        }

        if ( ! current_user_can( $this->args['capability'] ) ) {
            return;
        }

        $menu_item_db_id = absint( $menu_item_db_id );
        $posted          = isset( $_POST[ $this->unique ][ $menu_item_db_id ] ) ? wp_unslash( $_POST[ $this->unique ][ $menu_item_db_id ] ) : array();
        $posted          = is_array( $posted ) ? $posted : array();
        $sanitized       = Fields::sanitize_values( $posted, $this->sections );

        if ( empty( $sanitized ) ) {
            delete_post_meta( $menu_item_db_id, $this->unique );
            return;
        }

        update_post_meta( $menu_item_db_id, $this->unique, $sanitized );
    }
}
