<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;
add_action('carbon_fields_register_fields', 'input_fields');
function input_fields() {
    $data = [
        [
            'container_label' => 'H1',
            'label' => 'H1',
            'post_types' => ALL_POST_TYPES,
            'key' => 'h1',
            'editor' => 'text'
        ],
        [
            'container_label' => 'Withdrawal',
            'label' => 'Withdrawal',
            'post_types' => ['casino', 'poker', 'payment'],
            'key' => 'withdrawal',
            'editor' => 'text'
        ],
        [
            'container_label' => 'Phone',
            'label' => 'Phone',
            'post_types' => ['casino', 'poker'],
            'key' => 'phone',
            'editor' => 'text'
        ],
        [
            'container_label' => 'Rating',
            'label' => 'Rating max 100',
            'post_types' => ['casino', 'poker', 'vendor', 'slot'],
            'key' => 'rating',
            'editor' => 'text'
        ],
        [
            'container_label' => 'Close',
            'label' => 'Close',
            'post_types' => ['casino', 'bonus'],
            'key' => 'close',
            'editor' => 'checkbox'
        ],
        [
            'container_label' => 'Min dep',
            'label' => 'Min dep',
            'post_types' => ['casino', 'poker'],
            'key' => 'min_dep',
            'editor' => 'text'
        ],
        [
            'container_label' => 'Email',
            'label' => 'Email',
            'post_types' => ['casino', 'poker'],
            'key' => 'email',
            'editor' => 'text'
        ],
        [
            'container_label' => 'Min payment',
            'label' => 'Min payment',
            'post_types' => ['casino', 'poker'],
            'key' => 'min_payment',
            'editor' => 'text'
        ],
        [
            'container_label' => 'Chat',
            'label' => 'Chat',
            'post_types' => ['casino', 'poker'],
            'key' => 'chat',
            'editor' => 'text'
        ],
        [
            'container_label' => 'Year',
            'label' => 'Year',
            'post_types' => ['casino', 'poker', 'vendor'],
            'key' => 'year',
            'editor' => 'text'
        ],
        [
            'container_label' => 'Site',
            'label' => 'Site',
            'post_types' => ['casino', 'poker', 'payment'],
            'key' => 'site',
            'editor' => 'text'
        ],
        [
            'container_label' => 'Number games',
            'label' => 'Number games',
            'post_types' => ['casino', 'vendor'],
            'key' => 'number_games',
            'editor' => 'text'
        ],
        [
            'container_label' => 'Promo code',
            'label' => 'Promo code',
            'post_types' => ['casino'],
            'key' => 'promocode',
            'editor' => 'text'
        ],
        [
            'container_label' => 'Надежность',
            'label' => 'Надежность max 100',
            'post_types' => ['casino'],
            'key' => 'reliability',
            'editor' => 'text'
        ],
        [
            'container_label' => 'Удобство платежей',
            'label' => 'Удобство платежей max 100',
            'post_types' => ['casino'],
            'key' => 'convenience_payments',
            'editor' => 'text'
        ],
        [
            'container_label' => 'Интерфейс',
            'label' => 'Интерфейс max 100',
            'post_types' => ['casino'],
            'key' => 'interface',
            'editor' => 'text'
        ],
        [
            'container_label' => 'Support',
            'label' => 'Support max 100',
            'post_types' => ['casino'],
            'key' => 'support',
            'editor' => 'text'
        ],
        [
            'container_label' => 'Популярность',
            'label' => 'Популярность',
            'post_types' => ['casino'],
            'key' => 'popularity',
            'editor' => 'text'
        ],
        [
            'container_label' => 'Бонусы и акции',
            'label' => 'Бонусы и акции max 100',
            'post_types' => ['casino'],
            'key' => 'shares',
            'editor' => 'text'
        ],
        [
            'container_label' => 'Sub title',
            'label' => 'Sub title',
            'post_types' => ['country', 'currency', 'language', 'license', 'technology', 'type_payment', 'type_bonus'],
            'key' => 'sub_title',
            'editor' => 'text'
        ],
        [
            'container_label' => 'License',
            'label' => 'License',
            'post_types' => ['vendor'],
            'key' => 'license',
            'editor' => 'text'
        ],
        [
            'container_label' => 'Commission',
            'label' => 'Commission',
            'post_types' => ['payment'],
            'key' => 'commission',
            'editor' => 'text'
        ],
        [
            'container_label' => 'Withdrawal period',
            'label' => 'Withdrawal period',
            'post_types' => ['payment'],
            'key' => 'withdrawal_period',
            'editor' => 'text'
        ],
        [
            'container_label' => 'Jackpot',
            'label' => 'Jackpot',
            'post_types' => ['slot'],
            'key' => 'jackpot',
            'editor' => 'text'
        ],
        [
            'container_label' => 'Risk game',
            'label' => 'Risk game',
            'post_types' => ['slot'],
            'key' => 'risk_game',
            'editor' => 'text'
        ],
        [
            'container_label' => 'Max gain',
            'label' => 'Max gain',
            'post_types' => ['slot'],
            'key' => 'max_gain',
            'editor' => 'text'
        ],
        [
            'container_label' => 'Max bet',
            'label' => 'Max bet',
            'post_types' => ['slot'],
            'key' => 'max_bet',
            'editor' => 'text'
        ],
        [
            'container_label' => 'Min bet',
            'label' => 'Min bet',
            'post_types' => ['slot'],
            'key' => 'min_bet',
            'editor' => 'text'
        ],
        [
            'container_label' => 'Iframe',
            'label' => 'Iframe',
            'post_types' => ['slot'],
            'key' => 'iframe',
            'editor' => 'text'
        ],
        [
            'container_label' => 'Wager',
            'label' => 'Wager',
            'post_types' => ['bonus'],
            'key' => 'wager',
            'editor' => 'text'
        ],
        [
            'container_label' => 'Number use',
            'label' => 'Number use',
            'post_types' => ['bonus'],
            'key' => 'number_use',
            'editor' => 'text'
        ],
        [
            'container_label' => 'Value bonus',
            'label' => 'Value bonus',
            'post_types' => ['bonus'],
            'key' => 'value_bonus',
            'editor' => 'text'
        ],
        [
            'container_label' => 'Rakeback',
            'label' => 'Rakeback',
            'post_types' => ['poker'],
            'key' => 'rakeback',
            'editor' => 'text'
        ],
    ];
    foreach ($data as $item) {
        Container::make('post_meta', $item['container_label'])
        ->show_on_post_type($item['post_types'])
        ->add_fields(array(
            Field::make($item['editor'], $item['key'], $item['label'])
        ));
    }
}