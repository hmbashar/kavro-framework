<?php
/**
 * Kavro Framework file: fields/Media/Media.php.
 *
 * This file is part of the Kavro options framework and is intentionally kept
 * focused on one responsibility for easier maintenance and extension.
 *
 * @package Kavro
 */

namespace Kavro\Fields\Media;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class Media extends AbstractField { public function render() { $url = is_array( $this->value ) && isset( $this->value['url'] ) ? $this->value['url'] : $this->value; printf( '<div class="kavro-media"><input type="text" id="kavro-%1$s" name="%2$s" value="%3$s"><button type="button" class="button kavro-media-upload">Upload</button><button type="button" class="button kavro-media-remove">Remove</button><div class="kavro-media-preview">%4$s</div></div>', esc_attr( $this->id ), esc_attr( $this->name ), esc_attr( $url ), $url ? '<img src="' . esc_url( $url ) . '" alt="">' : '' ); } }
