<?php
namespace pages\service;
use BaseService;

class Service extends BaseService {
    public $postType = 'page';
    function meta() {
        return [
            'slug'      => $this->postType,
            'post_type' => $this->postType,
        ];
    }
    function main() {
        $casinoIds = get_public_post_id_by_rating('casino', 10);
        $newCasinoIds = get_public_post_id('casino', 5);
        $slotIds = get_public_post_id_by_rating('slot', 15);
        $newSlotIds = get_public_post_id('slot', 15);
        $bonusIds = get_public_post_id('bonus', 10);
        $data = [
            'casino'     => get_casino_card_data($casinoIds),
            'new_casino' => get_casino_card_data($newCasinoIds),
            'top_game'   => get_slot_card_data($slotIds),
            'new_game'   => get_slot_card_data($newSlotIds),
            'bonuses'    => get_bonus_card_data($bonusIds),
        ];
        return array_merge($this->commonData(), $this->meta(), $data);
    }
    function author() {
        return array_merge($this->commonData(), $this->meta());
    }
    function casino() {
        $casinoIds = get_public_post_id_by_rating('casino', 200);
        $data = [
            'casino' => get_casino_card_data($casinoIds)
        ];
        return array_merge($this->commonData(), $this->meta(), $data);
    }
    function bonuses() {
        $bonusIds = get_public_post_id('bonus', 200);
        $bonusTypeIds = get_public_post_id('type_bonus');
        $data = [
           'bonus_type' => get_type_bonus_card_data($bonusTypeIds),
           'bonuses' => get_bonus_card_data($bonusIds)
        ];
        return array_merge($this->commonData(), $this->meta(), $data);
    }
    function vendors() {
        $vendorsIds = get_public_post_id('vendor', 200);
        $data = [
           'vendors' => get_vendor_card_data($vendorsIds),
        ];
        return array_merge($this->commonData(), $this->meta(), $data);
    }
    function payments() {
        $paymentsIds = get_public_post_id('payment', 200);
        $data = [
           'payments' => get_payment_card_data($paymentsIds),
        ];
        return array_merge($this->commonData(), $this->meta(), $data);
    }
}
