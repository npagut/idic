<?php

namespace App\Http\Resources;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AgregarClienteRequest extends FormRequest
{

    public function authorize(){
        return true;
    }

    public function rules(){
        return [
            'nombre' => 'required|min:5|max:100',
            'rut' => 'required|unique:clients|min:5|max:100',
            'email' => 'required|unique:clients|min:4|max:100'
        ];
    }

}
