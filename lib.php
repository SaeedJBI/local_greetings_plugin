<?php
// This file is part of Moodle - https://moodle.org//.
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <https://www.gnu.org/licenses/>.

/** Get a personalized greeting message for the user based on their country.
 * If $user is null, a generic greeting for all users is returned.
 * Otherwise, a greeting specific to the user's country is returned.
 * @package     local_greetings
 * @param       object|null $user The user object to retrieve the country from.
 * @category    string
 * @return string The greeting message.
 * @copyright   2024 Saeed Jabeeti <saeedjabeeti@gmail.com>
 * @license     https://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
/**
 * Get a personalized greeting message for the user based on their country.
 *
 * If $user is null, a generic greeting for all users is returned.
 * Otherwise, a greeting specific to the user's country is returned.
 *
 * @param object|null $user The user object to retrieve the country from.
 * @return string The greeting message.
 */
function local_greetings_get_greeting($user) {
    if ($user == null) {
        return get_string('greetinguser', 'local_greetings');
    }

    $country = $user->country;
    switch ($country) {
        case 'ES':
            $langstr = 'greetinguseres';
            break;
        case 'AU':
            $langstr = 'greetinguserau';
            break;
        case 'FJ':
            $langstr = 'greetinguserfj';
            break;
        case 'NZ':
            $langstr = 'greetingusernz';
            break;
        default:
            $langstr = 'greetingloggedinuser';
            break;
    }

    return get_string($langstr, 'local_greetings', fullname($user));
}
/**
 * Insert a link to index.php on the site front page navigation menu.
 *
 * @package local_greetings
 * @param   navigation_node $frontpage Node representing the front page in the navigation tree.
 */
function local_greetings_extend_navigation_frontpage(navigation_node $frontpage) {
    if (!(isguestuser()) && isloggedin()) {
        $frontpage->add(
            get_string('pluginname', 'local_greetings'),
            new moodle_url('/local/greetings/index.php'),
            navigation_node::TYPE_CUSTOM,
        );
    }
}
/**
 * Extend the global navigation with a custom node for the Local Greetings plugin.
 *
 * This function adds a custom navigation node to the global navigation tree,
 * linking to the index.php page of the Local Greetings plugin.
 *
 * @package local_greetings
 * @param global_navigation $root The root node of the global navigation tree.
 */
function local_greetings_extend_navigation(global_navigation $root) {
    $node = navigation_node::create(
        get_string('pluginname', 'local_greetings'),
        new moodle_url('/local/greetings/index.php'),
        navigation_node::TYPE_CUSTOM,
        null,
        null,
        new pix_icon('t/message', '')
    );

    $root->add_node($node);
}
