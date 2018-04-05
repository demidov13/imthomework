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
        'label' => 'Server-Side',
        'index' => '1'
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
        'label' => 'Client-Side',
        'index' => '2'
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

// Вырезаем шаблон tab и удаляем плейсхолдеры
$searchTab = '/\{\{tab\}\}.*\{\{\/tab\}\}/ms';
preg_match($searchTab, $template, $stab);
$tab = $stab[0];
$pattabs[0] = '/\{\{tab\}\}/';
$pattabs[1] = '/\{\{\/tab\}\}/';
$replasetab[0] = '';
$replasetab[1] = '';
$tab = preg_replace($pattabs, $replasetab, $tab);

// Вырезаем шаблон content и удаляем плейсхолдеры
$searchContent = '/\{\{content\}\}.*\{\{\/content\}\}/ms';
preg_match($searchContent, $template, $scont);
$cont = $scont[0];
// $patcont[0] = '/\{\{content\}\}/';
// $patcont[1] = '/\{\{\/content\}\}/';
// $replasecont[0] = '';
// $replasecont[1] = '';
// $cont = preg_replace($patcont, $replasecont, $cont);

// Вырезаем шаблон block и удаляем плейсхолдеры
$searchBlock = '/\{\{block\}\}.*\{\{\/block\}\}/ms';
preg_match($searchBlock, $template, $sblock);
$block = $sblock[0];
// $patblock[0] = '/\{\{block\}\}/';
// $patblock[1] = '/\{\{\/block\}\}/';
// $replaseblock[0] = '';
// $replaseblock[1] = '';
// $block = preg_replace($patblock, $replaseblock, $block);

// Вырезаем шаблон services и удаляем плейсхолдеры
$searchServices = '/\{\{services\}\}.*\{\{\/services\}\}/ms';
preg_match($searchServices, $template, $sserv);
$service = $sserv[0];
// $patserv[0] = '/\{\{services\}\}/';
// $patserv[1] = '/\{\{\/services\}\}/';
// $replaseserv[0] = '';
// $replaseserv[1] = '';
// $service = preg_replace($patserv, $replaseserv, $service);

// Определяем начальный индекс табов
$index = 1;

//создаем блоки tab и content, определяем в них индексы и классы
foreach($data as $cliserv){
    $label = $cliserv['label'];
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
    
    $pathtml[0] = '/\{\{index\}\}/';
    $replasehtml[0] = $index;
    if(isset($contents)){
        $pathtml[1] = '/class="tab-pane fade show active"/';
        $replasehtml[1] = 'class="tab-pane fade"';
                }
    $newCont = preg_replace($pathtml, $replasehtml, $cont);
    $contents = $contents . $newCont;
    
    $index++;
}

// Определяем количество табов
$searchIndexInContent = '/\{\{content\}\}.+(id="tab-\d").+\{\{\/content\}\}/sU';
preg_match_all($searchIndexInContent, $contents, $indexPocket);

//Создаем блоки block и services
foreach($data as $cliserv){    
    for($i = 0; $i < count($indexPocket[1]); $i++){
        $testIndex = $i + 1;
        if($cliserv['index'] == $testIndex){
            $editContent = $indexPocket[0][$i];
            foreach($cliserv['items'] as $languages){
                $newBlock = $block;
                $newBlock = preg_replace('/\{\{title\}\}/', $languages['label'], $newBlock);
                foreach($languages['services'] as $serviceTitle){
                    $newServise = $service;
                    $newServise = preg_replace('/\{\{service-title\}\}/', $serviceTitle, $newServise);
                    $services = $services . $newServise;
                }
                $newBlock = preg_replace($searchServices, $services, $newBlock);
                $blocks = $blocks . $newBlock;
            }
            $contentWithBlocks = preg_replace($searchBlock, $blocks, $editContent);
            $allContents = $allContents . $contentWithBlocks;
        }
    }    
}
$contents = $allContents;

// Удаляем плейсхолдеры
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

//Заливаем контент в шаблон
$patrelease[0] = $searchTab;
$patrelease[1] = $searchContent;
$reprelease[0] = $tabs;
$reprelease[1] = $contents;
$releaseСontent = preg_replace($patrelease, $reprelease, $template);

//Запускаем контент
$content = $releaseСontent;
