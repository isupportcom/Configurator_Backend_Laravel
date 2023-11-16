<?php

namespace App\Service;

use App\Models\CardsPlace;
use App\Models\FinalProduct;
use App\Models\PlaceChoices;
use App\Models\ProductsCard;
use App\Models\Rules;


class DeleteRulesService
{
    public function deleteRules(int $idslc, int  $sosource)
    {
        $rules = Rules::where('sosource', $sosource)->where('idslc', $idslc)->get();
        foreach ($rules as $rule) {
            $rule->delete();
        }
        $this->deleteRelatedRules($idslc, $sosource);
    }

    protected function deleteRelatedRules(int $idslc, int $sosource)
    {
        if ($sosource === 1000) {
            $relatedItems = ProductsCard::where('final_product_id', $idslc)->get();
            foreach ($relatedItems as $relatedItem) {
                $this->deleteRules($relatedItem->id, 2000);
            }
        }
        if ($sosource === 2000) {
            $relatedItems = CardsPlace::where('product_card_id', $idslc)->get();
            foreach ($relatedItems as $relatedItem) {
                $this->deleteRules($relatedItem->id, 3000);
            }
        }
        if ($sosource === 3000) {
            $relatedItems = PlaceChoices::where('card_place_id', $idslc)->get();
            foreach ($relatedItems as $relatedItem) {
                $this->deleteRules($relatedItem->id, 4000);
            }
        }
    }
}
