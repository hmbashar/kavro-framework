<?php
/** HTML preview field.
 *
 * @package Kavro\Fields\Html
 */
namespace Kavro\Fields\Html;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Html extends AbstractField { public function render() { $content = $this->attr( 'content', $this->value ); echo '<div class="kavro-html-preview">' . wp_kses_post( $content ) . '</div>'; if ( $this->id ) { printf( '<input type="hidden" name="%1$s" value="%2$s">', esc_attr( $this->name ), esc_attr( wp_strip_all_tags( $content ) ) ); } } }
