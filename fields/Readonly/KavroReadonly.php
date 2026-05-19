<?php
/** Read-only text field.
 *
 * @package Kavro\Fields\Readonly
 */
namespace Kavro\Fields\Readonly;
use Kavro\AbstractField;
if ( ! defined( 'ABSPATH' ) ) { exit; }
class KavroReadonly extends AbstractField { public function render() { printf( '<div class="kavro-readonly-field"><input type="text" id="kavro-%2$s" name="%1$s" value="%3$s" readonly></div>', esc_attr( $this->name ), esc_attr( $this->id ), esc_attr( $this->value ) ); } }
