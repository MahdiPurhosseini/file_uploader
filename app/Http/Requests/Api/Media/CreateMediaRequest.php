<?php

    namespace App\Http\Requests\Api\Media;

    use Illuminate\Foundation\Http\FormRequest;
    use Illuminate\Validation\Rule;

    class CreateMediaRequest extends FormRequest
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
                'type' => [ 'required' , "string", Rule::in(['post', 'news']) ] ,
                'id' => [ 'required' , "integer" ] ,
                'image' => [ 'required' , "image" ] ,
            ];
        }

    }
