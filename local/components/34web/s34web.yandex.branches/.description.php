<?php if(!defined('B_PROLOG_INCLUDED')||B_PROLOG_INCLUDED!==true)die();
$arComponentDescription = array(
        'NAME' => GetMessage('S34WEBYB_COMPONENT_NAME'),
        'DESCRIPTION' => GetMessage('S34WEBYB_COMPONENT_DESCRIPTION'),
	    'ICON' => '/images/icon.gif',
        'CACHE_PATH' => 'Y',
        'SORT' => 500,
        'PATH' => array(
            'ID' => 'add_form',
            'NAME' => GetMessage('S34WEBYB_COMPONENTS'),
            'CHILD' => array(
                'SORT' => 10,
                'ID' => 'system',
                'NAME' => GetMessage('S34WEBYB_COMPONENTS_GROUP_NAME'),
		),
	),
);