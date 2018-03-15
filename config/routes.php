<?php
return array(
    
    'message/delete/([0-9]+)' => 'message/delete/$1',
 
    'message\/([0-9]+)' => 'message/view/$2', 
    'message\/p-([0-9]+)' => 'message/index/$1',
    'about' => 'message/about',
    'createMessage' => 'message/create',
    'gallery\/([0-9]+)' =>'message/gallery/$1',
    'message' => 'message/index',
  
    
    'user/register' => 'user/register',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    
    'cabinet/p-([0-9]+)' => 'cabinet/index/$1',
    'cabinet/update/([0-9]+)' => 'cabinet/update/$1',
    'cabinet/edit' => 'cabinet/edit',
    
    'cabinet' => 'cabinet/index'
);

?>