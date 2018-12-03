<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Dizimista;

class DizimistaController extends Controller
{
    //tem que está logado
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $dizimistas = Dizimista::where([
            'atualizado' => false,

        ])->get();
        return view('dizimista.index', compact('dizimistas'));
    }

    public function show($id){
        $dizimista = Dizimista::find($id);
        if($dizimista){
            return view('dizimista.carregar', compact('dizimista'));
        }
        else{
            return view('not_found');
        }
    }

    public function update($dizimista_id){
        $this->middleware('VerifyCsrfToken');
        $request = Request();
        $dizimista = Dizimista::find($dizimista_id);


        $dizimista->ultimo_atualizador_id = Auth::id();
        $dizimista->ultima_atualizacao = now();

        $dizimista->nome = $request->input('nome');
        $dizimista->data_nascimento = $request->input('data_nascimento');
        $dizimista->sexo = $request->input('sexo');
        $dizimista->naturalidade = $request->input('naturalidade');
        $dizimista->nome_conjuge = $request->input('nome_conjuge');
        $dizimista->data_nascimento_conjuge = $request->input('data_nascimento_conjuge');
        $dizimista->numero_whatsapp = $request->input('numero_whatsapp');
        $dizimista->numero_fixo = $request->input('numero_fixo');
        $dizimista->email = $request->input('email');
        $dizimista->endereco = $request->input('data_nascimento');
        $dizimista->bairro = $request->input('bairro');
        $dizimista->cidade = $request->input('cidade');
        $dizimista->cep = $request->input('cep');
        $dizimista->comunidade = $request->input('comunidade');
        $dizimista->pedido_oracao = $request->input('pedido_oracao');
        $dizimista->participa_pastoral = (boolean)$request->input('participa_pastoral');
        $dizimista->pastoral_desejada = $request->input('pastoral_desejada');
        $dizimista->atualizado = (boolean)$request->input('atualizado');

        
        if ($dizimista->update()){
            $request->session()->flash('mensagem-sucesso', 'Atualizado com Sucesso!');
        }
        else{
            $request->session()->flash('mensagem-falha', 'Não foi possível atualizar!');
        }
        return redirect()->route('dizimista.index');
    }
}
