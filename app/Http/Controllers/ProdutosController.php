<?php
/**
 * Created by PhpStorm.
 * User: alanoteles
 * Date: 01/03/16
 * Time: 16:35
 */

namespace Iba\Http\Controllers;


use Iba\Http\Controllers\Controller;
use Iba\Produto;
use Iba\Http\Requests\ProdutoRequest;

class ProdutosController extends Controller
{

    public function index(){

        $prod = new Produto();
        $produtos = $prod->all();

//        echo '<pre>';
//        print_r($produtos);die;
        return view('produtos.index', ['produtos'=>$produtos]);
    }

    public function create(){
        return view('produtos.create');
    }


    public function store(ProdutoRequest $request){
        $input = $request->all();
        Produto::create($input);

        return redirect('produtos');
    }


    public function destroy($id){
        Produto::find($id)->delete();

        return redirect('produtos');

    }


    public function edit($id){

        $produto = Produto::find($id);

        return view('produtos.edit', compact('produto'));
    }
}