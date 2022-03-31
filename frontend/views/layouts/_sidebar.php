<?php use common\models\User;

echo \yii\bootstrap5\Nav::widget([
        'options' => [
                'class' => 'd-flex flex-column flex-shrink-0 p-3 bg-dark h-100 nav-pills h-100 text-nowrap'
        ],
        'items' => [
            [
                'label' => 'Home',
                'url' => ['videos/index']
            ],
            [
                'label' => 'Explore',
                'url' => ['videos/explore']
            ],
            [
                'label' => 'Subscriptions',
                'url' => ['videos/subscriptions']
            ],
            '<hr class="border">',
            [
                'label' => 'History',
                'url' => ['videos/history']
            ],
            [
                'label' => 'Your videos',
                'url' => ['channel/my']
            ],
            [
                'label' => 'Liked videos',
                'url' => ['videos/liked']
            ],
            '<hr class="border">',
            [
                'label' => 'Profile page',
                'url' => ['/profile/index']
            ],
            '<hr class="border">'
        ]
])?>