<?php

    namespace App\Http\Resources\Post;

    use Illuminate\Http\Resources\Json\JsonResource;
    use JetBrains\PhpStorm\ArrayShape;

    class PostResource extends JsonResource
    {

        #[
            ArrayShape( [
            'id' => "mixed" ,
            'title' => "mixed" ,
            'body' => "mixed" ,
            'image' => "mixed" ,
            'updated_at' => "mixed" ,
            'created_at' => "mixed"
            ] )
        ]

        public function toArray( $request ): array
        {
            return [
                'id' => $this->id ,
                'title' => $this->title ,
                'body' => $this->body ,
                'image' => $this->getFirstMediaUrl("images") ,
                'updated_at' => $this->updated_at ,
                'created_at' => $this->created_at ,
            ];
        }
    }
