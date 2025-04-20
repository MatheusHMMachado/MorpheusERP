<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\PasswordResetController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\HomeController;

use App\Http\Controllers\Menu\UsuarioController;
use App\Http\Controllers\Menu\FornecedorController;
use App\Http\Controllers\Menu\LocalDestinoController;
use App\Http\Controllers\Menu\ProdutoController;
use App\Http\Controllers\Menu\SaidaProdutoController;
use App\Http\Controllers\Menu\EntradaProdutoController;
use App\Http\Controllers\Menu\RelatorioController;
use App\Http\Controllers\Menu\PerfilController;
use App\Http\Controllers\Relatorio\RelatorioUsuarioController;
use App\Http\Controllers\Relatorio\RelatorioSaidaController;


// Auth routes
Route::get('/login', function () {
    return view('auth.login');
})->name('auth.login');

Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/redefinir', [PasswordResetController::class, 'showResetForm'])->name('auth.redefinir');
Route::post('/redefinir', [PasswordResetController::class, 'reset'])->name('auth.redefinir.post');
Route::get('/novasenha', [PasswordResetController::class, 'showNovaSenhaForm'])->name('auth.novasenha');
Route::post('/novasenha', [PasswordResetController::class, 'saveNewPassword'])->name('auth.novasenha.post');

// Home routes
Route::get('/home', [HomeController::class, 'index'])
->name('home');

// Rotas para o perfil do usuário
Route::get('/home/perfil', [PerfilController::class, 'index'])->name('menu.home.perfil');
Route::post('/atualizar-perfil', [PerfilController::class, 'update'])->name('atualizar-perfil');

// Rotas para gerenciamento de Usuários
Route::get('/home/usuarios', [UsuarioController::class, 'index'])->name('menu.usuarios.usuarios');
Route::post('/home/usuarios/store', [UsuarioController::class, 'store'])->name('menu.usuarios.store');

// Rotas para busca e edição de usuários
Route::get('/home/usuarios/buscar', [UsuarioController::class, 'showBuscar'])->name('menu.usuarios.usuarios-buscar');
Route::post('/home/usuarios/search', [UsuarioController::class, 'search'])->name('menu.usuarios.search');
Route::get('/home/usuarios/editar', [UsuarioController::class, 'showEditar'])->name('menu.usuarios.usuarios-editar');
Route::post('/home/usuarios/update', [UsuarioController::class, 'update'])->name('menu.usuarios.usuarios-update');

// Rotas para gerenciamento de Fornecedor
Route::get('/home/fornecedor', [FornecedorController::class, 'index'])->name('menu.fornecedor.fornecedor');
Route::post('/home/fornecedor/store', [FornecedorController::class, 'store'])->name('menu.fornecedor.store');

// Rotas para busca e edição de fornecedores
Route::get('/home/fornecedor/buscar', [FornecedorController::class, 'showBuscar'])->name('menu.fornecedor.fornecedor-buscar');
Route::post('/home/fornecedor/search', [FornecedorController::class, 'search'])->name('menu.fornecedor.search');
Route::get('/home/fornecedor/editar', [FornecedorController::class, 'showEditar'])->name('menu.fornecedor.fornecedor-editar');
Route::post('/home/fornecedor/update', [FornecedorController::class, 'update'])->name('menu.fornecedor.fornecedor-update');


// Rotas para gerenciamento de Local de Destino
Route::get('home/local-destino', [LocalDestinoController::class, 'index'])->name('menu.local-destino.local-destino');
Route::get('home/local-destino/buscar', [LocalDestinoController::class, 'showBuscar'])->name('menu.local-destino.local-destino-buscar');
Route::get('home/local-destino/editar', [LocalDestinoController::class, 'showEditar'])->name('menu.local-destino.local-destino-editar');
Route::post('home/local-destino/store', [LocalDestinoController::class, 'store'])->name('menu.local-destino.store');
Route::post('home/local-destino/search', [LocalDestinoController::class, 'search'])->name('menu.local-destino.search');
Route::post('home/local-destino/find', [LocalDestinoController::class, 'find'])->name('menu.local-destino.find');
Route::post('home/local-destino/update', [LocalDestinoController::class, 'update'])->name('menu.local-destino.local-destino-update');
Route::delete('home/local-destino/delete/{id}', [LocalDestinoController::class, 'destroy']);

// Rotas para gerenciamento de Produtos
Route::get('home/produtos', [ProdutoController::class, 'index'])->name('menu.produtos.produtos');
Route::post('home/produtos/store', [ProdutoController::class, 'store'])->name('produto.store');

// Rotas para busca e edição de produtos
Route::get('home/produtos/buscar', [ProdutoController::class, 'showBuscar'])->name('menu.produtos.produtos-buscar');
Route::get('home/produtos/search', [ProdutoController::class, 'search'])->name('produto.search');
Route::get('home/produtos/find', [ProdutoController::class, 'find'])->name('produto.find');
Route::get('home/produtos/editar', [ProdutoController::class, 'showEditar'])->name('menu.produtos.produtos-editar');
Route::post('home/produtos/update', [ProdutoController::class, 'update'])->name('produto.update');


