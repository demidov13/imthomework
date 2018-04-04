<?php
$data = [
    'server' => [
        'items' => [
            'php' => [
                'label' => 'PHP',
                'services' => [
                    [
                        'PHP Basic',
                        'PHP Yii2',
                        'PHP Laravel',
                        'PHP Symfony',
                        'PHP Cake',
                        'PHP Zend'
                    ]
                ],
            ],
            'python' => [
                'label' => 'Python',
                'services' => [
                    'Python Basic',
                    'Python Django',
                    'Python Flask',
                    'Python Pyramid'
                ]
            ]
        ],
        'label' => 'Server-Side'
    ],
    'client' => [
        'items' => [
            'javascript' => [
                'label' => 'JavaScript',
                'services' => [
                    'Ecmascript 6',
                    'VueJS'
                ]
            ],
            'android' => [
                'label' => 'Android',
                'services' => [
                    'Java Basic',
                    'Android SDK'
                ]
            ],
            'ios' => [
                'label' => 'iOS',
                'services' => [
                    'Swift Basic',
                    'Cocoa Framework'
                ]
            ]
        ],
        'label' => 'Client-Side'
    ]
];

$template = <<<HTML
<h1>Предлагаемые услуги:</h1>
    <ul class="nav nav-tabs" role="tablist">
        {{tab}}
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#tab-{{index}}" role="tab" aria-controls="home" aria-selected="true">{{label}}</a>
            </li>
        {{/tab}}
    </ul>
    <div class="tab-content">
        {{content}}
            <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="home-tab">
                <div class="card d-inline-block" style="width: 18rem;">
                    <img class="card-img-top" src="https://dummyimage.com/250/000000/ffffff" alt="{{title}}">
                    <div class="card-body">
                        <h5 class="card-title">{{title}}</h5>
                        <p class="card-text">
                        <ul class="list-group list-group-flush">
                            {{services}}
                                <li class="list-group-item">{{service-title}}</li>
                            {{/services}}
                        </ul>
                        </p>
                        <a href="#" class="btn btn-primary">Записаться</a>
                    </div>
                </div>
            </div>
        {{/content}}
    </div>
HTML
;

$searchTab = '/\{\{tab\}\}.*\{\{\/tab\}\}/ms';
preg_match($searchTab, $template, $stab);
$tab = $stab[0];
$searchContent = '/\{\{content\}\}.*\{\{\/content\}\}/ms';
preg_match($searchContent, $template, $scont);
$cont = scont[0];
$index = 1;

foreach($data as $value){
    $label = $value['label'];
    $patterns[0] = '/\{\{index\}\}/ms';
    $patterns[1] = '/\{\{label\}\}/ms';
    $replacements[0] = $index;
    $replacements[1] = $label;
    if($index != 1) {
        $patterns[2] = '/class="nav-link active"/';
        $replacements[2] = 'class="nav-link"';
    }
    $newTab = preg_replace($patterns, $replacements, $tab);
    $tabs = $tabs . $newTab;

    foreach($value as $key => $lang){

        if($key == "items"){
            $newCont = preg_replace('/\{\{title\}\}/', $lang['label'], $cont)
            
        }

    }

    $index++;
}

$pattabs[0] = '/\{\{tab\}\}/';
$pattabs[1] = '/\{\{\/tab\}\}/';
$replasetab[0] = '';
$replasetab[1] = '';
$tabs = preg_replace($pattabs, $replasetab, $tabs);

$content = preg_replace($searchTab, $tabs, $template);





/*
$patterns['0'] = '/\{\{tab\}\}/';
$replacements['0'] = '<?for($i = 0; $i < count($data); $i++):?>';
$patterns['1'] = '/\{\{\/tab\}\}/';
$replacements['1'] = '<?endfor;?>';
$patterns['2'] = '/\{\{label\}\}/';
$replacements['2'] = '<?=$data[\'$i\'][\'label\']?>';
$patterns['3'] = '/\{\{index\}\}/';
$replacements['3'] = '$i';
ksort($patterns);
ksort($replacements);
$content = preg_replace($patterns, $replacements, $template);
*/
