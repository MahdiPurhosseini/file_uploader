<?php

    namespace App\Repository\Api;

    use App\Models\News;

    interface NewsRepositoryInterface
    {

        /**
         * @param $id
         * @return News
         */
        public function getById( $id ): News;

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
         * @param $id
         * @return mixed
         */
        public function update( $request , $id ): mixed;

        /**
         * @param $id
         * @return mixed
         */
        public function delete( $id ): mixed;

    }
