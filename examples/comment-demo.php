<?php
/**
 * Kavro Comment Options demo.
 *
 * This file demonstrates how to attach Kavro fields to the WordPress comment
 * edit screen. The demo uses readable, commented arrays so developers can copy
 * one section at a time into their own plugin or theme.
 *
 * @package Kavro\Examples
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'KAVRO' ) ) {
    return;
}

/**
 * Unique comment option ID.
 *
 * Kavro stores all fields for this module as a single comment-meta array using
 * this ID as the meta key.
 */
$comment_prefix = 'kavro_demo_comment';

/**
 * Create comment options container.
 *
 * These fields appear on the comment edit screen under a dedicated Kavro
 * metabox. The `capability` value can be adjusted for stricter workflows.
 */
KAVRO::createCommentOptions(
    $comment_prefix,
    array(
        'title'      => __( 'Kavro Comment Review Options', 'kavro-framework' ),
        'capability' => 'edit_comment',
    )
);

/**
 * Review workflow fields.
 */
KAVRO::createSection(
    $comment_prefix,
    array(
        'title'    => __( 'Review Workflow', 'kavro-framework' ),
        'subtitle' => __( 'Moderation and editorial metadata for this comment.', 'kavro-framework' ),
        'fields'   => array(
            array(
                'id'      => 'review_status',
                'type'    => 'select',
                'title'   => __( 'Review Status', 'kavro-framework' ),
                'options' => array(
                    'new'      => __( 'New', 'kavro-framework' ),
                    'reviewed' => __( 'Reviewed', 'kavro-framework' ),
                    'flagged'  => __( 'Flagged', 'kavro-framework' ),
                    'resolved' => __( 'Resolved', 'kavro-framework' ),
                ),
                'default' => 'new',
            ),
            array(
                'id'      => 'priority',
                'type'    => 'button_set',
                'title'   => __( 'Priority', 'kavro-framework' ),
                'options' => array(
                    'low'    => __( 'Low', 'kavro-framework' ),
                    'normal' => __( 'Normal', 'kavro-framework' ),
                    'high'   => __( 'High', 'kavro-framework' ),
                ),
                'default' => 'normal',
            ),
            array(
                'id'    => 'internal_note',
                'type'  => 'textarea',
                'title' => __( 'Internal Note', 'kavro-framework' ),
                'desc'  => __( 'Private note for moderators. This does not display on the frontend.', 'kavro-framework' ),
            ),
        ),
    )
);

/**
 * Author insight fields.
 */
KAVRO::createSection(
    $comment_prefix,
    array(
        'title'  => __( 'Author Insights', 'kavro-framework' ),
        'fields' => array(
            array(
                'id'      => 'sentiment',
                'type'    => 'radio',
                'title'   => __( 'Sentiment', 'kavro-framework' ),
                'options' => array(
                    'positive' => __( 'Positive', 'kavro-framework' ),
                    'neutral'  => __( 'Neutral', 'kavro-framework' ),
                    'negative' => __( 'Negative', 'kavro-framework' ),
                ),
                'default' => 'neutral',
            ),
            array(
                'id'      => 'quality_rating',
                'type'    => 'rating',
                'title'   => __( 'Quality Rating', 'kavro-framework' ),
                'default' => 4,
            ),
            array(
                'id'      => 'needs_reply',
                'type'    => 'switcher',
                'title'   => __( 'Needs Reply', 'kavro-framework' ),
                'default' => true,
            ),
        ),
    )
);

/**
 * Full compatibility demo.
 *
 * Reuse the shared field examples so comment options can be tested against the
 * same field set used by admin options and metaboxes. Large visual/system
 * fields may not be ideal for real comment workflows, but this is useful while
 * developing Kavro itself.
 */
if ( function_exists( 'kavro_demo_field_sections' ) ) {
    foreach ( kavro_demo_field_sections() as $section ) {
        $section['title'] = __( 'Comment: ', 'kavro-framework' ) . ( $section['title'] ?? __( 'Fields', 'kavro-framework' ) );
        KAVRO::createSection( $comment_prefix, $section );
    }
}
