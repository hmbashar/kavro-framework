<?php
/** oEmbed URL field placeholder.
 *
 * @package Kavro\Fields\Oembed
 */
namespace Kavro\Fields\Oembed;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Oembed extends AbstractField { public function render() { printf( '<input type="url" id="kavro-%2$s" name="%1$s" value="%3$s" placeholder="%4$s"><div class="kavro-html-preview"><strong>%5$s</strong><p>%6$s</p></div>', esc_attr( $this->name ), esc_attr( $this->id ), esc_url( $this->value ), $this->placeholder(), esc_html__( 'oEmbed URL', 'kavro-framework' ), esc_html__( 'Paste a supported WordPress oEmbed URL. Front-end rendering can use wp_oembed_get().', 'kavro-framework' ) ); } }
