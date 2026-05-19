<?php
namespace Kavro\Fields\Heading;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Heading extends AbstractField { public function render() { echo '<div class="kavro-heading"><h3>' . esc_html( $this->attr( 'content', $this->attr( 'title', '' ) ) ) . '</h3></div>'; } }
