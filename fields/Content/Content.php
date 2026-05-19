<?php
/**
 * Kavro Framework file: fields/Content/Content.php.
 *
 * This file is part of the Kavro options framework and is intentionally kept
 * focused on one responsibility for easier maintenance and extension.
 *
 * @package Kavro
 */

namespace Kavro\Fields\Content;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Content extends AbstractField { public function render() { echo '<div class="kavro-content">' . wp_kses_post( $this->attr( 'content', '' ) ) . '</div>'; } }
