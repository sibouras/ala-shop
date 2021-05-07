<?php

function lang($phrase)
{
  static $lang = [
    // Navbar links
    'home' => 'Home',
    'dashboard' => 'Main dashboard',
    'categories' => 'Categories',
    'items' => 'Items',
    'users' => 'Users',
    'members' => 'Members',
    'reviews' => 'Reviews',
    'statistics' => 'Statistics',
    'logs' => 'Logs',
  ];
  return $lang[$phrase];
}
