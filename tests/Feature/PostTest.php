<?php

    namespace Tests\Feature;

    use App\Models\Post;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Illuminate\Foundation\Testing\WithFaker;
    use Illuminate\Http\UploadedFile;
    use Tests\TestCase;

    class PostTest extends TestCase
    {
        use RefreshDatabase , WithFaker;

        /**
         * A basic test example.
         *
         * @return void
         */
        public function test_the_api_index_post()
        {
            $response = $this->get( '/api/post' );
            $response->assertStatus( 200 );
        }

        /**
         * A basic test example.
         *
         * @return void
         */
        public function test_the_api_show_post()
        {
            $post = Post::create( [
                "title" => $this->faker->title ,
                "body" => $this->faker->text ,
            ] );
            $this->assertNotNull( $post );
            $this->ImageTest( $post );

            $response = $this->get( '/api/post/show/' . $post->id );
            $response->assertStatus( 200 );
        }

        /**
         * A basic test example.
         *
         * @return void
         */
        public function test_the_api_create_post()
        {
            $request = [
                "title" => $this->faker->title ,
                "body" => $this->faker->text ,
                "image" => UploadedFile::fake()->create("test.png")
            ];
            $response = $this->post( '/api/post/create' , $request );
            $response->assertStatus( 200 );
        }

        /**
         * A basic test example.
         *
         * @return void
         */
        public function test_the_api_update_post()
        {
            $post = Post::create( [
                "title" => $this->faker->title ,
                "body" => $this->faker->text ,
            ] );
            $this->assertNotNull( $post );
            $this->ImageTest( $post );

            $request = [
                "title" => $this->faker->title ,
                "body" => $this->faker->text ,
                "image" => UploadedFile::fake()->create("test.png")
            ];
            $response = $this->post( '/api/post/update/' . $post->id , $request );
            $response->assertStatus( 200 );
        }


        /**
         * A basic test example.
         *
         * @return void
         */
        public function test_the_api_delete_post()
        {
            $post = Post::create( [
                "title" => $this->faker->title ,
                "body" => $this->faker->text ,
            ] );
            $this->assertNotNull( $post );
            $this->ImageTest( $post );

            $response = $this->get( '/api/post/delete/' . $post->id );
            $response->assertStatus( 200 );
        }

        private function ImageTest( $modal )
        {
            $image = $modal->addMedia( $this->faker->image )
                ->usingName( $modal->title )
                ->toMediaCollection( "images" );

            $this->assertNotNull( $image );
            $this->assertFileExists( $image->getPath() );
        }
    }
