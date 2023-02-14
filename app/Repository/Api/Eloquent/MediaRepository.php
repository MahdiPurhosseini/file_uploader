<?php

    namespace App\Repository\Api\Eloquent;

    use App\Models\News;
    use App\Models\Post;
    use App\Repository\Api\MediaRepositoryInterface;
    use Illuminate\Support\Facades\DB;
    use Spatie\MediaLibrary\MediaCollections\Models\Media;
    use Symfony\Component\HttpFoundation\Response;

    class MediaRepository extends AbstractRepository implements MediaRepositoryInterface
    {

        /**
         * @param Media $model
         */
        public function __construct( Media $model )
        {
            $this->model = $model;
        }

        public function getById( $id ): Media
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

                if ( $request[ "type" ] == "post" ) {
                    $model = Post::findOrFail( $request[ "id" ] );
                } elseif ( $request[ "type" ] == "news" ) {
                    $model = News::findOrFail( $request[ "id" ] );
                } else {
                    return [
                        "status" => Response::HTTP_INTERNAL_SERVER_ERROR ,
                        "message" => __( "there was a problem" ) ,
                    ];
                }

                if ( isset( $request[ "image" ] ) ) {
                    $model->addMedia( $request[ "image" ] )
                        ->usingName( $model->title )
                        ->toMediaCollection( "images" );
                }
                $model->save();

                DB::commit();
                return [
                    "status" => Response::HTTP_OK ,
                    "message" => __( "media created successfully" )
                ];
            } catch ( \Exception $e ) {
                DB::rollBack();
                return [
                    "status" => Response::HTTP_INTERNAL_SERVER_ERROR ,
                    "message" => __( "there was a problem" ) ,
                ];
            }
        }


        public function createMultiple( $request ): array
        {
            try {
                DB::beginTransaction();

                $models = json_decode( $request[ "models" ] , true );
                foreach ( $models as $key => $value ) {

                    if ( $value[ "type" ] == "post" ) {
                        $model = Post::findOrFail( $value[ "id" ] );
                    } elseif ( $value[ "type" ] == "news" ) {
                        $model = News::findOrFail( $value[ "id" ] );
                    } else {
                        return [
                            "status" => Response::HTTP_INTERNAL_SERVER_ERROR ,
                            "message" => __( "there was a problem" ) ,
                        ];
                    }

                    $model->addMedia( $request[ "image" ] )
                        ->usingName( $model->title );
                    $model->save();
                }

                DB::commit();
                return [
                    "status" => Response::HTTP_OK ,
                    "message" => __( "media created successfully" )
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
                $model->delete();

                DB::commit();
                return [
                    "status" => Response::HTTP_OK ,
                    "message" => __( "media deleted successfully" )
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
