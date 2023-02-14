<?php

namespace App\Http\Resources\News;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use JsonSerializable;

class NewsCollection extends ResourceCollection
{

    /**
     * @param Request $request
     * @return array|JsonSerializable|Arrayable
     */
    public function toArray( $request): array|JsonSerializable|Arrayable
    {
        return parent::toArray($request);
    }

}
