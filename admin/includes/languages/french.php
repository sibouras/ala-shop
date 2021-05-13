<?php

function lang($phrase)
{
  static $lang = [
    'Message' => 'Salut',
    'Admin' => 'Administrateur',
  ];
  return $lang[$phrase];
}
