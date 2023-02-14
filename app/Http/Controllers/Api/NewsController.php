<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\Api\News\CreateUpdateNewsRequest;
    use App\Http\Resources\News\NewsCollection;
    use App\Http\Resources\News\NewsResource;
    use App\Repository\Api\Eloquent\NewsRepository;
    use Illuminate\Http\JsonResponse;
    use Symfony\Component\HttpFoundation\Response;

    class NewsController extends Controller
    {

        protected NewsRepository $main;

        public function __construct(NewsRepository $newsRepository)
        {
            $this->main = $newsRepository;
        }

        public function index(): JsonResponse
        {
            return response()->json( [
                'status' => Response::HTTP_OK ,
                'data' => [
                    'news' => new NewsCollection( $this->main->get() )
                ]
            ] );
        }

        public function show($id): JsonResponse
        {
            return response()->json( [
                'status' => Response::HTTP_OK ,
                'data' => [
                    'new' => new NewsResource( $this->main->getById($id) )
                ]
            ] );
        }

        public function create(CreateUpdateNewsRequest $request): JsonResponse
        {
            return response()->json(
                $this->main->create( $request->validated() )
            );
        }

        public function update(CreateUpdateNewsRequest $request , $id): JsonResponse
        {
            return response()->json(
                $this->main->update( $request->validated() , $id )
            );
        }

        public function delete($id): JsonResponse
        {
            return response()->json(
                $this->main->delete($id)
            );
        }

    }
