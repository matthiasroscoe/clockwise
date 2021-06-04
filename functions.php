<?php
/**
 * Functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 */

// Theme Setup
require('inc/setup/theme-setup.php');

// Enqueues
require('inc/setup/enqueues.php');

// Custom Post Types & Taxonomies
require('inc/cpt/location.php');
require('inc/cpt/meeting-room.php');
require('inc/cpt/membership-plan.php');
require('inc/cpt/article.php');
require('inc/cpt/event.php');
require('inc/cpt/team-members.php');
require('inc/cpt/career-case-study.php');
require('inc/cpt/testimonial.php');
require('inc/cpt/job-vacancy.php');
require('inc/cpt/referral.php');

// Polylang
// All strings hardcoded in the theme must be registered here before they are available for translation in the CMS.
// To translate a registered string go to 'Languages' -> 'String Translation' in the CMS.
require('inc/polylang-theme-strings.php');

// Functions
require('inc/functions/misc.php');
require('inc/functions/hero-actions.php');
include('inc/functions/locations.php');
include('inc/functions/events.php');
include('inc/functions/article.php');
include('inc/functions/meeting-rooms.php');
include('inc/functions/job-vacancy.php');
include('inc/functions/modals.php');
include('inc/functions/bar-graph.php');
include('inc/functions/cost-calculator.php');
include('inc/functions/referral.php');
include('inc/functions/image-upload.php');

// Theme Tags
require('inc/setup/template-tags.php');