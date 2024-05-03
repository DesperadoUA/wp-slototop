<?php
use Carbon_Fields\Container;
use Carbon_Fields\Field;
add_action('carbon_fields_register_fields', 'input_fields');
function input_fields() {
    $data = [
          [
            'container_label' => 'Meta title',
            'label' => 'Meta title',
            'post_types' => ALL_POST_TYPES,
            'key' => 'meta_title',
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Meta description',
            'label' => 'Meta description',
            'post_types' => ALL_POST_TYPES,
            'key' => 'description',
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Meta keywords',
            'label' => 'Meta keywords',
            'post_types' => ALL_POST_TYPES,
            'key' => 'keywords',
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Index',
            'label' => 'Index',
            'post_types' => ALL_POST_TYPES,
            'key' => 'index_seo',
            'editor' => 'checkbox',
            'default' => true
        ],
        [
            'container_label' => 'Follow',
            'label' => 'Follow',
            'post_types' => ALL_POST_TYPES,
            'key' => 'follow',
            'editor' => 'checkbox',
            'default' => true
        ],
        [
            'container_label' => 'Short desc',
            'label' => 'Short desc',
            'post_types' => ALL_POST_TYPES,
            'key' => 'short_desc',
            'editor' => 'textarea',
            'default' => ''
        ],
        [
            'container_label' => 'H1',
            'label' => 'H1',
            'post_types' => ALL_POST_TYPES,
            'key' => 'h1',
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Withdrawal',
            'label' => 'Withdrawal',
            'post_types' => ['casino', 'poker', 'payment'],
            'key' => 'withdrawal',
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Phone',
            'label' => 'Phone',
            'post_types' => ['casino', 'poker'],
            'key' => 'phone',
            'editor' => 'text',
            'default' => '',
        ],
        [
            'container_label' => 'Rating',
            'label' => 'Rating max 100',
            'post_types' => ['casino', 'poker', 'vendor', 'slot'],
            'key' => 'rating',
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Close',
            'label' => 'Close',
            'post_types' => ['casino', 'bonus'],
            'key' => 'close',
            'editor' => 'checkbox',
            'default' => false
        ],
        [
            'container_label' => 'Min dep',
            'label' => 'Min dep',
            'post_types' => ['casino', 'poker'],
            'key' => 'min_deposit',
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Email',
            'label' => 'Email',
            'post_types' => ['casino', 'poker'],
            'key' => 'email',
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Min payment',
            'label' => 'Min payment',
            'post_types' => ['casino', 'poker'],
            'key' => 'min_payments',
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Chat',
            'label' => 'Chat',
            'post_types' => ['casino', 'poker'],
            'key' => 'chat',
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Year',
            'label' => 'Year',
            'post_types' => ['casino', 'poker', 'vendor'],
            'key' => 'year',
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Site',
            'label' => 'Site',
            'post_types' => ['casino', 'poker', 'payment'],
            'key' => 'site',
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Number games',
            'label' => 'Number games',
            'post_types' => ['casino', 'vendor'],
            'key' => 'number_games',
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Promo code',
            'label' => 'Promo code',
            'post_types' => ['casino'],
            'key' => 'promocode',
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Надежность',
            'label' => 'Надежность max 100',
            'post_types' => ['casino'],
            'key' => 'reliability',
            'editor' => 'text',
            'default' => '0'
        ],
        [
            'container_label' => 'Удобство платежей',
            'label' => 'Удобство платежей max 100',
            'post_types' => ['casino'],
            'key' => 'convenience_payments',
            'editor' => 'text',
            'default' => '0'
        ],
        [
            'container_label' => 'Интерфейс',
            'label' => 'Интерфейс max 100',
            'post_types' => ['casino'],
            'key' => 'interface',
            'editor' => 'text',
            'default' => '0'
        ],
        [
            'container_label' => 'Support',
            'label' => 'Support max 100',
            'post_types' => ['casino'],
            'key' => 'support',
            'editor' => 'text',
            'default' => '0'
        ],
        [
            'container_label' => 'Популярность',
            'label' => 'Популярность',
            'post_types' => ['casino'],
            'key' => 'popularity',
            'editor' => 'text',
            'default' => '0'
        ],
        [
            'container_label' => 'Бонусы и акции',
            'label' => 'Бонусы и акции max 100',
            'post_types' => ['casino'],
            'key' => 'shares',
            'editor' => 'text',
            'default' => '0'
        ],
        [
            'container_label' => 'Sub title',
            'label' => 'Sub title',
            'post_types' => ['country', 'currency', 'language', 'license', 'technology', 'type_payment', 'type_bonus'],
            'key' => 'sub_title',
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'License',
            'label' => 'License',
            'post_types' => ['vendor'],
            'key' => 'license',
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Commission',
            'label' => 'Commission',
            'post_types' => ['payment'],
            'key' => 'commission',
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Withdrawal period',
            'label' => 'Withdrawal period',
            'post_types' => ['payment'],
            'key' => 'withdrawal_period',
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Jackpot',
            'label' => 'Jackpot',
            'post_types' => ['slot'],
            'key' => 'jackpot',
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Risk game',
            'label' => 'Risk game',
            'post_types' => ['slot'],
            'key' => 'risk_game',
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Max gain',
            'label' => 'Max gain',
            'post_types' => ['slot'],
            'key' => 'max_gain',
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Max bet',
            'label' => 'Max bet',
            'post_types' => ['slot'],
            'key' => 'max_bet',
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Min bet',
            'label' => 'Min bet',
            'post_types' => ['slot'],
            'key' => 'min_bet',
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Iframe',
            'label' => 'Iframe',
            'post_types' => ['slot'],
            'key' => 'iframe',
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Wager',
            'label' => 'Wager',
            'post_types' => ['bonus'],
            'key' => 'wager',
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Number use',
            'label' => 'Number use',
            'post_types' => ['bonus'],
            'key' => 'number_use',
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Value bonus',
            'label' => 'Value bonus',
            'post_types' => ['bonus'],
            'key' => 'value_bonus',
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Rakeback',
            'label' => 'Rakeback',
            'post_types' => ['poker'],
            'key' => 'rakeback',
            'editor' => 'text',
            'default' => ''
        ],
    ];
    foreach ($data as $item) {
        Container::make('post_meta', $item['container_label'])
        ->show_on_post_type($item['post_types'])
        ->add_fields(array(
            Field::make($item['editor'], $item['key'], $item['label'])->set_default_value($item['default'])
        ));
    }
}