// Rotas para Saida de Produtos
Route::get('home/saida-produtos', [SaidaProdutoController::class, 'index'])->name('menu.saida-produtos.saida-produtos');
Route::post('home/saida-produtos/store', [SaidaProdutoController::class, 'store'])->name('saida-produto.store');

// Rotas para busca e edição de saída de produtos
Route::get('home/saida-produtos/buscar', [SaidaProdutoController::class, 'showBuscar'])->name('menu.saida-produtos.saida-produtos-buscar');
Route::post('home/saida-produtos/search', [SaidaProdutoController::class, 'search'])->name('saida-produto.search');
Route::post('home/saida-produtos/find', [SaidaProdutoController::class, 'find'])->name('saida-produto.find');
Route::get('home/saida-produtos/editar', [SaidaProdutoController::class, 'showEditar'])->name('menu.saida-produtos.saida-produtos-editar');
Route::post('home/saida-produtos/update', [SaidaProdutoController::class, 'update'])->name('saida-produto.update');
Route::post('home/saida-produtos/destroy', [SaidaProdutoController::class, 'destroy'])->name('saida-produto.destroy');

// Rotas para Entrada de Produtos
Route::get('home/entrada-produtos', [EntradaProdutoController::class, 'index'])->name('menu.entrada-produtos.entrada-produtos');
Route::post('home/entrada-produtos/store', [EntradaProdutoController::class, 'store'])->name('entrada-produto.store');

// Rotas para busca e edição de entrada de produtos
Route::get('home/entrada-produtos/buscar', [EntradaProdutoController::class, 'showBuscar'])->name('menu.entrada-produtos.entrada-produtos-buscar');
Route::post('home/entrada-produtos/search', [EntradaProdutoController::class, 'search'])->name('entrada-produto.search');
Route::post('home/entrada-produtos/find', [EntradaProdutoController::class, 'find'])->name('entrada-produto.find');
Route::get('home/entrada-produtos/editar', [EntradaProdutoController::class, 'showEditar'])->name('menu.entrada-produtos.entrada-produtos-editar');
Route::post('home/entrada-produtos/update', [EntradaProdutoController::class, 'update'])->name('entrada-produto.update');
Route::post('home/entrada-produtos/destroy', [EntradaProdutoController::class, 'destroy'])->name('entrada-produto.destroy');

// Rotas para Relatorio
Route::get('home/relatorio', [RelatorioController::class, 'index'])->name('menu.relatorio.relatorio');

// Rotas para relatório de usuários
Route::get('home/menu/relatorio/usuarios', [RelatorioUsuarioController::class, 'index'])->name('menu.relatorio.usuarios');
Route::post('home/menu/relatorio/usuarios/search', [RelatorioUsuarioController::class, 'search'])->name('menu.relatorio.usuarios.search');

Route::get('home/menu/relatorio/fornecedores', [RelatorioController::class, 'fornecedoresRelatorio'])->name('menu.relatorio.fornecedores-relatorio');
Route::post('home/menu/relatorio/fornecedores/search', [RelatorioController::class, 'searchFornecedores'])->name('menu.relatorio.fornecedores.search');

Route::get('home/menu/relatorio/locais', [RelatorioController::class, 'locaisRelatorio'])->name('menu.relatorio.locais-relatorio');
Route::post('home/menu/relatorio/locais/search', [RelatorioController::class, 'searchLocais'])->name('menu.relatorio.locais.search');

Route::get('home/menu/relatorio/produtos', [RelatorioController::class, 'produtosRelatorio'])->name('menu.relatorio.produtos-relatorio');
Route::post('home/menu/relatorio/produtos/search', [RelatorioController::class, 'searchProdutos'])->name('menu.relatorio.produtos.search');

// Relatório de Entrada de Produtos
Route::get('home/menu/relatorio/entradas', [RelatorioController::class, 'entradasRelatorio'])->name('menu.relatorio.entradas-relatorio');
Route::post('home/menu/relatorio/entradas/search', [RelatorioController::class, 'searchEntradas'])->name('menu.relatorio.entradas.search');
Route::post('home/menu/relatorio/entradas/detalhes', [RelatorioController::class, 'detalhesEntrada'])->name('menu.relatorio.entradas.detalhes');

// Relatório de Saída de Produtos
Route::get('home/menu/relatorio/saidas', [RelatorioSaidaController::class, 'index'])->name('menu.relatorio.saidas-relatorio');
Route::post('home/menu/relatorio/saidas/search', [RelatorioSaidaController::class, 'search'])->name('menu.relatorio.saidas.search');
Route::post('home/menu/relatorio/saidas/detalhes', [RelatorioSaidaController::class, 'detalhes'])->name('menu.relatorio.saidas.detalhes');

