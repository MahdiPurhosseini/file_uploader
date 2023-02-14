<?php

    namespace App\Http\Controllers\Api;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\Api\Post\CreateUpdatePostRequest;
    use App\Http\Resources\Post\PostCollection;
    use App\Http\Resources\Post\PostResource;
    use App\Repository\Api\Eloquent\PostRepository;
    use Illuminate\Http\JsonResponse;
    use Symfony\Component\HttpFoundation\Response;

    class PostController extends Controller
    {

        protected PostRepository $main;

        public function __construct(PostRepository $postsRepository)
        {
            $this->main = $postsRepository;
        }

        public function index(): JsonResponse
        {
            return response()->json( [
                'status' => Response::HTTP_OK ,
                'data' => [
                    'posts' => new PostCollection( $this->main->get() )
                ]
            ] );
        }

        public function show($id): JsonResponse
        {
            return response()->json( [
                'status' => Response::HTTP_OK ,
                'data' => [
                    'post' => new PostResource( $this->main->getById($id) )
                ]
            ] );
        }

        public function create(CreateUpdatePostRequest $request): JsonResponse
        {
            return response()->json(
                $this->main->create( $request->validated() )
            );
        }

        public function update(CreateUpdatePostRequest $request , $id): JsonResponse
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
