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
                        'PHP Symfony'   
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

// Вырезаем шаблон content
$searchContent = '/\{\{content\}\}.*\{\{\/content\}\}/ms';
preg_match($searchContent, $template, $scont);
$cont = $scont[0];

// Вырезаем шаблон block
$searchBlock = '/\{\{block\}\}.*\{\{\/block\}\}/ms';
preg_match($searchBlock, $template, $sblock);
$block = $sblock[0];

// Вырезаем шаблон services
$searchServices = '/\{\{services\}\}.*\{\{\/services\}\}/ms';
preg_match($searchServices, $template, $sserv);
$service = $sserv[0];

// Определяем начальный индекс табов
$index = 1;

//создаем новые блоки {{tab}} и {{content}}, определяем в них индексы и классы
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

// Определяем количество плейсхолдеров {{content}}
$searchIndexInContent = '/\{\{content\}\}.+(id="tab-\d").+\{\{\/content\}\}/sU';
preg_match_all($searchIndexInContent, $contents, $indexPocket);

//Создаем контент в {{block}} и {{services}}
foreach($data as $cliserv){    
    for($i = 0; $i < count($indexPocket[1]); $i++){         // перебираем количество плейсхолдеров {{content}}
        $testIndex = $i + 1;                                // Нужный нам id таба всегда будет равен значению $i+1
        if($cliserv['index'] == $testIndex){                // проверяем соответствие индексов
            $editContent = $indexPocket[0][$i];             // Выбираем для редактирования {{content}} с индексом, соответствующим индекусу массива
            foreach($cliserv['items'] as $languages){       // перебираем языки программирования
                $newBlock = $block;                         // создаем новый {{block}} и заполняем в нем {{title}}
                $newBlock = preg_replace('/\{\{title\}\}/', $languages['label'], $newBlock);
                foreach($languages['services'] as $serviceTitle){       // перебираем дисциплины
                    $newServise = $service;                 // создаем новый {{services}} и заполняем в нем {{service-title}}
                    $newServise = preg_replace('/\{\{service-title\}\}/', $serviceTitle, $newServise);
                    $services = $services . $newServise;    // объединяем плейсхолдеры {{services}}
                }
                $newBlock = preg_replace($searchServices, $services, $newBlock);  // заполняем и объединяем {{block}}
                $blocks = $blocks . $newBlock;
                $services = "";                             // обнуляем {{services}}
            }
            $contentWithBlocks = preg_replace($searchBlock, $blocks, $editContent);   // Заполняем проиндексировванный {{content}} 
            $allContents = $allContents . $contentWithBlocks;                         // объединяем плейсхолдеры {{content}}
            $blocks = "";                                   // обнуляем {{block}}
        }
    }    
}

$contents = $allContents;

// Удаляем символы плейсхолдеров
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