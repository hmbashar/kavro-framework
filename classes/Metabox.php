<?php
/**
 * Metabox framework controller for Kavro Framework.
 *
 * Registers WordPress post edit metaboxes and renders the same Kavro field
 * definitions used by admin option panels. Values are stored as a single
 * protected post-meta array using the metabox unique ID as the meta key.
 *
 * @package Kavro\Core
 */

namespace Kavro;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Metabox
 *
 * Adds Codestar-style metabox support through KAVRO::createMetabox().
 */
class Metabox {
    /** @var string Unique metabox/meta key. */
    protected $unique;

    /** @var array Metabox arguments. */
    protected $args;

    /** @var array Section definitions assigned to this metabox. */
    protected $sections;

    /**
     * Register metabox hooks.
     *
     * @param string $unique   Unique metabox ID and post meta key.
     * @param array  $args     Metabox arguments.
     * @param array  $sections Field sections.
     */
    public function __construct( $unique, $args, $sections ) {
        $this->unique   = sanitize_key( $unique );
        $this->args     = wp_parse_args(
            $args,
            array(
                'title'     => 'Kavro Metabox',
                'post_type' => array( 'post', 'page' ),
                'context'   => 'normal',
                'priority'  => 'default',
            )
        );
        $this->sections = is_array( $sections ) ? $sections : array();

        add_action( 'add_meta_boxes', array( $this, 'register_metabox' ) );
        add_action( 'save_post', array( $this, 'save_metabox' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
    }

    /**
     * Load Kavro assets on post edit screens where metaboxes can appear.
     *
     * @param string $hook Current admin hook.
     * @return void
     */
    public function enqueue_assets( $hook ) {
        if ( ! in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) {
            return;
        }

        Assets::enqueue( $this->sections );
    }

    /**
     * Register the metabox for each configured post type.
     *
     * @return void
     */
    public function register_metabox() {
        $post_types = (array) $this->args['post_type'];

        foreach ( $post_types as $post_type ) {
            add_meta_box(
                $this->unique,
                $this->args['title'],
                array( $this, 'render_metabox' ),
                sanitize_key( $post_type ),
                $this->args['context'],
                $this->args['priority']
            );
        }
    }

    /**
     * Render metabox sections and fields.
     *
     * @param \WP_Post $post Current post object.
     * @return void
     */
    public function render_metabox( $post ) {
        $values = get_post_meta( $post->ID, $this->unique, true );
        $values = is_array( $values ) ? $values : array();

        wp_nonce_field( 'kavro_save_metabox_' . $this->unique, 'kavro_metabox_nonce_' . $this->unique );

        echo '<div class="kavro-metabox kavro-card">';

        foreach ( $this->sections as $section ) {
            echo '<div class="kavro-metabox-section">';

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

        echo '</div>';
    }

    /**
     * Save metabox values after WordPress validates the edit request.
     *
     * @param int $post_id Current post ID.
     * @return void
     */
    public function save_metabox( $post_id ) {
        $nonce_key = 'kavro_metabox_nonce_' . $this->unique;

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        if ( wp_is_post_revision( $post_id ) || wp_is_post_autosave( $post_id ) ) {
            return;
        }

        if ( empty( $_POST[ $nonce_key ] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST[ $nonce_key ] ) ), 'kavro_save_metabox_' . $this->unique ) ) {
            return;
        }

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }

        $raw = isset( $_POST[ $this->unique ] ) ? wp_unslash( $_POST[ $this->unique ] ) : array();
        $raw = is_array( $raw ) ? $raw : array();
        $sanitized = Fields::sanitize_values( $raw, $this->sections );

        if ( empty( $sanitized ) ) {
            delete_post_meta( $post_id, $this->unique );
            return;
        }

        update_post_meta( $post_id, $this->unique, $sanitized );
    }
}
