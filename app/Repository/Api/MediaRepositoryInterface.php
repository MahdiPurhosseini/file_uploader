<?php

    namespace App\Repository\Api;

    use Spatie\MediaLibrary\MediaCollections\Models\Media;

    interface MediaRepositoryInterface
    {

        /**
         * @param $id
         * @return Media
         */
        public function getById( $id ): Media;

        /**
         * @return mixed
         */
        public function get(): mixed;

        /**
         * @param $request
         * @return mixed
         */
        public function create( $request ): mixed;

        /**
         * @param $request
         * @return mixed
         */
        public function createMultiple( $request ): mixed;

        /**
         * @param $id
         * @return mixed
         */
        public function delete( $id ): mixed;

    }
