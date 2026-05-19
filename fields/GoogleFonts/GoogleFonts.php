<?php
/**
 * google_fonts field for Kavro Framework.
 *
 * @package Kavro\Fields
 */

namespace Kavro\Fields\GoogleFonts;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the google_fonts field.
 */
class GoogleFonts extends AbstractField {
    /** Render the field control. */
    public function render() {

        $fonts = (array) $this->attr( 'options', array( 'Inter' => 'Inter', 'Roboto' => 'Roboto', 'Poppins' => 'Poppins', 'Open Sans' => 'Open Sans', 'Lato' => 'Lato', 'Montserrat' => 'Montserrat' ) );
        echo '<select id="kavro-' . esc_attr( $this->id ) . '" class="kavro-select2" name="' . esc_attr( $this->name ) . '" data-kavro-select2 data-placeholder="' . esc_attr__( 'Choose font', 'kavro-framework' ) . '">';
        echo '<option value="">' . esc_html__( 'Choose font', 'kavro-framework' ) . '</option>';
        foreach ( $fonts as $value => $label ) {
            printf( '<option value="%1$s" %2$s>%3$s</option>', esc_attr( $value ), selected( (string) $this->value, (string) $value, false ), esc_html( $label ) );
        }
        echo '</select>';
    }
}
