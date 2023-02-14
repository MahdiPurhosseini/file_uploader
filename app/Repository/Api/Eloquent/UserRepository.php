<?php

    namespace App\Repository\Api\Eloquent;

    use App\Models\User;
    use App\Repository\Api\UserRepositoryInterface;
    use Illuminate\Support\Facades\DB;
    use JetBrains\PhpStorm\ArrayShape;
    use Symfony\Component\HttpFoundation\Response;

    class UserRepository extends AbstractRepository implements UserRepositoryInterface
    {

        /**
         * @param User $model
         */
        public function __construct( User $model )
        {
            $this->model = $model;
        }

        public function getById( $id ): User
        {
            return $this->model->findOrFail( $id );
        }

        public function getAll(): mixed
        {
            return $this->model->get();
        }

        public function getAllConfirmed(): mixed
        {
            return $this->model->confirmed()->get();
        }

        #[
            ArrayShape( [
                "status" => "int" ,
                "message" => "string"
            ] )
        ]
        public function delete( $id ): array
        {
            try {
                DB::beginTransaction();

                $this->getById( $id )->delete();

                DB::commit();
                return [
                    "status" => Response::HTTP_OK ,
                    "message" => __("user deleted successfully")
                ];
            } catch ( \Exception $e ) {
                DB::rollBack();
                return [
                    "status" => Response::HTTP_INTERNAL_SERVER_ERROR ,
                    "message" => __( "there was a problem" )
                ];
            }
        }

    }
