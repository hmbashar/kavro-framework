<?php
/**
 * User profile options controller for Kavro Framework.
 *
 * Adds Kavro field sections to WordPress user profile screens and stores the
 * values as a single user-meta array keyed by the profile option container ID.
 *
 * @package Kavro\Core
 */

namespace Kavro;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Profile
 *
 * Provides KAVRO::createProfileOptions() support for user profile fields.
 */
class Profile {
    /** @var string Unique user-meta key. */
    protected $unique;

    /** @var array Profile option arguments. */
    protected $args;

    /** @var array Section definitions assigned to this profile option group. */
    protected $sections;

    /**
     * Register user profile hooks.
     *
     * @param string $unique   Unique profile option ID and user-meta key.
     * @param array  $args     Profile option arguments.
     * @param array  $sections Field sections.
     */
    public function __construct( $unique, $args, $sections ) {
        $this->unique   = sanitize_key( $unique );
        $this->args     = wp_parse_args(
            $args,
            array(
                'title'      => __( 'Kavro Profile Options', 'kavro-framework' ),
                'roles'      => array(),
                'capability' => 'edit_user',
            )
        );
        $this->sections = is_array( $sections ) ? $sections : array();

        add_action( 'show_user_profile', array( $this, 'render_profile_fields' ) );
        add_action( 'edit_user_profile', array( $this, 'render_profile_fields' ) );
        add_action( 'personal_options_update', array( $this, 'save_profile_fields' ) );
        add_action( 'edit_user_profile_update', array( $this, 'save_profile_fields' ) );
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_assets' ) );
    }

    /**
     * Load Kavro assets on user profile screens.
     *
     * @param string $hook Current admin hook.
     * @return void
     */
    public function enqueue_assets( $hook ) {
        if ( ! in_array( $hook, array( 'profile.php', 'user-edit.php' ), true ) ) {
            return;
        }

        Assets::enqueue( $this->sections );
    }

    /**
     * Render profile fields for the current user edit screen.
     *
     * @param \WP_User $user Current user object.
     * @return void
     */
    public function render_profile_fields( $user ) {
        if ( ! $user instanceof \WP_User ) {
            return;
        }

        if ( ! $this->is_allowed_for_user( $user ) ) {
            return;
        }

        $values = get_user_meta( $user->ID, $this->unique, true );
        $values = is_array( $values ) ? $values : array();

        wp_nonce_field( 'kavro_save_profile_' . $this->unique, 'kavro_profile_nonce_' . $this->unique );

        echo '<h2>' . esc_html( $this->args['title'] ) . '</h2>';
        echo '<div class="kavro-profile kavro-card">';
        $this->render_sections( $values );
        echo '</div>';
    }

    /**
     * Render all profile sections.
     *
     * @param array $values Saved user-meta values.
     * @return void
     */
    protected function render_sections( $values ) {
        foreach ( $this->sections as $section ) {
            echo '<div class="kavro-profile-section">';

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
     * Save profile option values.
     *
     * @param int $user_id User ID being saved.
     * @return void
     */
    public function save_profile_fields( $user_id ) {
        $user_id   = absint( $user_id );
        $nonce_key = 'kavro_profile_nonce_' . $this->unique;

        if ( empty( $_POST[ $nonce_key ] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST[ $nonce_key ] ) ), 'kavro_save_profile_' . $this->unique ) ) {
            return;
        }

        if ( ! current_user_can( 'edit_user', $user_id ) ) {
            return;
        }

        $raw       = isset( $_POST[ $this->unique ] ) ? wp_unslash( $_POST[ $this->unique ] ) : array();
        $raw       = is_array( $raw ) ? $raw : array();
        $sanitized = Fields::sanitize_values( $raw, $this->sections );

        if ( empty( $sanitized ) ) {
            delete_user_meta( $user_id, $this->unique );
            return;
        }

        update_user_meta( $user_id, $this->unique, $sanitized );
    }

    /**
     * Determine whether this profile option group should show for a user.
     *
     * @param \WP_User $user User object being edited.
     * @return bool
     */
    protected function is_allowed_for_user( $user ) {
        $roles = isset( $this->args['roles'] ) ? array_filter( (array) $this->args['roles'] ) : array();

        if ( empty( $roles ) ) {
            return true;
        }

        return (bool) array_intersect( $roles, (array) $user->roles );
    }
}
