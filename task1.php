
<?php
/*
    Используя рекурсию, вывести в виде дерева структуру массива.
*/

$fs = [
    'html' => [
        'api' => [
            'controllers',
            'models',
            'views',
            'modules'
        ],
        'application' => [
            'controllers',
            'models',
            'views',
            'modules'
        ],
        'runtime' => [
            'logs',
            'cache'
        ],
        'data' => [
            'dumps',
            'images',
            'files'
        ],
        'config',
        'migrations'
    ]
];

function tree($items, $level = " ")
{
	foreach ($items as $value) {
		if(is_array($value)){
			echo $level.key($items)."\n";
			tree($value, $level.$level);
			next($items);
		}else{
			echo $level.$value."\n";
		}

	}
}

tree($fs);