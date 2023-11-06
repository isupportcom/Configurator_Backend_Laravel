<?php

namespace App\Service;

use App\Models\Rules;


class DeleteRulesService
{
    public function deleteRules(int $idslc, int  $sosource)
    {

        $rules = Rules::where('sosource', $sosource)->where('idslc', $idslc)->get();
        foreach ($rules as $rule) {
            $rule->delete();
        }
    }
}
