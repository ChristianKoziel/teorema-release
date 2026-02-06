<!DOCTYPE html>
<html>
<head>
    
</head>
<body>

<div class="header">
    <h1>📋 Sistema de Documentação de Releases</h1>
    <p>Sistema web desenvolvido em Laravel para documentação e gerenciamento de lançamentos (correções e melhorias), com organização por ano, mês e semana, controle de status e permissões por perfil de usuário.</p>
</div>

<h2>🚀 Tecnologias</h2>
<ul class="feature-list">
    <li>Laravel 12.x</li>
    <li>PHP 8.3.17</li>
    <li>MySQL</li>
    <li>Bootstrap 5</li>
    <li>Font Awesome 6</li>
    <li>Laravel Breeze</li>
</ul>

<h2>🎯 Funcionalidades</h2>
<ul class="feature-list">
    <li>Autenticação com controle de funções (administrador e analista)</li>
    <li>CRUD completo de releases</li>
    <li>Status das releases:
        <ul>
            <li><span class="emoji">📝</span> Rascunho</li>
            <li><span class="emoji">🔍</span> Em análise</li>
            <li><span class="emoji">✅</span> Aprovado</li>
        </ul>
    </li>
    <li>Upload de imagens (até 2MB)</li>
    <li>Menu lateral hierárquico (Ano → Mês → Semana)</li>
    <li>Busca por palavras-chave com filtros combinados</li>
    <li>Visualização pública apenas de lançamentos aprovados</li>
    <li>Layout responsivo (desktop, tablet e mobile)</li>
</ul>

<h2>👥 Perfis de Usuário</h2>
<table>
    <tr>
        <th>Perfil</th>
        <th>Permissões</th>
    </tr>
    <tr>
        <td><strong>Admin</strong></td>
        <td>Acesso total ao sistema, pode aprovar lançamentos</td>
    </tr>
    <tr>
        <td><strong>Analista</strong></td>
        <td>Cria e edita apenas os lançamentos próprios</td>
    </tr>
    <tr>
        <td><strong>Visitante</strong></td>
        <td>Visualiza somente releases aprovados</td>
    </tr>
</table>

<h2>🗄️ Modelo de Dados (Resumo)</h2>
<h3>Lançamentos</h3>
<ul class="feature-list">
    <li>Número do chamado</li>
    <li>Agente</li>
    <li>Descrição</li>
    <li>Código da release</li>
    <li>Data de liberação</li>
    <li>Tipo (Correção | Melhoria)</li>
    <li>Ano / Mês / Semana</li>
    <li>Status</li>
    <li>Imagem (opcional)</li>
    <li>Link do manual (opcional)</li>
</ul>

<h3>Usuários</h3>
<ul class="feature-list">
    <li>Nome</li>
    <li>E-mail</li>
    <li>Senha</li>
    <li>Função (admin|analista)</li>
</ul>

<hr>

<h1>🚀 Instalação no Windows</h1>

<div class="alert">
    <strong>📋 Pré-requisitos:</strong>
    <ol>
        <li><strong>XAMPP</strong> (recomendado) ou servidor local com:
            <ul>
                <li>PHP 8.3+</li>
                <li>MySQL</li>
                <li>Apache</li>
            </ul>
        </li>
        <li><strong>Composer</strong> - <a href="https://getcomposer.org/download/">Download</a></li>
        <li><strong>Node.js + NPM</strong> - <a href="https://nodejs.org/">Download</a></li>
        <li><strong>Git</strong> - <a href="https://git-scm.com/download/win">Download</a></li>
    </ol>
</div>

<h3>📥 1. Clonar o Projeto</h3>
<pre><code>git clone https://github.com/ChristianKoziel/teorema-release.git
cd teorema-release</code></pre>

<h3>📦 2. Instalar Dependências PHP</h3>
<pre><code>composer install</code></pre>

<h3>🎨 3. Instalar Dependências Front-end</h3>
<pre><code>npm install
npm install bootstrap @fortawesome/fontawesome-free
npm run build</code></pre>

<h3>⚙️ 4. Configurar Ambiente</h3>
<p>Copie o arquivo <code>.env.example</code> para <code>.env</code>:</p>
<pre><code>copy .env.example .env</code></pre>
<p>Edite o arquivo <code>.env</code> com suas configurações:</p>
<pre><code>DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=release_week_db
DB_USERNAME=root
DB_PASSWORD=

# Se usar XAMPP, a senha pode ser vazia:
DB_PASSWORD=

# Ou se configurou senha no MySQL:
DB_PASSWORD=sua_senha</code></pre>
<p>Gere a chave da aplicação:</p>
<pre><code>php artisan key:generate</code></pre>

