<?php

    namespace App\Http\Resources\Media;

    use Illuminate\Http\Resources\Json\JsonResource;
    use JetBrains\PhpStorm\ArrayShape;

    class MediaResource extends JsonResource
    {

        #[
            ArrayShape( [
            'id' => "mixed" ,
            'name' => "mixed" ,
            'file_name' => "mixed" ,
            'url' => "mixed" ,
            'size' => "mixed" ,
            'mime_type' => "mixed" ,
            'updated_at' => "mixed" ,
            'created_at' => "mixed"
            ] )
        ]

        public function toArray( $request ): array
        {
            return [
                'id' => $this->id ,
                'name' => $this->name ,
                'file_name' => $this->file_name ,
                'url' => $this->getFullUrl() ,
                'size' => $this->human_readable_size ,
                'mime_type' => $this->mime_type ,
                'updated_at' => $this->updated_at ,
                'created_at' => $this->created_at ,
            ];
        }
    }
