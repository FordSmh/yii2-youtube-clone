<?php echo \yii\bootstrap5\Nav::widget([
        'options' => [
                'class' => 'd-flex flex-column flex-shrink-0 p-3 bg-dark h-100 nav-tabs h-100'
        ],
        'items' => [
            [
                    'label' => 'Dashboard',
                    'url' => ['site/index']
            ],
            [
                    'label' => 'Videos',
                    'url' => ['videos/index']
            ],
            [
                    'label' => 'Your channel',
                    'url' => Yii::$app->urlManagerFrontend->createAbsoluteUrl(['channel/my'])
            ]
        ]
])?>