<?php

    namespace Tests\Feature;

    use App\Models\News;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use Illuminate\Foundation\Testing\WithFaker;
    use Illuminate\Http\UploadedFile;
    use Tests\TestCase;

    class NewsTest extends TestCase
    {
        use RefreshDatabase , WithFaker;

        /**
         * A basic test example.
         *
         * @return void
         */
        public function test_the_api_index_news()
        {
            $response = $this->get( '/api/news' );
            $response->assertStatus( 200 );
        }

        /**
         * A basic test example.
         *
         * @return void
         */
        public function test_the_api_show_news()
        {
            $news = News::create( [
                "title" => $this->faker->title ,
                "body" => $this->faker->text ,
            ] );
            $this->assertNotNull( $news );
            $this->ImageTest( $news );

            $response = $this->get( '/api/news/show/' . $news->id );
            $response->assertStatus( 200 );
        }

        /**
         * A basic test example.
         *
         * @return void
         */
        public function test_the_api_create_news()
        {
            $request = [
                "title" => $this->faker->title ,
                "body" => $this->faker->text ,
                "image" => UploadedFile::fake()->create("test.png")
            ];
            $response = $this->post( '/api/news/create' , $request );
            $response->assertStatus( 200 );
        }

        /**
         * A basic test example.
         *
         * @return void
         */
        public function test_the_api_update_news()
        {
            $news = News::create( [
                "title" => $this->faker->title ,
                "body" => $this->faker->text ,
            ] );
            $this->assertNotNull( $news );
            $this->ImageTest( $news );

            $request = [
                "title" => $this->faker->title ,
                "body" => $this->faker->text ,
                "image" => UploadedFile::fake()->create("test.png")
            ];
            $response = $this->post( '/api/news/update/' . $news->id , $request );
            $response->assertStatus( 200 );
        }


        /**
         * A basic test example.
         *
         * @return void
         */
        public function test_the_api_delete_news()
        {
            $news = News::create( [
                "title" => $this->faker->title ,
                "body" => $this->faker->text ,
            ] );
            $this->assertNotNull( $news );
            $this->ImageTest( $news );

            $response = $this->get( '/api/news/delete/' . $news->id );
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
