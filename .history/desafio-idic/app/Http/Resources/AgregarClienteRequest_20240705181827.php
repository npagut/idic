<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AgregarClienteRequest extends JsonResource
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
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return parent::toArray($request);
    }
}
