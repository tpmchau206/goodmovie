<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;

class MoviesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required',
            // 'poster' => 'required',
            // 'image' => 'required',
            // 'trailer' => 'required',
            // 'movie' => ['required', File::types(['mp4'])],
            'content' => 'required',
            'year' => 'required',
            'performer' => 'required',
            'nation' => 'required',
            'length' => 'required',
            'episode' => 'required',
            'age' => 'required',
            'category' => 'required',
            //
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Vui lòng nhập :attribute',
            // 'poster.required' => 'Vui lòng nhập :attribute',
            // 'image.required' => 'Vui lòng nhập :attribute',
            // 'trailer.required' => 'Vui lòng nhập :attribute',
            // 'movie.required' => 'Vui lòng nhập :attribute',
            'content.required' => 'Vui lòng nhập :attribute',
            'year.required' => 'Vui lòng nhập :attribute',
            'performer.required' => 'Vui lòng nhập :attribute',
            'nation.required' => 'Vui lòng nhập :attribute',
            'length.required' => 'Vui lòng nhập :attribute',
            'episode.required' => 'Vui lòng nhập :attribute',
            'age.required' => 'Vui lòng nhập :attribute',
            'category.required' => 'Vui lòng nhập :attribute'
            //
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên bộ phim',
            'poster' => 'Poster',
            'image' => 'Hình ảnh',
            'trailer' => 'Trailer',
            'movie' => 'Movie',
            'content' => 'Nội dung',
            'year' => 'Năm xuất bản',
            'performer' => 'Diễn viên',
            'nation' => 'Quốc gia',
            'length' => 'Thời lượng',
            'episode' => 'Số tập',
            'age' => 'Độ tuổi',
            'category' => 'Thể loại'
        ];
    }
}