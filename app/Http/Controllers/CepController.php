<?php

namespace App\Http\Controllers;

use App\Models\cep;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class CepController extends Controller
{
    public function __construct(Cep $cep)
    {
        $this->cep = $cep;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ceps = Cep::all();
        return $ceps;
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $regras = [
            'cep' => 'required|unique:cep,cep,id|max:8',
            'localidade' => 'required',            
            'logradouro' => 'required',
            'uf' => 'required',
        ];
        $feedback = [
            'required' => 'O campo ::attribute é obrigatorio',
            'unique' => 'O ::attribute já foi cadastrado',
            'max' => 'O campo ::attribute suporta 8 numeros',
        ];
        $request->validate($regras, $feedback);
        $reponse = Cep::create($request->all());
        return $reponse;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cep  $cep
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        if ($request->has('cep')) {
            $valor = $request->cep;
        }
    }

    public function search($cep)
    {
        $result = Cep::where('cep', '=', $cep)->get();
        if (count($result)) {
            return Response()->json($result);
        } else {
            $url = 'https://viacep.com.br/ws/' . $cep . '/json';
            $response = Http::get($url);
            $jsonData = $response->json();
            if($jsonData == null)   {
                return Response()->json(['erro' => 'O recurso solicitado não existe'], 404);
            }        
           return Response()->json([$jsonData]);
        }
    }

    public function logra($uf, $localidade, $logra)
    {    
        $result = Cep::where
        ([
            ['logradouro', 'LIKE', '%'.$logra.'%'], 
            ['uf', 'LIKE', '%'.$uf.'%'],
            ['localidade', 'LIKE', '%'.$localidade.'%']])
  
        ->get();     
        if (count($result)) {
            return Response()->json($result);
        } else {
            $url = 'https://viacep.com.br/ws/'.$uf.'/'.$localidade.'/'.$logra.'/json';

            $response = Http::get($url);
            $jsonData = $response->json();
            if($jsonData == null)   {
                return Response()->json(['erro' => 'O recurso solicitado não existe'], 404);
            }        
           return Response()->json($jsonData);
        }
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cep  $cep
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cep = $this->cep->find($id);
        if ($cep === null) {
            return response()->json(['erro' => 'O recurso solicitado não existe'], 404);
        }
        if ($request->method() === 'PATCH') {

            $validar = array();

            //percorrendo todas as regras definidas no Model
            foreach ($cep->rules() as $input => $regra) {

                //coletar apenas as regras aplicáveis aos parâmetros parciais da requisição PATCH
                if (array_key_exists($input, $request->all())) {
                    $validar[$input] = $regra;
                }
            }

            $request->validate($validar);
        } else {
            $request->validate($cep->rules());
        }
        $cep->fill($request->all());
        $cep->save();
        return response()->json(['msg' => 'Alterado com sucesso!'], 200);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cep  $cep
     * @return \Illuminate\Http\Response
     */
    public function destroy(cep $cep, $id)
    {
        $cep = $this->cep->find($id);

        if ($cep === null) {
            return response()->json(['erro' =>'O recurso solicitado não existe'], 404);
        }
        $cep->delete();
        return response()->json(['msg' => 'O registro foi removido com sucesso!'], 200);
    }
}
