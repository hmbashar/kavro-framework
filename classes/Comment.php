<?php
/**
 * Comment options controller for Kavro Framework.
 *
 * Adds Kavro field groups to the WordPress comment edit screen and stores all
 * field values as a single comment-meta array keyed by the comment option
 * container ID. This mirrors the option, metabox, taxonomy, profile, nav menu,
 * and widget modules so developers can reuse the same field definitions across
 * contexts with minimal changes.
 *
 * @package Kavro\Core
 */

namespace Kavro;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Comment
 *
 * Provides KAVRO::createCommentOptions() support for comment edit screens.
 */
class Comment {
    /** @var string Unique comment-meta key. */
    protected $unique;

    /** @var array Comment option arguments. */
    protected $args;

    /** @var array Section definitions assigned to this comment option group. */
    protected $sections;

    /**
     * Register comment option hooks.
     *
     * @param string $unique   Unique comment option ID and comment-meta key.
     * @param array  $args     Comment option arguments.
     * @param array  $sections Field sections.
     */
    public function __construct( $unique, $args, $sections ) {
        $this->unique   = sanitize_key( $unique );
        $this->args     = wp_parse_args(
            $args,
            array(
                'title'      => __( 'Kavro Comment Options', 'kavro-framework' ),
                'capability' => 'edit_comment',
            )
        );
        $this->sections = is_array( $sections ) ? $sections : array();

        add_action( 'add_meta_boxes_comment', array( $this, 'add_comment_metabox' ) );
        add_action( 'edit_comment', array( $this, 'save_comment_fields' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
    }

    /**
     * Load Kavro assets on the comment edit screen only.
     *
     * @param string $hook Current admin hook.
     * @return void
     */
    public function enqueue_assets( $hook ) {
        if ( 'comment.php' !== $hook ) {
            return;
        }

        wp_enqueue_media();
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_style( 'dashicons' );
        wp_enqueue_style( 'kavro-admin', KAVRO_URL . 'assets/css/admin.css', array( 'wp-color-picker' ), KAVRO_VERSION );
        wp_enqueue_script( 'kavro-admin', KAVRO_URL . 'assets/js/admin.js', array( 'jquery', 'wp-color-picker', 'jquery-ui-sortable' ), KAVRO_VERSION, true );
    }

    /**
     * Add a Kavro metabox to the comment edit screen.
     *
     * @return void
     */
    public function add_comment_metabox() {
        add_meta_box(
            $this->unique,
            $this->args['title'],
            array( $this, 'render_comment_metabox' ),
            'comment',
            'normal',
            'default'
        );
    }

    /**
     * Render comment option fields.
     *
     * @param \WP_Comment $comment Current comment object.
     * @return void
     */
    public function render_comment_metabox( $comment ) {
        if ( ! $comment instanceof \WP_Comment ) {
            return;
        }

        $values = get_comment_meta( $comment->comment_ID, $this->unique, true );
        $values = is_array( $values ) ? $values : array();

        wp_nonce_field( 'kavro_save_comment_' . $this->unique, 'kavro_comment_nonce_' . $this->unique );

        echo '<div class="kavro-comment kavro-card">';
        $this->render_sections( $values );
        echo '</div>';
    }

    /**
     * Render all comment option sections.
     *
     * @param array $values Saved comment-meta values.
     * @return void
     */
    protected function render_sections( $values ) {
        foreach ( $this->sections as $section ) {
            echo '<div class="kavro-comment-section">';

            if ( ! empty( $section['title'] ) ) {
                echo '<div class="kavro-metabox-heading"><h3>' . esc_html( $section['title'] ) . '</h3>';
                if ( ! empty( $section['subtitle'] ) ) {
                    echo '<p>' . esc_html( $section['subtitle'] ) . '</p>';
                }
                echo '</div>';
            }

            if ( ! empty( $section['fields'] ) && is_array( $section['fields'] ) ) {
                foreach ( $section['fields'] as $field ) {
                    $field_id = isset( $field['id'] ) ? sanitize_key( $field['id'] ) : '';
                    $value    = $field_id && array_key_exists( $field_id, $values ) ? $values[ $field_id ] : ( $field['default'] ?? '' );
                    Fields::render( $field, $value, $this->unique );
                }
            }

            echo '</div>';
        }
    }

    /**
     * Save comment option values.
     *
     * @param int $comment_id Comment ID being saved.
     * @return void
     */
    public function save_comment_fields( $comment_id ) {
        $comment_id = absint( $comment_id );
        $nonce_key  = 'kavro_comment_nonce_' . $this->unique;

        if ( empty( $_POST[ $nonce_key ] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST[ $nonce_key ] ) ), 'kavro_save_comment_' . $this->unique ) ) {
            return;
        }

        if ( ! current_user_can( 'edit_comment', $comment_id ) ) {
            return;
        }

        $raw       = isset( $_POST[ $this->unique ] ) ? wp_unslash( $_POST[ $this->unique ] ) : array();
        $raw       = is_array( $raw ) ? $raw : array();
        $sanitized = Fields::sanitize( $raw );

        if ( empty( $sanitized ) ) {
            delete_comment_meta( $comment_id, $this->unique );
            return;
        }

        update_comment_meta( $comment_id, $this->unique, $sanitized );
    }
}
