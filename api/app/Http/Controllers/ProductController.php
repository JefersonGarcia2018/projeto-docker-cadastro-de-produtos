<?php

namespace App\Http\Controllers;

use App\Models\Product; // Importante: Importar o Model!
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Exibe a lista de produtos (O Quasar vai ler aqui)
     */
    public function index()
    {
        return response()->json(Product::all());
    }

    /**
     * Salva um novo produto no banco
     */
    public function store(Request $request)
    {
        // Validação simples para não salvar lixo no banco
        $validated = $request->validate([
            'nome'       => 'required|string|max:255',
            'descricao'  => 'nullable|string',
            'preco'      => 'required|numeric',
            'quantidade' => 'required|integer',
        ]);

        $product = Product::create($validated);

        return response()->json($product, 201); // 201 = Criado com sucesso
    }

    /**
     * Atualiza um produto específico
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'nome'       => 'required|string|max:255',
            'descricao'  => 'nullable|string',
            'preco'      => 'required|numeric',
            'quantidade' => 'required|integer',
        ]);

        $product->update($validated);

        return response()->json($product);
    }

    /**
    * Deleta um produto específico
    */  
    public function destroy(Product $product)
    {
        $product->delete();
        return response()->json(['message' => 'Produto excluído com sucesso']);
    }
}