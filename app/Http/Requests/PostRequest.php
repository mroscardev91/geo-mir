<?php

namespace App\Http\Requests;

use App\Models\File;
use Illuminate\Foundation\Http\FormRequest;
use http\Env\Request;
use Illuminate\Support\Facades\Storage;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function saveImage($request) : File
    {
        $path_saved = Storage::putFile('public' , $request->file('image'));
        $path = 'storage/'.explode("/", $path_saved)[1];
        return File::create([
            "filesize" =>  $request->file('image')->getSize(),
            "filepath" => $path
        ]);

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'message' => 'required|string|max:255',
            'image' =>  'image|mimes:jpeg,png,jpg,webp|max:11000',
        ];
    }

    public function payload(): array
    {
        return $this->only(['message', 'image']);
    }
}
