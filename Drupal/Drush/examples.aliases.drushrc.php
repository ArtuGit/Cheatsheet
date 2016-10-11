<?php
  $sites_path = '/home/webmaster/domains/';
  $aliases['live'] = 
    array(  'root' => $sites_path . 'live/html',
            'path-aliases' => array('%dump-dir' => $sites_path . 'live/backup/db',    
                                     '%files' => 'sites/default/files'
                                   ),            
         );
  $aliases['stage'] = 
    array(  'root' => $sites_path . 'stage/html',
            'path-aliases' => array('%files' => 'sites/default/files'),
            'command-specific' => array ('rsync' => array('mode' => 'rlptzO', 'verbose' => TRUE, 'no-perms' => TRUE)),            
         );    