<h3>🗄️ 5. Criar Banco de Dados</h3>
<ol>
    <li>Abra o <strong>phpMyAdmin</strong> (<a href="http://localhost/phpmyadmin">http://localhost/phpmyadmin</a>)</li>
    <li>Crie um novo banco de dados chamado: <code>release_week_db</code></li>
    <li>Ou crie via linha de comando:
        <pre><code>mysql -u root -p -e "CREATE DATABASE release_week_db;"</code></pre>
    </li>
</ol>

<h3>🔄 6. Migrar Banco de Dados</h3>
<pre><code>php artisan migrate</code></pre>

<h3>📁 7. Configurar Storage</h3>
<pre><code>php artisan storage:link</code></pre>

<h3>👥 8. Criar Usuários de Teste (Opcional)</h3>
<pre><code>php artisan db:seed</code></pre>

<h3>🚀 9. Iniciar o Servidor</h3>
<pre><code>php artisan serve</code></pre>
<p>Acesse no navegador:</p>
<pre><code>http://localhost:8000</code></pre>

<h2>🔐 Usuários de Teste (Se rodou o seed)</h2>
<table>
    <tr>
        <th>Perfil</th>
        <th>Email</th>
        <th>Senha</th>
    </tr>
    <tr>
        <td><strong>Admin</strong></td>
        <td>admin@releaseweek.com</td>
        <td>12345678</td>
    </tr>
    <tr>
        <td><strong>Analista</strong></td>
        <td>analista@releaseweek.com</td>
        <td>12345678</td>
    </tr>
</table>

<h2>🛠️ Solução de Problemas Comuns</h2>

<h3>❌ Erro: "Class not found" ou problemas com Composer</h3>
<pre><code>composer dump-autoload
php artisan optimize:clear</code></pre>

<h3>❌ Erro: Permissões no Windows</h3>
<pre><code># No PowerShell como Administrador:
icacls storage /grant "Users:(OI)(CI)F"
icacls bootstrap/cache /grant "Users:(OI)(CI)F"</code></pre>

<h3>❌ Erro: Node.js não encontrado</h3>
<ol>
    <li>Reinicie o PC após instalar Node.js</li>
    <li>Verifique se Node.js está no PATH:
        <pre><code>node --version
npm --version</code></pre>
    </li>
</ol>

<h3>❌ Erro: MySQL não conecta</h3>
<ol>
    <li>Verifique se MySQL está rodando no XAMPP</li>
    <li>Teste a conexão:
        <pre><code>mysql -u root -p</code></pre>
    </li>
</ol>

<h2>🔧 Comandos Úteis</h2>
<h3>Desenvolvimento</h3>
<pre><code># Iniciar servidor
php artisan serve

# Compilar assets em tempo real
npm run dev

# Compilar para produção
npm run build

# Limpar cache
php artisan optimize:clear

# Listar rotas
php artisan route:list</code></pre>

<h3>Manutenção</h3>
<pre><code># Rodar migrações
php artisan migrate

# Rollback da última migração
php artisan migrate:rollback

# Criar novo controller
php artisan make:controller NomeController

# Criar nova migration
php artisan make:migration nome_da_migration</code></pre>

<h2>📁 Estrutura de Pastas</h2>
<pre><code>release-week/
├── app/           # Lógica da aplicação
├── bootstrap/     # Inicialização
├── config/        # Configurações
├── database/      # Migrations e seeds
├── public/        # Arquivos públicos
├── resources/     # Views e assets
├── routes/        # Rotas
├── storage/       # Uploads e cache
└── vendor/        # Dependências PHP</code></pre>

<h2>📞 Suporte</h2>
<h3>Problemas conhecidos:</h3>
<ol>
    <li><strong>Windows Defender bloqueia scripts</strong>:
        <ul>
            <li>Execute PowerShell como Admin: <code>Set-ExecutionPolicy RemoteSigned</code></li>
        </ul>
    </li>
    <li><strong>Porta 8000 em uso</strong>:
        <pre><code>php artisan serve --port=8080</code></pre>
    </li>
    <li><strong>Imagens não aparecem</strong>:
        <pre><code>php artisan storage:link</code></pre>
    </li>
</ol>

<h2>📄 Licença</h2>

<p>🎯 <strong>Sobre a Teorema Sistemas</strong></p>
<p>Este projeto faz parte do ecossistema de soluções da <strong>Teorema Sistemas</strong>, empresa especializada em desenvolvimento de software personalizado e sistemas de gestão empresarial.</p>



<div style="background: #f8f9fa; padding: 15px; border-left: 4px solid #0366d6; margin: 20px 0; border-radius: 5px;">
    <p style="margin: 0;"><strong>🏢 Teorema Sistemas</strong> - Transformando ideias em soluções tecnológicas inovadoras.</p>
</div>

</body>
</html>
