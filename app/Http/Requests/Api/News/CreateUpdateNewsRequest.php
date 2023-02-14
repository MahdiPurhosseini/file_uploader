<?php

    namespace App\Http\Requests\Api\News;

    use Illuminate\Foundation\Http\FormRequest;

    class CreateUpdateNewsRequest extends FormRequest
    {
        /**
         * Determine if the user is authorized to make this request.
         *
         * @return bool
         */
        public function authorize(): bool
        {
            return true;
        }

        /**
         * Get the validation rules that apply to the request.
         *
         * @return array
         */
        public function rules(): array
        {
            return [
                'title' => [ 'required' , "string" ] ,
                'body' => [ 'nullable' , "string" ] ,
                'image' => [ 'nullable' , "image" ] ,
            ];
        }

    }
