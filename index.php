<?php

/********* TURN OFF IN PRODUCTION *********/
ini_set('display_errors', 'on');
error_reporting(E_ALL);

/* ----------------------------------------
 | Sets the Blogza directory folder.
 | ----------------------------------------
 | This sets BLOGZA_DIR to the directory
 | where this file is located. All file
 | locations are based off this setting,
 | so you can modify this based on that.
 */
 define("BLOGZA_DIR", __DIR__);

/* ----------------------------------------
 | Requires the Blogza mainframe PHP file
 | ----------------------------------------
 | This loads the Blogza mainframe code
 | via `require`. This allows for the
 | creation of our Blogza object, later
 | utilized in the code.
 */

require(BLOGZA_DIR . '/system/Blogza.php');

/* ----------------------------------------
 | Creates the Blogza object
 | ----------------------------------------
 | This function creates the Blogza object
 | and assigns it to $blogza. This is our
 | one and only Blogza instance in the
 | software, and runs the entire software.
 */
$blogza = new Blogza();

/* ----------------------------------------
 | Starts the Blogza blogging software
 | ----------------------------------------
 | This function starts the Blogza blog.
 | Once started, it runs by itself from
 | the Blogza framework files. It then
 | then displays all output itself.
 */
$blogza->start();