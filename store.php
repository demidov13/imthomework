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