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

        ])->get(['id', 'nome','numero_whatsapp', 'comunidade']);
        return view('dizimista.index', compact('dizimistas'));
    }

    public function todos()
    {
        $dizimistas = Dizimista::all(['id', 'nome','numero_whatsapp', 'comunidade', 'atualizado']);
        return view('dizimista.index_todos', compact('dizimistas'));
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
    private function setaAtributo(&$objeto, $atributo,$request,$eSimNao = false)
    {
        $dado = $request->input($atributo);
        if($eSimNao){
            $dado = ($dado == "Sim")||($dado == "True");
        }
        if($objeto[$atributo]==$dado){
            return false;
        }
        else{
            $objeto[$atributo] = $dado;
            return true;
        }
    }

    public function update($dizimista_id){
        $this->middleware('VerifyCsrfToken');

        $request = Request();
        $dizimista = Dizimista::find($dizimista_id);

        $alterado = $this->setaAtributo($dizimista,'nome',$request);
        $alterado = $this->setaAtributo($dizimista,'data_nascimento',$request) || $alterado;
        $alterado = $this->setaAtributo($dizimista,'sexo',$request) || $alterado;
        $alterado = $this->setaAtributo($dizimista,'naturalidade',$request) || $alterado;
        $alterado = $this->setaAtributo($dizimista,'estado_civil',$request) || $alterado;
        $alterado = $this->setaAtributo($dizimista,'nome_conjuge',$request) || $alterado;
        $alterado = $this->setaAtributo($dizimista,'data_nascimento_conjuge',$request) || $alterado;
        $alterado = $this->setaAtributo($dizimista,'numero_whatsapp',$request) || $alterado;
        $alterado = $this->setaAtributo($dizimista,'numero_fixo',$request) || $alterado;
        $alterado = $this->setaAtributo($dizimista,'email',$request) || $alterado;
        $alterado = $this->setaAtributo($dizimista,'endereco',$request) || $alterado;
        $alterado = $this->setaAtributo($dizimista,'bairro',$request) || $alterado;
        $alterado = $this->setaAtributo($dizimista,'cidade',$request) || $alterado;
        $alterado = $this->setaAtributo($dizimista,'cep',$request) || $alterado;
        $alterado = $this->setaAtributo($dizimista,'comunidade',$request) || $alterado;
        $alterado = $this->setaAtributo($dizimista,'pedido_oracao',$request) || $alterado;
        $alterado = $this->setaAtributo($dizimista,'participa_pastoral',$request,true) || $alterado;
        $alterado = $this->setaAtributo($dizimista,'pastoral_desejada',$request) || $alterado;

        if ($alterado || $request->has('atualizado')) {
            $dizimista->ultimo_atualizador_id = Auth::id();
            $dizimista->ultima_atualizacao = now();
            if($request->has('atualizado')){
                $this->setaAtributo($dizimista,'atualizado',$request, true);
                $alterado = true;
            }
            else{
                $dizimista->atualizado = true;
            }
        }

        if ($alterado && $dizimista->update()){
            $request->session()->flash('mensagem-sucesso', 'Atualizado com Sucesso!');
        }
        else{
            $request->session()->flash('mensagem-falha', 'Não houve atualização dos dados!');
        }
        return redirect()->route('dizimista.index');
    }
}
