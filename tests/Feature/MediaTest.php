<?php

    namespace Tests\Feature;

    use App\Models\Post;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Illuminate\Foundation\Testing\WithFaker;
    use Illuminate\Http\UploadedFile;
    use Tests\TestCase;

    class MediaTest extends TestCase
    {
        use RefreshDatabase , WithFaker;

        /**
         * A basic test example.
         *
         * @return void
         */
        public function test_the_api_index_media()
        {
            $response = $this->get( '/api/media' );
            $response->assertStatus( 200 );
        }

        /**
         * A basic test example.
         *
         * @return void
         */
        public function test_the_api_show_media()
        {
            $post = Post::create( [
                "title" => $this->faker->title ,
                "body" => $this->faker->text ,
            ] );
            $this->assertNotNull( $post );

            $image = $this->ImageTest( $post );

            $response = $this->get( '/api/media/show/' . $image->id );
            $response->assertStatus( 200 );
        }

        /**
         * A basic test example.
         *
         * @return void
         */
        public function test_the_api_create_media()
        {
            $post = Post::create( [
                "title" => $this->faker->title ,
                "body" => $this->faker->text ,
            ] );
            $this->assertNotNull( $post );

            $request = [
                "type" => "post" ,
                "id" => $post->id ,
                "image" => UploadedFile::fake()->create("test.png")
            ];
            $response = $this->post( '/api/media/create' , $request );
            $response->assertStatus( 200 );
        }

        /**
         * A basic test example.
         *
         * @return void
         */
        public function test_the_api_create_multiple_media()
        {
            $post1 = Post::create( [
                "title" => $this->faker->title ,
                "body" => $this->faker->text ,
            ] );
            $this->assertNotNull( $post1 );

            $post2 = Post::create( [
                "title" => $this->faker->title ,
                "body" => $this->faker->text ,
            ] );
            $this->assertNotNull( $post2 );

            $news1 = Post::create( [
                "title" => $this->faker->title ,
                "body" => $this->faker->text ,
            ] );
            $this->assertNotNull( $news1 );

            $news2 = Post::create( [
                "title" => $this->faker->title ,
                "body" => $this->faker->text ,
            ] );
            $this->assertNotNull( $news2 );

            $models = [
                1 => [
                    "id" => $post1->id,
                    "type" => "post",
                ],
                2 => [
                    "id" => $post2->id,
                    "type" => "post",
                ],
                3 => [
                    "id" => $news1->id,
                    "type" => "news",
                ],
                4 => [
                    "id" => $news2->id,
                    "type" => "news",
                ],
            ];

            $request = [
                "models" =>  json_encode($models) ,
                "image" => UploadedFile::fake()->create("test.png")
            ];
            $response = $this->post( '/api/media/create/multiple' , $request );
            $response->assertStatus( 200 );
        }


        /**
         * A basic test example.
         *
         * @return void
         */
        public function test_the_api_delete_media()
        {
            $post = Post::create( [
                "title" => $this->faker->title ,
                "body" => $this->faker->text ,
            ] );
            $this->assertNotNull( $post );

            $image = $this->ImageTest( $post );

            $response = $this->get( '/api/media/delete/' . $image->id );
            $response->assertStatus( 200 );
        }

        private function ImageTest( $modal )
        {
            $image = $modal->addMedia( $this->faker->image )
                ->usingName( $modal->title )
                ->toMediaCollection( "images" );

            $this->assertNotNull( $image );
            $this->assertFileExists( $image->getPath() );

            return $image;
        }
    }
