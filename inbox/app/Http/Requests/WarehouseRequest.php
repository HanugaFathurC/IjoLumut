<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WarehouseRequest extends FormRequest
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
        if(request()->isMethod('POST')){
            $data = [
                'name' => 'required|unique:types',
                'image' => 'required|mimes:png,jpg,jpeg|max:2048',
                'type_id' => 'required',
                'indonesia_provinces_id' => 'required',
                'indonesia_cities_id' => 'required',
                'indonesia_districts_id' => 'required',
                'indonesia_villages_id' => 'required',
                'address' => 'required',
                'telp' => 'required',
            ];
        }elseif(request()->isMethod('PUT')){
            $data = [
                'name' => 'required','unique:types,name'.$this->id,
                'image' => 'mimes:png,jpg,jpeg|max:2048',
                'type_id' => 'required',
                'indonesia_provinces_id' => 'required',
                'indonesia_cities_id' => 'required',
                'indonesia_districts_id' => 'required',
                'indonesia_villages_id' => 'required',
                'address' => 'required',
                'telp' => 'required',
            ];
        }

        return $data;
    }
}
