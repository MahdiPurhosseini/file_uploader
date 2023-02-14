<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\Api\Media\CreateMediaRequest;
    use App\Http\Requests\Api\Media\CreateMultipleMediaRequest;
    use App\Http\Resources\Media\MediaCollection;
    use App\Http\Resources\Media\MediaResource;
    use App\Repository\Api\Eloquent\MediaRepository;
    use Illuminate\Http\JsonResponse;
    use Symfony\Component\HttpFoundation\Response;

    class MediaController extends Controller
    {

        protected MediaRepository $main;

        public function __construct(MediaRepository $mediaRepository)
        {
            $this->main = $mediaRepository;
        }

        public function index(): JsonResponse
        {
            return response()->json( [
                'status' => Response::HTTP_OK ,
                'data' => [
                    'medias' => new MediaCollection( $this->main->get() )
                ]
            ] );
        }

        public function show($id): JsonResponse
        {
            return response()->json( [
                'status' => Response::HTTP_OK ,
                'data' => [
                    'media' => new MediaResource( $this->main->getById($id) )
                ]
            ] );
        }

        public function create(CreateMediaRequest $request): JsonResponse
        {
            return response()->json(
                $this->main->create( $request->validated() )
            );
        }

        public function createMultiple(CreateMultipleMediaRequest $request): JsonResponse
        {
            return response()->json(
                $this->main->createMultiple( $request->validated() )
            );
        }

        public function delete($id): JsonResponse
        {
            return response()->json(
                $this->main->delete($id)
            );
        }

    }
