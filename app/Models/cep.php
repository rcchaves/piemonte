<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cep extends Model
{
    use HasFactory;
    public function rules() {
        return [
            'cep' => 'required|unique:cep,cep,'.$this->id.'|min:8',
            'uf' => 'required',
            'localidade' => 'required|max:30',           
            'logradouro' => 'required|max:50',
            
        ];
    }

    public function feedback() {
        return [
            'required' => 'O campo :attribute é obrigatório',              
            'nome.unique' => 'O CEP já existe',
            'nome.min' => 'O CEP deve ter no mínimo 8 caracteres',
        ];
    }
    public $timestamps = false;
    use HasFactory;
    protected $table = 'cep';
    protected $fillable = ['cep', 'uf', 'localidade', 'logradouro'];
}
