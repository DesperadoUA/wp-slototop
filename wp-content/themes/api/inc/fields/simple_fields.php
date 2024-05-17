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
            'key' => FIELDS_KEY['META_TITLE'],
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Meta description',
            'label' => 'Meta description',
            'post_types' => ALL_POST_TYPES,
            'key' => FIELDS_KEY['DESCRIPTION'],
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Meta keywords',
            'label' => 'Meta keywords',
            'post_types' => ALL_POST_TYPES,
            'key' => FIELDS_KEY['KEYWORDS'],
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Index',
            'label' => 'Index',
            'post_types' => ALL_POST_TYPES,
            'key' => FIELDS_KEY['INDEX_SEO'],
            'editor' => 'checkbox',
            'default' => true
        ],
        [
            'container_label' => 'Follow',
            'label' => 'Follow',
            'post_types' => ALL_POST_TYPES,
            'key' => FIELDS_KEY['FOLLOW'],
            'editor' => 'checkbox',
            'default' => true
        ],
        [
            'container_label' => 'Short desc',
            'label' => 'Short desc',
            'post_types' => ALL_POST_TYPES,
            'key' => FIELDS_KEY['SHORT_DESC'],
            'editor' => 'textarea',
            'default' => ''
        ],
        [
            'container_label' => 'H1',
            'label' => 'H1',
            'post_types' => ALL_POST_TYPES,
            'key' => FIELDS_KEY['H1'],
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Withdrawal',
            'label' => 'Withdrawal',
            'post_types' => ['casino', 'poker', 'payment'],
            'key' => FIELDS_KEY['WITHDRAWAL'],
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Phone',
            'label' => 'Phone',
            'post_types' => ['casino', 'poker'],
            'key' => FIELDS_KEY['PHONE'],
            'editor' => 'text',
            'default' => '',
        ],
        [
            'container_label' => 'Rating',
            'label' => 'Rating max 100',
            'post_types' => ['casino', 'poker', 'vendor', 'slot'],
            'key' => FIELDS_KEY['RATING'],
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Close',
            'label' => 'Close',
            'post_types' => ['casino', 'bonus'],
            'key' => FIELDS_KEY['CLOSE'],
            'editor' => 'checkbox',
            'default' => false
        ],
        [
            'container_label' => 'Min dep',
            'label' => 'Min dep',
            'post_types' => ['casino', 'poker'],
            'key' => FIELDS_KEY['MIN_DEPOSIT'],
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Email',
            'label' => 'Email',
            'post_types' => ['casino', 'poker'],
            'key' => FIELDS_KEY['EMAIL'],
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Min payment',
            'label' => 'Min payment',
            'post_types' => ['casino', 'poker'],
            'key' => FIELDS_KEY['MIN_PAYMENTS'],
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Chat',
            'label' => 'Chat',
            'post_types' => ['casino', 'poker'],
            'key' => FIELDS_KEY['CHAT'],
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Year',
            'label' => 'Year',
            'post_types' => ['casino', 'poker', 'vendor'],
            'key' => FIELDS_KEY['YEAR'],
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Site',
            'label' => 'Site',
            'post_types' => ['casino', 'poker', 'payment'],
            'key' => FIELDS_KEY['SITE'],
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Number games',
            'label' => 'Number games',
            'post_types' => ['casino', 'vendor'],
            'key' => FIELDS_KEY['NUMBER_GAMES'],
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Promo code',
            'label' => 'Promo code',
            'post_types' => ['casino'],
            'key' => FIELDS_KEY['PROMOCODE'],
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Надежность',
            'label' => 'Надежность max 100',
            'post_types' => ['casino'],
            'key' => FIELDS_KEY['RELIABILITY'],
            'editor' => 'text',
            'default' => '0'
        ],
        [
            'container_label' => 'Удобство платежей',
            'label' => 'Удобство платежей max 100',
            'post_types' => ['casino'],
            'key' => FIELDS_KEY['CONVENIENCE_PAYMENTS'],
            'editor' => 'text',
            'default' => '0'
        ],
        [
            'container_label' => 'Интерфейс',
            'label' => 'Интерфейс max 100',
            'post_types' => ['casino'],
            'key' => FIELDS_KEY['INTERFACE'],
            'editor' => 'text',
            'default' => '0'
        ],
        [
            'container_label' => 'Support',
            'label' => 'Support max 100',
            'post_types' => ['casino'],
            'key' => FIELDS_KEY['SUPPORT'],
            'editor' => 'text',
            'default' => '0'
        ],
        [
            'container_label' => 'Популярность',
            'label' => 'Популярность',
            'post_types' => ['casino'],
            'key' => FIELDS_KEY['POPULARITY'],
            'editor' => 'text',
            'default' => '0'
        ],
        [
            'container_label' => 'Бонусы и акции',
            'label' => 'Бонусы и акции max 100',
            'post_types' => ['casino'],
            'key' => FIELDS_KEY['SHARES'],
            'editor' => 'text',
            'default' => '0'
        ],
        [
            'container_label' => 'Sub title',
            'label' => 'Sub title',
            'post_types' => ['country', 'currency', 'language', 'license', 'technology', 'type_payment', 'type_bonus'],
            'key' => FIELDS_KEY['SUB_TITLE'],
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'License',
            'label' => 'License',
            'post_types' => ['vendor'],
            'key' => FIELDS_KEY['LICENSE'],
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Commission',
            'label' => 'Commission',
            'post_types' => ['payment'],
            'key' => FIELDS_KEY['COMMISSION'],
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Withdrawal period',
            'label' => 'Withdrawal period',
            'post_types' => ['payment'],
            'key' => FIELDS_KEY['WITHDRAWAL_PERIOD'],
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Jackpot',
            'label' => 'Jackpot',
            'post_types' => ['slot'],
            'key' => FIELDS_KEY['JACKPOT'],
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Risk game',
            'label' => 'Risk game',
            'post_types' => ['slot'],
            'key' => FIELDS_KEY['RISK_GAME'],
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Max gain',
            'label' => 'Max gain',
            'post_types' => ['slot'],
            'key' => FIELDS_KEY['MAX_GAIN'],
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Max bet',
            'label' => 'Max bet',
            'post_types' => ['slot'],
            'key' => FIELDS_KEY['MAX_BET'],
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Min bet',
            'label' => 'Min bet',
            'post_types' => ['slot'],
            'key' => FIELDS_KEY['MIN_BET'],
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Iframe',
            'label' => 'Iframe',
            'post_types' => ['slot'],
            'key' => FIELDS_KEY['IFRAME'],
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Wager',
            'label' => 'Wager',
            'post_types' => ['bonus'],
            'key' => FIELDS_KEY['WAGER'],
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Number use',
            'label' => 'Number use',
            'post_types' => ['bonus'],
            'key' => FIELDS_KEY['NUMBER_USE'],
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Value bonus',
            'label' => 'Value bonus',
            'post_types' => ['bonus'],
            'key' => FIELDS_KEY['VALUE_BONUS'],
            'editor' => 'text',
            'default' => ''
        ],
        [
            'container_label' => 'Rakeback',
            'label' => 'Rakeback',
            'post_types' => ['poker'],
            'key' => FIELDS_KEY['RAKEBACK'],
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