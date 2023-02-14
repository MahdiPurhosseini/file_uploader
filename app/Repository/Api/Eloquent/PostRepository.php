<?php

    namespace App\Repository\Api\Eloquent;

    use App\Models\Post;
    use App\Repository\Api\PostRepositoryInterface;
    use Illuminate\Support\Facades\DB;
    use Symfony\Component\HttpFoundation\Response;

    class PostRepository extends AbstractRepository implements PostRepositoryInterface
    {

        /**
         * @param Post $model
         */
        public function __construct( Post $model )
        {
            $this->model = $model;
        }

        public function getById( $id ): Post
        {
            return $this->model->findOrFail( $id );
        }

        public function get(): mixed
        {
            return $this->model->get();
        }

        public function create( $request ): array
        {
            try {
                DB::beginTransaction();

                $model = $this->model;
                $model->title = $request[ "title" ];
                $model->body = $request[ "body" ];
                if ( isset( $request[ "image" ] ) ) {
                    $model->addMedia( $request[ "image" ] )
                        ->usingName( $request[ "title" ] )
                        ->toMediaCollection( "images" );
                }
                $model->save();

                DB::commit();
                return [
                    "status" => Response::HTTP_OK ,
                    "message" => __( "post created successfully" )
                ];
            } catch ( \Exception $e ) {
                DB::rollBack();
                return [
                    "status" => Response::HTTP_INTERNAL_SERVER_ERROR ,
                    "message" => __( "there was a problem" ) ,
                ];
            }
        }

        public function update( $request , $id ): array
        {
            try {
                DB::beginTransaction();

                $model = $this->getById( $id );
                $model->title = $request[ "title" ];
                $model->body = $request[ "body" ];
                if ( isset( $request[ "image" ] ) ) {
                    $model->addMedia( $request[ "image" ] )
                        ->usingName( $request[ "title" ] )
                        ->toMediaCollection( "images" );
                }
                $model->save();

                DB::commit();
                return [
                    "status" => Response::HTTP_OK ,
                    "message" => __( "post updated successfully" )
                ];
            } catch ( \Exception $e ) {
                DB::rollBack();
                return [
                    "status" => Response::HTTP_INTERNAL_SERVER_ERROR ,
                    "message" => __( "there was a problem" ) ,
                ];
            }
        }

        public function delete( $id ): array
        {
            try {
                DB::beginTransaction();

                $model = $this->getById( $id );
                $model->clearMediaCollection("images");
                $model->delete();

                DB::commit();
                return [
                    "status" => Response::HTTP_OK ,
                    "message" => __( "post deleted successfully" )
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
