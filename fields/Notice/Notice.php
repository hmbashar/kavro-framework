<?php
namespace Kavro\Fields\Notice;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Notice extends AbstractField { public function render() { $style = sanitize_key( $this->attr( 'style', 'info' ) ); echo '<div class="kavro-notice kavro-notice-' . esc_attr( $style ) . '">' . wp_kses_post( $this->attr( 'content', '' ) ) . '</div>'; } }
