<?php
/**
 * Security utilities for Kavro Framework.
 *
 * The framework controllers keep their own module-specific logic, while this
 * class centralizes common hardening helpers: capabilities, nonces, safe upload
 * checks, and safe admin redirects. Keeping these checks in one class makes it
 * easier for Kavro Pro and third-party modules to follow the same security
 * contract as core modules.
 *
 * @package Kavro\Core
 */

namespace Kavro;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Security helper methods.
 */
final class Security {
    /**
     * Default maximum import size in bytes. Developers can change this through
     * the `kavro/import_max_bytes` filter.
     *
     * @var int
     */
    const DEFAULT_IMPORT_MAX_BYTES = 2097152; // 2 MB.

    /**
     * Check a WordPress capability.
     *
     * @param string $capability Capability name.
     * @param mixed  ...$args    Optional capability context arguments.
     * @return bool
     */
    public static function can( $capability, ...$args ) {
        $capability = is_string( $capability ) && '' !== $capability ? $capability : 'manage_options';
        return current_user_can( $capability, ...$args );
    }

    /**
     * Verify a nonce value from a request array.
     *
     * @param array  $request Request source, usually $_POST or $_REQUEST.
     * @param string $key     Request key that contains the nonce value.
     * @param string $action  Nonce action.
     * @return bool
     */
    public static function verify_nonce_from_request( $request, $key, $action ) {
        if ( empty( $request[ $key ] ) ) {
            return false;
        }

        $nonce = sanitize_text_field( wp_unslash( $request[ $key ] ) );
        return (bool) wp_verify_nonce( $nonce, $action );
    }

    /**
     * Send a consistent permission failure for non-AJAX admin endpoints.
     *
     * @param string $message Failure message.
     * @return never
     */
    public static function wp_die_permission( $message = '' ) {
        wp_die(
            esc_html( $message ? $message : __( 'You do not have permission to perform this action.', 'kavro-framework' ) ),
            esc_html__( 'Kavro Permission Check Failed', 'kavro-framework' ),
            array( 'response' => 403 )
        );
    }

    /**
     * Send a consistent nonce failure for non-AJAX admin endpoints.
     *
     * @param string $message Failure message.
     * @return never
     */
    public static function wp_die_nonce( $message = '' ) {
        wp_die(
            esc_html( $message ? $message : __( 'Security verification failed. Please refresh the page and try again.', 'kavro-framework' ) ),
            esc_html__( 'Kavro Security Check Failed', 'kavro-framework' ),
            array( 'response' => 403 )
        );
    }

    /**
     * Send a JSON error for AJAX permission failures.
     *
     * @param string $message Failure message.
     * @return never
     */
    public static function ajax_permission_error( $message = '' ) {
        wp_send_json_error(
            array( 'message' => $message ? $message : __( 'You do not have permission to perform this action.', 'kavro-framework' ) ),
            403
        );
    }

    /**
     * Send a JSON error for AJAX nonce failures.
     *
     * @param string $message Failure message.
     * @return never
     */
    public static function ajax_nonce_error( $message = '' ) {
        wp_send_json_error(
            array( 'message' => $message ? $message : __( 'Security verification failed. Please refresh the page and try again.', 'kavro-framework' ) ),
            403
        );
    }

    /**
     * Validate a Kavro import upload before reading the temporary file.
     *
     * @param array $file Single item from $_FILES.
     * @return true|\WP_Error
     */
    public static function validate_import_upload( $file ) {
        if ( empty( $file ) || ! is_array( $file ) || empty( $file['tmp_name'] ) ) {
            return new \WP_Error( 'kavro_no_upload', __( 'No import file was uploaded.', 'kavro-framework' ) );
        }

        $error = isset( $file['error'] ) ? absint( $file['error'] ) : UPLOAD_ERR_OK;
        if ( UPLOAD_ERR_OK !== $error ) {
            return new \WP_Error( 'kavro_upload_error', __( 'The import file could not be uploaded.', 'kavro-framework' ) );
        }

        $size      = isset( $file['size'] ) ? absint( $file['size'] ) : 0;
        $max_bytes = (int) apply_filters( 'kavro/import_max_bytes', self::DEFAULT_IMPORT_MAX_BYTES );
        if ( $size > $max_bytes ) {
            return new \WP_Error( 'kavro_upload_too_large', __( 'The import file is too large.', 'kavro-framework' ) );
        }

        $filename = isset( $file['name'] ) ? sanitize_file_name( wp_unslash( $file['name'] ) ) : '';
        $type     = wp_check_filetype( $filename, array( 'json' => 'application/json' ) );
        if ( 'json' !== strtolower( (string) $type['ext'] ) ) {
            return new \WP_Error( 'kavro_upload_type', __( 'Only JSON import files are allowed.', 'kavro-framework' ) );
        }

        if ( ! is_uploaded_file( $file['tmp_name'] ) && ! file_exists( $file['tmp_name'] ) ) {
            return new \WP_Error( 'kavro_upload_missing', __( 'The import file could not be found.', 'kavro-framework' ) );
        }

        return true;
    }

    /**
     * Build a safe admin redirect URL for a Kavro admin page.
     *
     * @param string $menu_slug Admin page slug.
     * @param array  $args      Query arguments.
     * @return string
     */
    public static function admin_page_url( $menu_slug, $args = array() ) {
        $args = array_merge( array( 'page' => sanitize_key( $menu_slug ) ), array_map( 'sanitize_text_field', $args ) );
        return add_query_arg( array_filter( $args ), admin_url( 'admin.php' ) );
    }
}
