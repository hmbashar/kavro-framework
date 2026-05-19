<?php
namespace Kavro\Fields\Content;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Content extends AbstractField { public function render() { echo '<div class="kavro-content">' . wp_kses_post( $this->attr( 'content', '' ) ) . '</div>'; } }
