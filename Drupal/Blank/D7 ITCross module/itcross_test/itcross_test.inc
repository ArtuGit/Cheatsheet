<?php

function _itcross_test_script() {


db_update('shurly')->fields(
  array(
    'custom' => 'castet',
    'url_client_invites' => 100,
    'url_client_clicks' => 200,
    'url_others_invites' => 300,
    'url_others_clicks' => 400,        

  )
)->condition('rid', 30, '=')
->execute();


  global $base_root;
  $output  = $base_root;

	return $output;
}
