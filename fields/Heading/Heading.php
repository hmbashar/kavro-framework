<?php
/**
 * Kavro Framework file: fields/Heading/Heading.php.
 *
 * This file is part of the Kavro options framework and is intentionally kept
 * focused on one responsibility for easier maintenance and extension.
 *
 * @package Kavro
 */

namespace Kavro\Fields\Heading;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Heading extends AbstractField { public function render() { echo '<div class="kavro-heading"><h3>' . esc_html( $this->attr( 'content', $this->attr( 'title', '' ) ) ) . '</h3></div>'; } }
