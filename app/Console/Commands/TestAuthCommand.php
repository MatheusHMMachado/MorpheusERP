<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class TestAuthCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'auth:test {email?} {senha?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Test authentication with admin credentials';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $email = $this->argument('email') ?? 'admin@gmail.com';
        $senha = $this->argument('senha') ?? '1234';

        $this->info("Teste de autenticação com credenciais: $email / $senha");
        
        // Verificar conexão com o banco de dados
        try {
            $this->info("Testando conexão com o banco de dados...");
            DB::connection()->getPdo();
            $this->info("✓ Conexão com o banco estabelecida: " . DB::connection()->getDatabaseName());
        } catch (\Exception $e) {
            $this->error("✗ Erro na conexão com o banco: " . $e->getMessage());
            return 1;
        }
        
        // Listar tabelas no banco
        $this->info("Tabelas no banco de dados:");
        $tables = DB::select('SHOW TABLES');
        foreach ($tables as $table) {
            $tableName = array_values(get_object_vars($table))[0];
            $this->info("- $tableName");
        }
        
        // Verificar se a tabela usuario existe
        $this->info("Verificando tabela 'usuario'...");
        if (Schema::hasTable('usuario')) {
            $this->info("✓ Tabela 'usuario' existe");
            
            // Listar colunas da tabela usuario
            $this->info("Colunas na tabela 'usuario':");
            $columns = Schema::getColumnListing('usuario');
            foreach ($columns as $column) {
                $this->info("- $column");
            }
        } else {
            $this->error("✗ Tabela 'usuario' não existe");
            return 1;
        }
        
        // Buscar usuário admin
        $this->info("Buscando usuário com email '$email'...");
        $user = User::where('email', $email)->first();
        
        if (!$user) {
            $this->error("✗ Usuário não encontrado");
            return 1;
        }
        
        $this->info("✓ Usuário encontrado:");
        $this->info("- ID: {$user->id}");
        $this->info("- Nome: {$user->nome_Usuario}");
        $this->info("- Tipo: {$user->tipo_Usuario}");
        $this->info("- Hash da senha: {$user->senha}");
        
        // Testar validação de senha
        $this->info("Testando senha...");
        if (Hash::check($senha, $user->senha)) {
            $this->info("✓ Senha correta!");
        } else {
            $this->error("✗ Senha incorreta");
            return 1;
        }
        
        $this->info("✓ Teste de autenticação concluído com sucesso!");
        return 0;
    }
}