<?php
class Relative {
    static function getRelativeOrderByRating($postId, $relativePostType, $relativeKey) {
        $postsIds = [];
        $query = new WP_Query( array(
            'posts_per_page' => -1,
            'post_type'    => $relativePostType,
            'post_status'  => 'publish',
            'meta_query' => array(
                'relative' => array(
                    'key'   => '_'.$relativeKey,
                    'value' => $postId,
                ),
                'rating' => array(
                    'key'  => '_rating',
                    'type' => 'NUMERIC'
                )
            ),
            'orderby' => ['rating'=>'DESC']
        ));
        if(!empty($query->posts)) {
            foreach ($query->posts as $item) $postsIds[] = $item->ID;
        }
        return $postsIds;
    }
    static function getAllBonusesCasino($casinoId) {
        $postsIds = [];
        $query = new WP_Query( array(
            'posts_per_page' => -1,
            'post_type'    => 'bonus',
            'post_status'  => 'publish',
            'meta_query' => array(
                'relative' => array(
                    'key'   => '_relative_casino',
                    'value' => $casinoId,
                )
            )
        ));
        if(!empty($query->posts)) {
            foreach ($query->posts as $item) $postsIds[] = $item->ID;
        }
        return $postsIds;
    }
    static function getRelative($postId, $relativePostType, $relativeKey) {
        $postsIds = [];
        $query = new WP_Query( array(
            'posts_per_page' => -1,
            'post_type'    => $relativePostType,
            'post_status'  => 'publish',
            'meta_query' => array(
                'relative' => array(
                    'key'   => '_'.$relativeKey,
                    'value' => $postId,
                ),
            )
        ));
        if(!empty($query->posts)) {
            foreach ($query->posts as $item) $postsIds[] = $item->ID;
        }
        return $postsIds;
    }
}
class BaseService  {
    public $currentPost;
	function __construct($id) {
        $this->currentPost = get_post($id);
    }
    function commonData() {
        return [
            'id'           => $this->currentPost->ID,
            'status'       => 'public',
            'title'        => $this->currentPost->post_title,
            'meta_title'   => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['META_TITLE']),
            'description'  => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['DESCRIPTION']),
            'keywords'     => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['KEYWORDS']),
            'h1'           => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['H1']),
            'content'      => $this->currentPost->post_content,
            'amp_content'  => parseAmpContent($this->currentPost->post_content),
            'thumbnail'    => (string)get_the_post_thumbnail_url($this->currentPost->ID, 'full'),
            'created_at'   => $this->currentPost->post_date,
            'updated_at'   => $this->currentPost->post_modified,
            'index_seo'    => (int)carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['INDEX_SEO']),
            'follow'       => (int)carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['FOLLOW']),
            'short_desc'   => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['SHORT_DESC']),
            'permalink'    => $this->currentPost->post_name,
            'hreflang'     => carbon_get_post_meta($this->currentPost->ID, FIELDS_KEY['HEADERS_META_LANG']),
            'author_name'  => carbon_get_post_meta(AUTHOR_PAGE_ID, FIELDS_KEY['H1']),
        ];
    }
    function show() {
        return array_merge($this->commonData(), $this->meta(), $this->relative());
    }
    function meta() {
        return [];
    }
    function relative() {
        return [];
    }
}
/* adapters */
function optionsRefAdapter($arr) {
    $data = [];
    foreach ($arr as $item) $data[] = $item['link'];
    return $data;
}
function postRefAdapter($arr) {
    $data = [];
    foreach ($arr as $item) $data[] = $item['ref_link'];
    return $data;
}
/* adapters */
function parseAmpContent($content) {
    $content = str_replace('<picture></picture>', '', $content);
    preg_match_all('|<picture>(.+?)<\/picture>|is', $content, $contentPictureData);
    for($i=0; $i<count($contentPictureData); $i++) {
        $content = str_replace($contentPictureData[$i], '', $content);
    }
    $parseImages = preg_match_all('/<img.*?src="([^"]+)".*?(?:data-original="([^"]+)".*?)?>/i', $content, $contentImagesData);
    $ampImageArr = [];
    foreach ($contentImagesData[0] as $key => $contentImageData) {
        $imageSrc = !empty($contentImagesData[1][$key]) ? $contentImagesData[1][$key] : '';
        $imageSrc = !empty($contentImagesData[2][$key]) ? $contentImagesData[2][$key] : $imageSrc;
        $imageInfo = getimagesize( $imageSrc);
        $imageSize = !empty($imageInfo[3]) ? $imageInfo[3] : 'width="520" height="180"';
        $imageAlt =  preg_match('/<img.*?alt="([^"]+).*?>/i', $contentImageData, $parseAlt);
        $imageAlt = !empty($parseAlt[1]) ? 'alt="' . $parseAlt[1]  . '"' : '';
        $ampImage = '<amp-img layout="responsive" ';
        $ampImage .= $imageSize;
        $ampImage .= ' src="' . $imageSrc . '"';
        $ampImage .= $imageAlt;
        $ampImage .= '></amp-img>';
        $replaceString = htmlentities($contentImageData);
        $content = str_replace($contentImageData, $ampImage, $content);
    }
    $parsedLinks = preg_match_all('/<a.*?href="([^"]+)".*?>.*?<\/a>/i', $content, $contentLinksData);
    foreach ($contentLinksData[0] as $key => $linkData){
        if ( strpos($contentLinksData[1][$key] ,'#')  !== 0 && !strpos($contentLinksData[1][$key] ,'amp')){
            if(strpos($contentLinksData[1][$key] ,'http')  !== 0 && $contentLinksData[1][$key] !== '/go/') {
                $content = str_replace('href="' . $contentLinksData[1][$key] . '"', 'href="/amp' . rtrim($contentLinksData[1][$key], '/') . '"', $content);
            }
        }
    }
    $content = str_replace('<iframe', '<amp-iframe', $content);
    $content = str_replace('</iframe', '</amp-iframe', $content);
    $content = str_replace("100%", '300px', $content);
    $content = preg_replace('/xml:lang=".*?"/i', '', $content);
    return $content;
}
/* Settings */
function getSettings() {
    return [
        [
            'key' => SETTINGS_KEYS['FOOTER_TEXT'],
            'value' => carbon_get_theme_option( SETTINGS_KEYS['FOOTER_TEXT'] ),
        ],
        [
            'key' => SETTINGS_KEYS['HEADER_MENU'],
            'value' => carbon_get_theme_option( SETTINGS_KEYS['HEADER_MENU'] ),
        ],
        [
            'key' => SETTINGS_KEYS['FOOTER_MENU'],
            'value' => carbon_get_theme_option( SETTINGS_KEYS['FOOTER_MENU'] ),
        ],
        [
            'key' => SETTINGS_KEYS['MAIN_PAGE_FAQ'],
            'value' => carbon_get_theme_option( SETTINGS_KEYS['MAIN_PAGE_FAQ'] ),
        ],
        [
            'key' => SETTINGS_KEYS['PARTNERS_MENU'],
            'value' => carbon_get_theme_option( SETTINGS_KEYS['PARTNERS_MENU'] ),
        ],
        [
            'key' => SETTINGS_KEYS['CASINO_PAGE_FAQ'],
            'value' => carbon_get_theme_option( SETTINGS_KEYS['CASINO_PAGE_FAQ'] ),
        ],
        [
            'key' => SETTINGS_KEYS['BONUS_PAGE_FAQ'],
            'value' => carbon_get_theme_option( SETTINGS_KEYS['BONUS_PAGE_FAQ'] ),
        ],
        [
            'key' => SETTINGS_KEYS['POKER_PAGE_FAQ'],
            'value' => carbon_get_theme_option( SETTINGS_KEYS['POKER_PAGE_FAQ'] ),
        ],
        [
            'key' => SETTINGS_KEYS['BANNER'],
            'value' => carbon_get_theme_option( SETTINGS_KEYS['BANNER'] ),
        ],
        [
            'key' => SETTINGS_KEYS['GAME_PAGE_FAQ'],
            'value' => carbon_get_theme_option( SETTINGS_KEYS['GAME_PAGE_FAQ'] ),
        ],
        [
            'key' => SETTINGS_KEYS['SOCIAL_LINKS_AUTHOR'],
            'value' => carbon_get_theme_option( SETTINGS_KEYS['SOCIAL_LINKS_AUTHOR'] ),
        ],
    ];
}
/* Options */
function getOptions() {
    return [
        [
            'key' => OPTIONS_KEYS['LOGO'],
            'value' => carbon_get_theme_option( OPTIONS_KEYS['LOGO'] ),
        ],
        [
            'key' => OPTIONS_KEYS['GLOBAL_REF'],
            'value' => optionsRefAdapter(carbon_get_theme_option( OPTIONS_KEYS['GLOBAL_REF'] ))
        ]
    ];
}
/* Post cards */
function get_casino_card_data($arr_id) {
    $data = [];
    foreach ($arr_id as $item) {
        $casinoPost = get_post( $item );
        $refData = carbon_get_post_meta($item, 'ref');
        $licenseIds = carbon_get_post_meta($item, 'relative_license');
        $licenses = [];
        if(!empty($licenseIds)) {
            $licensePost = get_post( $licenseIds[0] );
            $licenses = [
                'title' => $licensePost->post_title
            ]; 
        }
        $data[] = [
            'title'     => $casinoPost->post_title,
            'ref'       => postRefAdapter($refData),
            'rating'    => (int)carbon_get_post_meta($item, 'rating'),
            'permalink' => "/casino/".$casinoPost->post_name,
            'thumbnail' => (string)get_the_post_thumbnail_url($item, 'full'),
            'close'     => (int)carbon_get_post_meta($item, 'close'),
            'licenses'  => $licenses
        ];
    }
    return $data;
}
function get_casino_sidebar_card_data($arr_id) {
    $data = [];
    foreach ($arr_id as $item) {
        $casinoPost = get_post( $item );
        $refData = carbon_get_post_meta($item, 'ref');
        $data[] = [
            'title'      => $casinoPost->post_title,
            'ref'        => postRefAdapter($refData),
            'rating'     => (int)carbon_get_post_meta($item, 'rating'),
            'short_desc' => (string)carbon_get_post_meta($item, 'short_desc'),
            'permalink'  => "/casino/".$casinoPost->post_name,
            'thumbnail'  => (string)get_the_post_thumbnail_url($item, 'full'),
        ];
    }
    return $data;
}
function get_slot_card_data($arr_id) {
    $data = [];
    foreach ($arr_id as $item) {
        $slotPost = get_post( $item );
        $vendorsIds = carbon_get_post_meta($item, 'relative_vendor');
        $vendor = [];
        if(!empty($vendorsIds)) {
            $vendorPost = get_post( $vendorsIds[0] );
            $vendor = [
                'title' => $vendorPost->post_title
            ]; 
        }
        $data[] = [
            'title'     => get_the_title($item),
            'permalink' => "/game/".$slotPost->post_name,
            'thumbnail' => (string)get_the_post_thumbnail_url($item, 'full'),
            'vendor'    => $vendor
        ];
    }
    return $data;
}
function get_currency_card_data($arr_id) {
    $data = [];
    foreach ($arr_id as $item) {
        $currencyPost = get_post( $item );
        $data[] = [
            'title'     => get_the_title($item),
            'permalink' => "/currency/".$currencyPost->post_name,
            'thumbnail' => (string)get_the_post_thumbnail_url($item, 'full'),
            'sub_title' => carbon_get_post_meta($item, 'sub_title')
        ];
    }
    return $data;
}
function get_country_card_data($arr_id) {
    $data = [];
    foreach ($arr_id as $item) {
        $countryPost = get_post( $item );
        $data[] = [
            'title'     => get_the_title($item),
            'permalink' => "/country/".$countryPost->post_name,
            'thumbnail' => get_the_post_thumbnail_url($item, 'full'),
        ];
    }
    return $data;
}
function get_type_payment_card_data($arr_id) {
    $data = [];
    foreach ($arr_id as $item) {
        $typePaymentPost = get_post( $item );
        $data[] = [
            'title'     => get_the_title($item),
            'permalink' => "/type-payment/".$typePaymentPost->post_name,
            'thumbnail' => (string)get_the_post_thumbnail_url($item, 'full')
        ];
    }
    return $data;
}
function get_type_bonus_card_data($arr_id) {
    $data = [];
    foreach ($arr_id as $item) {
        $typeBonusPost = get_post( $item );
        $data[] = [
            'title'     => get_the_title($item),
            'permalink' => "/type-bonus/".$typeBonusPost->post_name,
            'thumbnail' => (string)get_the_post_thumbnail_url($item, 'full')
        ];
    }
    return $data;
}
function get_bonus_card_data($arr_id) {
    $data = [];
    foreach ($arr_id as $item) {
        $thumbnail = '';
        $casino = [];
        $casinoIds = carbon_get_post_meta($item, 'relative_casino');
        if(!empty($casinoIds)) {
            $casinoPost = get_post( $casinoIds[0] );
            $thumbnail = get_the_post_thumbnail_url($casinoIds[0], 'full');
            $casino['thumbnail'] = $thumbnail;
            $casino['title'] = $casinoPost->post_title;
        } 
        $type_bonus = get_type_bonus_card_data(carbon_get_post_meta($item, 'relative_type_bonus'));
        $bonusPost = get_post( $item );
        $data[] = [
            'title'      => get_the_title($item),
            'permalink'  => "/bonus/".$bonusPost->post_name,
            'ref'        => postRefAdapter(carbon_get_post_meta($item, 'ref')),
            'thumbnail'  => $thumbnail,
            'close'      => (int)carbon_get_post_meta($item, 'close'),
            'type_bonus' => $type_bonus,
            'value'      => carbon_get_post_meta($item, 'value_bonus'),
            'casino'     => $casino
        ];
    }
    return $data;
}
function get_payment_card_data($arr_id) {
    $data = [];
    foreach ($arr_id as $item) {
        $paymentPost = get_post( $item );
        $data[] = [
            'title'     => get_the_title($item),
            'permalink' => "/payment/".$paymentPost->post_name,
            'thumbnail' => (string)get_the_post_thumbnail_url($item, 'full')
        ];
    }
    return $data;
}
function get_technology_card_data($arr_id) {
    $data = [];
    foreach ($arr_id as $item) {
        $paymentPost = get_post( $item );
        $data[] = [
            'title'     => get_the_title($item),
            'permalink' => "/technology/".$paymentPost->post_name,
            'thumbnail' => (string)get_the_post_thumbnail_url($item, 'full')
        ];
    }
    return $data;
}
function get_license_card_data($arr_id) {
    $data = [];
    foreach ($arr_id as $item) {
        $paymentPost = get_post( $item );
        $data[] = [
            'title'     => get_the_title($item),
            'permalink' => "/license/".$paymentPost->post_name,
            'thumbnail' => (string)get_the_post_thumbnail_url($item, 'full')
        ];
    }
    return $data;
}
function get_language_card_data($arr_id) {
    $data = [];
    foreach ($arr_id as $item) {
        $paymentPost = get_post( $item );
        $data[] = [
            'title'     => get_the_title($item),
            'permalink' => "/language/".$paymentPost->post_name,
            'thumbnail' => (string)get_the_post_thumbnail_url($item, 'full')
        ];
    }
    return $data;
}
function get_poker_card_data($arr_id) {
    $data = [];
    foreach ($arr_id as $item) {
        $pokerPost = get_post( $item );
        $refData = carbon_get_post_meta($item, 'ref');
        $data[] = [
            'title'     => $pokerPost->post_title,
            'ref'       => postRefAdapter($refData),
            'rating'    => (int)carbon_get_post_meta($item, 'rating'),
            'permalink' => "/poker/".$pokerPost->post_name,
            'thumbnail' => (string)get_the_post_thumbnail_url($item, 'full'),
        ];
    }
    return $data;
}
function get_vendor_card_data($arr_id) {
    $data = [];
    foreach ($arr_id as $item) {
        $paymentPost = get_post( $item );
        $data[] = [
            'title'     => get_the_title($item),
            'permalink' => "/vendor/".$paymentPost->post_name,
            'thumbnail' => (string)get_the_post_thumbnail_url($item, 'full')
        ];
    }
    return $data;
}
/* Post cards end */
/* Support functions */
function get_public_post_id_by_rating($post_type, $limit = -1, $executeIds = []) {
    $arr_id = [];
    $query = new WP_Query( array(
        'posts_per_page' => $limit,
        'post_type'      => $post_type,
        'post_status'    => 'publish',
        'orderby'        => 'meta_value_num',
        'order'          => 'DESC',
        'post__not_in'    => $executeIds,
        'meta_query' => array(
            array(
                'key' => '_rating',
            )
        ),
    ));
    if(empty($query->posts)) return $arr_id;
    foreach ($query->posts as $item ) $arr_id[] = $item->ID;
    return $arr_id;
}
function get_public_post_id($post_type, $limit = -1, $executeIds = []) {
    $arr_id = [];
    $query = new WP_Query( array(
        'posts_per_page' => $limit,
        'post_type'      => $post_type,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
        'post__not_in'   => $executeIds,
    ));
    if(empty($query->posts)) return $arr_id;
    foreach ($query->posts as $item ) $arr_id[] = $item->ID;
    return $arr_id;
}
function url_to_post_id($url, $post_type) {
    $query = new WP_Query( array(
        'post_type'         => $post_type,
        'name'              => $url,
        'post_status'       => 'publish'
    ));
    if(!isset($query->post)) return 0;
    else return $query->post->ID;
}
/* Support functions end */