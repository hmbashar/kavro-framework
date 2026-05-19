<?php
/**
 * Taxonomy options controller for Kavro Framework.
 *
 * Registers field groups on WordPress taxonomy add/edit screens. Values are
 * stored as a single term-meta array using the taxonomy container ID as the
 * meta key, matching the metabox module's single-array storage pattern.
 *
 * @package Kavro\Core
 */

namespace Kavro;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Taxonomy
 *
 * Adds Codestar-style taxonomy option support through
 * KAVRO::createTaxonomyOptions().
 */
class Taxonomy {
    /** @var string Unique taxonomy meta key. */
    protected $unique;

    /** @var array Taxonomy option arguments. */
    protected $args;

    /** @var array Section definitions assigned to this taxonomy option group. */
    protected $sections;

    /**
     * Register taxonomy screen hooks.
     *
     * @param string $unique   Unique taxonomy option ID and term-meta key.
     * @param array  $args     Taxonomy option arguments.
     * @param array  $sections Field sections.
     */
    public function __construct( $unique, $args, $sections ) {
        $this->unique   = sanitize_key( $unique );
        $this->args     = wp_parse_args(
            $args,
            array(
                'taxonomy' => array( 'category' ),
            )
        );
        $this->sections = is_array( $sections ) ? $sections : array();

        foreach ( (array) $this->args['taxonomy'] as $taxonomy ) {
            $taxonomy = sanitize_key( $taxonomy );

            add_action( $taxonomy . '_add_form_fields', array( $this, 'render_add_fields' ) );
            add_action( $taxonomy . '_edit_form_fields', array( $this, 'render_edit_fields' ), 10, 2 );
            add_action( 'created_' . $taxonomy, array( $this, 'save_term' ) );
            add_action( 'edited_' . $taxonomy, array( $this, 'save_term' ) );
        }

        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
    }

    /**
     * Load Kavro assets on taxonomy management screens.
     *
     * @param string $hook Current admin hook.
     * @return void
     */
    public function enqueue_assets( $hook ) {
        if ( ! in_array( $hook, array( 'edit-tags.php', 'term.php' ), true ) ) {
            return;
        }

        $screen = get_current_screen();
        if ( ! $screen || empty( $screen->taxonomy ) || ! in_array( $screen->taxonomy, (array) $this->args['taxonomy'], true ) ) {
            return;
        }

        wp_enqueue_media();
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_style( 'dashicons' );
        wp_enqueue_style( 'kavro-admin', KAVRO_URL . 'assets/css/admin.css', array( 'wp-color-picker' ), KAVRO_VERSION );
        wp_enqueue_script( 'kavro-admin', KAVRO_URL . 'assets/js/admin.js', array( 'jquery', 'wp-color-picker', 'jquery-ui-sortable' ), KAVRO_VERSION, true );
    }

    /**
     * Render fields on the taxonomy add screen.
     *
     * @param string $taxonomy Current taxonomy slug.
     * @return void
     */
    public function render_add_fields( $taxonomy ) {
        wp_nonce_field( 'kavro_save_taxonomy_' . $this->unique, 'kavro_taxonomy_nonce_' . $this->unique );

        echo '<div class="kavro-taxonomy kavro-taxonomy-add kavro-card">';
        $this->render_sections( array() );
        echo '</div>';
    }

    /**
     * Render fields on the taxonomy edit screen.
     *
     * @param \WP_Term $term     Current term object.
     * @param string   $taxonomy Current taxonomy slug.
     * @return void
     */
    public function render_edit_fields( $term, $taxonomy ) {
        $values = get_term_meta( $term->term_id, $this->unique, true );
        $values = is_array( $values ) ? $values : array();

        wp_nonce_field( 'kavro_save_taxonomy_' . $this->unique, 'kavro_taxonomy_nonce_' . $this->unique );

        echo '<tr class="form-field kavro-taxonomy-row"><th scope="row">';
        echo '<label>' . esc_html__( 'Kavro Options', 'kavro-framework' ) . '</label>';
        echo '</th><td>';
        echo '<div class="kavro-taxonomy kavro-taxonomy-edit kavro-card">';
        $this->render_sections( $values );
        echo '</div>';
        echo '</td></tr>';
    }

    /**
     * Render taxonomy sections with current values.
     *
     * @param array $values Saved term-meta values.
     * @return void
     */
    protected function render_sections( $values ) {
        foreach ( $this->sections as $section ) {
            echo '<div class="kavro-taxonomy-section">';

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
     * Save taxonomy option values for newly created or edited terms.
     *
     * @param int $term_id Current term ID.
     * @return void
     */
    public function save_term( $term_id ) {
        $nonce_key = 'kavro_taxonomy_nonce_' . $this->unique;

        if ( empty( $_POST[ $nonce_key ] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST[ $nonce_key ] ) ), 'kavro_save_taxonomy_' . $this->unique ) ) {
            return;
        }

        if ( ! current_user_can( 'manage_categories' ) ) {
            return;
        }

        $raw       = isset( $_POST[ $this->unique ] ) ? wp_unslash( $_POST[ $this->unique ] ) : array();
        $raw       = is_array( $raw ) ? $raw : array();
        $sanitized = Fields::sanitize_values( $raw, $this->sections );

        if ( empty( $sanitized ) ) {
            delete_term_meta( $term_id, $this->unique );
            return;
        }

        update_term_meta( $term_id, $this->unique, $sanitized );
    }
}
