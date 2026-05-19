<?php
/** Divider field for adding elegant spacing between field groups. */
namespace Kavro\Fields\Divider;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Divider extends AbstractField {
    public function render() {
        echo '<hr class="kavro-divider" />';
    }
}
