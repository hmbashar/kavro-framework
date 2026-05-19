<?php
/**
 * CronSchedule field.
 *
 * Premium Kavro control for advanced WordPress option data.
 *
 * @package Kavro\Fields
 */
namespace Kavro\Fields\CronSchedule;

use Kavro\AbstractField;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Renders the CronSchedule field.
 */
class CronSchedule extends AbstractField {
    /**
     * Output the field control markup.
     *
     * @return void
     */
    public function render() {
        $value = $this->array_value();
        $freqs = array( 'hourly'=>'Hourly', 'twicedaily'=>'Twice Daily', 'daily'=>'Daily', 'weekly'=>'Weekly' );
        echo '<div class="kavro-cron"><select name="' . esc_attr( $this->name ) . '[frequency]">';
        foreach ( $freqs as $key => $label ) { echo '<option value="' . esc_attr( $key ) . '" ' . selected( $value['frequency'] ?? 'daily', $key, false ) . '>' . esc_html( $label ) . '</option>'; }
        echo '</select><input type="time" name="' . esc_attr( $this->name ) . '[time]" value="' . esc_attr( $value['time'] ?? '09:00' ) . '"></div>';
    }
}
