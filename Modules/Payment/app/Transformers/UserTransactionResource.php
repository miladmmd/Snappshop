<?php

namespace Modules\Payment\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UserTransactionResource extends ResourceCollection
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request)
    {
        return $this->collection->map(function($item)  {

            return [
                'user_id' => $item['user_id'],
                'transaction_count' => $item['transaction_count'],
                'recent_transactions' => TransactionResource::collection($item['recent_transactions'])
            ];
        });

    }
}
