<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

// front-end
$route['discography/albums'] = 'discography/albums';
$route['discography/album(/:any)?'] = 'discography/album$1';

// back-end
$route['discography/admin/albums(/:any)?'] = 'admin_albums$1';
$route['discography/admin/tracks(/:any)?']  = 'admin_tracks$1';
$route['discography/admin(/:any)?'] = 'admin_albums$1';
