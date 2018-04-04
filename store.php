<?php
$data = [
    'server' => [
        'items' => [
            'php' => [
                'label' => 'PHP',
                'services' => [                   
                        'PHP Basic',
                        'PHP Yii2',
                        'PHP Laravel',
                        'PHP Symfony',
                        'PHP Cake',
                        'PHP Zend'     
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
            <div class="tab-pane fade show active" id="tab-{{index}}" role="tabpanel" aria-labelledby="home-tab">
            {{block}}
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
                {{/block}}
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
$cont = $scont[0];
$searchBlock = '/\{\{block\}\}.*\{\{\/block\}\}/ms';
preg_match($searchBlock, $template, $sblock);
$block = $sblock[0];
$searchServices = '/\{\{services\}\}.*\{\{\/services\}\}/s';

$index = 1;

foreach($data as $value){
    $label = $value['label'];
    $patterns[0] = '/\{\{index\}\}/';
    $patterns[1] = '/\{\{label\}\}/';
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
            foreach($lang as $langItems) {
               foreach($langItems as $lastServices){
                    preg_match($searchServices, $block, $sserv);
                    $service = $sserv[0];
                    for($i = 0; $i < count($lastServices); $i++){
                    $newServise = preg_replace('/\{\{service-title\}\}/', $lastServices[$i], $service);
                    $services = $services . $newServise;
                    $newBlock = preg_replace($searchServices, $services, $block);
                    }
               }
            $newBlock = preg_replace('/\{\{title\}\}/', $langItems['label'], $newBlock);
            $blocks = $blocks . $newBlock;
            }           
        }              
    }
    $pathtml[0] = '/\{\{index\}\}/';
    $replasehtml[0] = $index;
    if(isset($contents)){
        $pathtml[1] = '/class="tab-pane fade show active"/';
        $replasehtml[1] = 'class="tab-pane fade"';
                }
    $newCont = preg_replace($pathtml, $replasehtml, $cont);
    $newCont = preg_replace($searchBlock, $blocks, $newCont);
    $contents = $contents . $newCont;
    
    $index++;
}

$pattabs[0] = '/\{\{tab\}\}/';
$pattabs[1] = '/\{\{\/tab\}\}/';
$replasetab[0] = '';
$replasetab[1] = '';
$tabs = preg_replace($pattabs, $replasetab, $tabs);

$patcont[0] = '/\{\{content\}\}/';
$patcont[1] = '/\{\{\/content\}\}/';
$patcont[2] = '/\{\{services\}\}/';
$patcont[3] = '/\{\{\/services\}\}/';
$patcont[4] = '/\{\{block\}\}/';
$patcont[5] = '/\{\{\/block\}\}/';
$replasecont[0] = '';
$replasecont[1] = '';
$replasecont[2] = '';
$replasecont[3] = '';
$replasecont[4] = '';
$replasecont[5] = '';
$contents = preg_replace($patcont, $replasecont, $contents);

$patrelease[0] = $searchTab;
$patrelease[1] = $searchContent;
$reprelease[0] = $tabs;
$reprelease[1] = $contents;
$releaseСontent = preg_replace($patrelease, $reprelease, $template);

$content = $releaseСontent;
