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
            'meta_title'   => carbon_get_post_meta($this->currentPost->ID, 'meta_title'),
            'description'  => carbon_get_post_meta($this->currentPost->ID, 'description'),
            'keywords'     => carbon_get_post_meta($this->currentPost->ID, 'keywords'),
            'h1'           => carbon_get_post_meta($this->currentPost->ID, 'h1'),
            'content'      => $this->currentPost->post_content,
            'amp_content'  => parseAmpContent($this->currentPost->post_content),
            'thumbnail'    => get_the_post_thumbnail_url($this->currentPost->ID, 'full'),
            'created_at'   => $this->currentPost->post_date,
            'updated_at'   => $this->currentPost->post_modified,
            'index_seo'    => (int)carbon_get_post_meta($this->currentPost->ID, 'index_seo'),
            'follow'       => (int)carbon_get_post_meta($this->currentPost->ID, 'follow'),
            'short_desc'   => carbon_get_post_meta($this->currentPost->ID, 'short_desc'),
            'permalink'    => $this->currentPost->post_name,
            'hreflang'     => carbon_get_post_meta($this->currentPost->ID, 'headers_meta_lang'),
            'author_name'  => carbon_get_post_meta(AUTHOR_PAGE_ID, 'h1'),
        ];
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
/*
function advantagesAdapter($arr) {
    $data = [];
    foreach ($arr as $item) $data[] = $item['advantages'];
    return $data;
}
function currenciesAdapter($arr) {
    $CURRENCY = include(ROOT_DIR.'/configs/currency.php');
    $data = [];
    foreach ($arr as $item) $data[] = ['title' => $CURRENCY[$item]['title']];
    return $data;
}
function langsAdapter($arr) {
    $LANG = include(ROOT_DIR.'/configs/languages.php');
    $data = [];
    foreach ($arr as $item) $data[] = ['title' => $LANG[$item]['title']];
    return $data;
}
*/
/*
function refAdapter($arr) {
    $data = [];
    foreach ($arr as $item) $data[] = $item['casino_ref'];
    return $data;
}
*/
/*
function paymentAdapter($arr) {
    $siteUrl = get_site_url();
    $PAYMENTS = include(ROOT_DIR.'/configs/payment.php');
    $data = [];
    foreach ($arr as $item) $data[] = ['thumbnail' => $siteUrl.$PAYMENTS[$item]['src'], 'title' => $PAYMENTS[$item]['title']];
    return $data;
}
function vendorAdapter($arr) {
    $siteUrl = get_site_url();
    $VENDORS = include(ROOT_DIR.'/configs/vendors.php');
    $data = [];
    foreach ($arr as $item) $data[] = ['thumbnail' => $siteUrl.$VENDORS[$item]['src'], 'title' => $VENDORS[$item]['title']];
    return $data;
}
*/
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
                $content = str_replace('href="' . $contentLinksData[1][$key] . '"', 'href="/amp' . rtrim($contentLinksData[1][$key], '/') . '/"', $content);
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
/*
function get_main_bonus_card_data($arr_id) {
    $data_posts = [];
    foreach ($arr_id as $item) {
        $refData = carbon_get_post_meta($item, 'ref');
        $ref = refAdapter($refData);
        $bg = carbon_get_post_meta($item, 'color');
        $label = carbon_get_post_meta($item, 'marker');
        $thumbnail = get_the_post_thumbnail_url($item, 'full');
        $rating = carbon_get_post_meta($item, 'rating');
        $bonusesData = carbon_get_post_meta($item, 'bonuses');
        foreach ($bonusesData as $itemBonus) {
             $data_posts[] = [
                 'bg' => $bg,
                 'label' => $label,
                 'src' => $thumbnail,
                 'title' => $itemBonus['bonuses_title'],
                 'value' => $itemBonus['bonuses_value'],
                 'desc' => $itemBonus['bonuses_sub_title'],
                 'ref' => $ref,
                 'rating' => $rating
             ];
        }
    }
    return $data_posts;
}
function get_aside_bonus_card_data($arr_id) {
    $data_posts = [];
    foreach ($arr_id as $item) {
        $refData = carbon_get_post_meta($item, 'ref');
        $ref = refAdapter($refData);
        $bg = carbon_get_post_meta($item, 'color');
        $label = carbon_get_post_meta($item, 'marker');
        $thumbnail = carbon_get_post_meta($item, 'icon');
        $bonusesData = carbon_get_post_meta($item, 'bonuses');
        foreach ($bonusesData as $itemBonus) {
             $data_posts[] = [
                 'bg' => $bg,
                 'label' => $label,
                 'src' => $thumbnail,
                 'title' => $itemBonus['bonuses_title'],
                 'value' => $itemBonus['bonuses_value'],
                 'ref' => $ref
             ];
        }
    }
    return $data_posts;
}
*/
function get_casino_card_data($arr_id) {
    $data = [];
    foreach ($arr_id as $item) {
        $post = get_post( $item );
        $refData = carbon_get_post_meta($item, 'ref');
        $licenseIds = carbon_get_post_meta($item, 'relative_license');
        $licenses = [];
        if(!empty($licenseIds)) {
            $post = get_post( $licenseIds[0] );
            $licenses = [
                'title' => $post->post_title
            ]; 
        }
        $data[] = [
            'title'     => get_the_title($item),
            'ref'       => postRefAdapter($refData),
            'rating'    => (int)carbon_get_post_meta($item, 'rating'),
            'permalink' => "/casino/".$post->post_name,
            'thumbnail' => (string)get_the_post_thumbnail_url($item, 'full'),
            'close'     => (int)carbon_get_post_meta($item, 'close'),
            'licenses'  => $licenses
        ];
    }
    return $data;
}
function get_slot_card_data($arr_id) {
    $data = [];
    foreach ($arr_id as $item) {
        $post = get_post( $item );
        $vendorsIds = carbon_get_post_meta($item, 'relative_vendor');
        $vendor = [];
        if(!empty($vendorsIds)) {
            $post = get_post( $vendorsIds[0] );
            $vendor = [
                'title' => $post->post_title
            ]; 
        }
        $data[] = [
            'title'     => get_the_title($item),
            'permalink' => "/game/".$post->post_name,
            'thumbnail' => (string)get_the_post_thumbnail_url($item, 'full'),
            'vendor'    => $vendor
        ];
    }
    return $data;
}
function get_currency_card_data($arr_id) {
    $data = [];
    foreach ($arr_id as $item) {
        $post = get_post( $item );
        $data[] = [
            'title'     => get_the_title($item),
            'permalink' => "/currency/".$post->post_name,
            'thumbnail' => (string)get_the_post_thumbnail_url($item, 'full'),
            'sub_title' => carbon_get_post_meta($item, 'sub_title')
        ];
    }
    return $data;
}
function get_country_card_data($arr_id) {
    $data = [];
    foreach ($arr_id as $item) {
        $post = get_post( $item );
        $data[] = [
            'title'     => get_the_title($item),
            'permalink' => "/country/".$post->post_name,
            'thumbnail' => get_the_post_thumbnail_url($item, 'full'),
        ];
    }
    return $data;
}
function get_type_payment_card_data($arr_id) {
    $data = [];
    foreach ($arr_id as $item) {
        $post = get_post( $item );
        $data[] = [
            'title'     => get_the_title($item),
            'permalink' => "/type-payment/".$post->post_name,
            'thumbnail' => (string)get_the_post_thumbnail_url($item, 'full')
        ];
    }
    return $data;
}
function get_type_bonus_card_data($arr_id) {
    $data = [];
    foreach ($arr_id as $item) {
        $post = get_post( $item );
        $data[] = [
            'title'     => get_the_title($item),
            'permalink' => "/type-bonus/".$post->post_name,
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
            $post = get_post( $casinoIds[0] );
            $thumbnail = get_the_post_thumbnail_url($casinoIds[0], 'full');
            $casino['thumbnail'] = $thumbnail;
            $casino['title'] = $post->post_title;
        } 
        $type_bonus = get_type_bonus_card_data(carbon_get_post_meta($item, 'relative_type_bonus'));
        $post = get_post( $item );
        $data[] = [
            'title'      => get_the_title($item),
            'permalink'  => "/bonus/".$post->post_name,
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
        $post = get_post( $item );
        $data[] = [
            'title'     => get_the_title($item),
            'permalink' => "/payment/".$post->post_name,
            'thumbnail' => (string)get_the_post_thumbnail_url($item, 'full')
        ];
    }
    return $data;
}
/* Post cards end */

/* Single posts */
/*
function get_single_casino_data($id){
    $data_post = [];
    $current_data = get_post($id);
    if(!empty($current_data)) {
        $amp_text = carbon_get_post_meta($current_data->ID, 'amp_content');
        $amp_text = empty($amp_text) ? parseAmpContent($current_data->post_content) : parseAmpContent($amp_text);
        $paymentsData = carbon_get_post_meta($current_data->ID, 'relative_pay_out');
        $vendorsData = carbon_get_post_meta($current_data->ID, 'relative_vendor');
        $currencyData = carbon_get_post_meta($current_data->ID, 'relative_currency');
        $languagesData = carbon_get_post_meta($current_data->ID, 'relative_languages');
        $refData = carbon_get_post_meta($current_data->ID, 'ref');

        $data_posts = [
            'id'                => $current_data->ID,
            'title'             => $current_data->post_title,
            'meta_title'        => carbon_get_post_meta($current_data->ID, 'meta_title'),
            'meta_description'  => carbon_get_post_meta($current_data->ID, 'meta_description'),
            'meta_keywords'     => carbon_get_post_meta($current_data->ID, 'meta_keywords'),
            'h1'                => carbon_get_post_meta($current_data->ID, 'h1'),
            'content'           => $current_data->post_content,
            'amp_content'       => $amp_text,
            'ref'               => refAdapter($refData),
            'bonuses'           => get_aside_bonus_card_data([$current_data->ID]),
            'rating'            => carbon_get_post_meta($current_data->ID, 'rating'),
            'thumbnail'         => get_the_post_thumbnail_url($current_data->ID, 'full'),
            'min_deposit'       => carbon_get_post_meta($current_data->ID, 'min_deposit'),
            'min_payout'        => carbon_get_post_meta($current_data->ID, 'min_payout'),
            'currencies'        => currenciesAdapter($currencyData),
            'languages'         => langsAdapter($languagesData),
            'color'             => carbon_get_post_meta($current_data->ID, 'color'),
            'payments'          => paymentAdapter($paymentsData),
            'label'             => carbon_get_post_meta($current_data->ID, 'marker'),
            'vendors'           => vendorAdapter($vendorsData),
            'date'              => $current_data->post_date,
            'date_modified'     => $current_data->post_modified,
            'hreflang'          => get_headers_lang($current_data->ID),
            'games'             => [],
        ];
        return $data_posts;
    }
    return $data_post;
}
function get_single_game_data($id){
    $data_post = [];
    $current_data = get_post($id);
    if(!empty($current_data)) {
        $amp_text = carbon_get_post_meta($current_data->ID, 'amp_content');
        $amp_text = empty($amp_text) ? parseAmpContent($current_data->post_content) : parseAmpContent($amp_text);

        $data_posts = [
            'id'                      => $current_data->ID,
            'title'                   => $current_data->post_title,
            'meta_title'              => carbon_get_post_meta($current_data->ID, 'meta_title'),
            'meta_description'        => carbon_get_post_meta($current_data->ID, 'meta_description'),
            'meta_keywords'           => carbon_get_post_meta($current_data->ID, 'meta_keywords'),
            'h1'                      => carbon_get_post_meta($current_data->ID, 'h1'),
            'content'                 => $current_data->post_content,
            'amp_content'             => $amp_text,
            'thumbnail'               => get_the_post_thumbnail_url($current_data->ID, 'full'),
            'date'                    => $current_data->post_date,
            'date_modified'           => $current_data->post_modified,
            'hreflang'                => get_headers_lang($current_data->ID)
        ];
        return $data_posts;
    }
    return $data_post;
}
function get_page_data($id) {
    $data_post = [];
    $current_data = get_post($id);
    if(!empty($current_data)) {
        $amp_text = carbon_get_post_meta($current_data->ID, 'amp_content');
        $amp_text = empty($amp_text) ? parseAmpContent($current_data->post_content) : parseAmpContent($amp_text);
        $data_posts = [
            'id'               => $current_data->ID,
            'title'            => $current_data->post_title,
            'meta_title'       => carbon_get_post_meta($current_data->ID, 'meta_title'),
            'meta_description' => carbon_get_post_meta($current_data->ID, 'meta_description'),
            'meta_keywords'    => carbon_get_post_meta($current_data->ID, 'meta_keywords'),
            'h1'               => carbon_get_post_meta($current_data->ID, 'h1'),
            'content'          => $current_data->post_content,
            'amp_content'      => $amp_text,
            'description_site' => get_bloginfo(),
            'thumbnail'        => get_the_post_thumbnail_url($current_data->ID, 'full'),
            'date'             => $current_data->post_date,
            'date_modified'    => $current_data->post_modified,
            'hreflang'         => get_headers_lang($current_data->ID)
        ];
        return $data_posts;
    }
    return $data_post;
}
*/
/* Single posts end */

/* Support functions */
function url_to_post_id($url, $post_type) {
    $query = new WP_Query( array(
        'post_type'         => $post_type,
        'name'              => $url,
        'post_status'       => 'publish'
    ));
    if(!isset($query->post)) return 0;
    else return $query->post->ID;
}
/*
function get_public_post_id($post_type) {
    $arr_id = [];
    $query = new WP_Query( array(
        'posts_per_page' => -1,
        'post_type'    => $post_type,
        'post_status'  => 'publish',
        'orderby'      => 'meta_value_num',
        'order'        => 'DESC',
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
function get_permalink_and_title_by_arr_id($arr_id) {
    if(empty($arr_id)) return [];
    $data = [];
    foreach ($arr_id as $id) {
        $data[] = [
            'title' => get_the_title($id),
            'permalink' => get_short_link($id)
        ];
    }
    return $data;
}
function get_menu($id){
    $data = [];
    $menu = wp_get_nav_menu_items($id);
    if(!empty($menu)) {
        foreach ($menu as $item) {
            $data[] = [
                'title'     => $item->title,
                'permalink' => str_replace(HOST_URL, '', $item->url)
            ];
        }
    }
    return $data;
}
function get_sitemap_by_arr_posts($posts, $priority) {
    if(empty($posts)) return [];
    $data = [];
    foreach ($posts as $item) {
        $data[] = [
            'url'  => get_short_link($item->ID),
            'lastmod'    => substr($item->post_modified, 0, 10),
            'changefreq' => 'daily',
            'priority'   => get_short_link($item->ID) === '/' ? 1 : $priority
        ];
    }
    return $data;
}
function get_headers_lang($id){
    $headers = [];
    $headers_lang = carbon_get_post_meta($id, 'headers_meta_lang');
    if(!empty($headers_lang)) {
        foreach ($headers_lang as $item) {
            $headers[] = [
                'lang' => $item['headers_lang'],
                'link' => $item['headers_link']
            ];
        }
    }
    return $headers;
}
*/
/* Support functions end */