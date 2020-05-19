<?php

namespace App\Transformers;

use App\Account;
use League\Fractal\TransformerAbstract;

class AccountTransformer extends TransformerAbstract
{
    public function transform(Account $account)
    {
        return [
            'id' => $account->id,
            'bank' => $account->bank->name,
            'date' => $account->created_at->format('d-m-Y'),
            'identification' => $account->identification,
            'name' => $account->name,
            'number' => $account->number
        ];
    }
}