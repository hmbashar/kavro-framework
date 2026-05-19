<?php
/**
 * Kavro Framework file: fields/Notice/Notice.php.
 *
 * This file is part of the Kavro options framework and is intentionally kept
 * focused on one responsibility for easier maintenance and extension.
 *
 * @package Kavro
 */

namespace Kavro\Fields\Notice;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Notice extends AbstractField { public function render() { $style = sanitize_key( $this->attr( 'style', 'info' ) ); echo '<div class="kavro-notice kavro-notice-' . esc_attr( $style ) . '">' . wp_kses_post( $this->attr( 'content', '' ) ) . '</div>'; } }
