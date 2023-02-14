<?php

    namespace App\Repository\Api;

    use App\Models\User;

    interface UserRepositoryInterface
    {

        /**
         * @param $id
         * @return User
         */
        public function getById( $id ): User;

        /**
         * @return mixed
         */
        public function getAll(): mixed;

        /**
         * @return mixed
         */
        public function getAllConfirmed(): mixed;

        /**
         * @param $id
         * @return mixed
         */
        public function delete( $id ): mixed;

    }
