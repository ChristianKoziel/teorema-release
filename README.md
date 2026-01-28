<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Release Week - Documentação</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f8fafc;
            color: #1f2937;
            margin: 0;
            padding: 40px;
            line-height: 1.6;
        }
        h1, h2, h3 {
            color: #0f172a;
        }
        h1 {
            border-bottom: 2px solid #e5e7eb;
            padding-bottom: 10px;
        }
        code, pre {
            background: #0f172a;
            color: #e5e7eb;
            padding: 12px;
            border-radius: 6px;
            display: block;
            overflow-x: auto;
        }
        ul {
            padding-left: 20px;
        }
        .badge {
            display: inline-block;
            background: #e5e7eb;
            color: #111827;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 12px;
            margin-right: 6px;
        }
        .section {
            margin-bottom: 40px;
        }
        footer {
            margin-top: 60px;
            font-size: 14px;
            color: #6b7280;
        }
    </style>
</head>
<body>

<h1>📋 Release Week</h1>

<p>
Sistema web desenvolvido em <strong>Laravel 12.x</strong> para documentação e gerenciamento de releases
(correções e melhorias), com organização por <strong>ano, mês e semana</strong>, controle de status
e permissões por perfil de usuário.
</p>

<div class="section">
    <h2>🚀 Tecnologias</h2>
    <ul>
        <li>Laravel 12.x</li>
        <li>PHP 8.3.17</li>
        <li>MySQL</li>
        <li>Tailwind CSS</li>
        <li>Laravel Breeze</li>
        <li>Blade Templates</li>
    </ul>
</div>

<div class="section">
    <h2>🎯 Funcionalidades</h2>
    <ul>
        <li>Autenticação com controle de roles (admin e analista)</li>
        <li>CRUD completo de releases</li>
        <li>Status: rascunho, em análise e aprovado</li>
        <li>Upload de imagens (até 2MB)</li>
        <li>Menu lateral hierárquico (Ano → Mês → Semana)</li>
        <li>Busca por palavras-chave com filtros combinados</li>
        <li>Visualização pública apenas de releases aprovadas</li>
        <li>Layout responsivo</li>
    </ul>
</div>

<div class="section">
    <h2>👥 Perfis de Usuário</h2>
    <p>
        <span class="badge">Admin</span> acesso total, aprova releases<br>
        <span class="badge">Analista</span> cria e edita apenas próprias releases<br>
        <span class="badge">Visitante</span> visualiza somente releases aprovadas
    </p>
</div>

<div class="section">
    <h2>🗄️ Modelo de Dados (Resumo)</h2>
    <ul>
        <li>Releases: número do chamado, agente, descrição, código, data, tipo, ano, mês, semana, status</li>
        <li>Usuários: nome, email, senha, role</li>
    </ul>
</div>

<div class="section">
    <h2>⚙️ Instalação</h2>

    <h3>Pré-requisitos</h3>
    <ul>
        <li>PHP 8.3+</li>
        <li>Composer</li>
        <li>Node.js + NPM</li>
        <li>MySQL</li>
    </ul>

    <h3>Clonar o projeto</h3>
    <pre>git clone https://github.com/seu-usuario/release-week.git
cd release-week</pre>

    <h3>Instalar dependências</h3>
    <pre>composer install
npm install
npm run build</pre>

    <h3>Configurar ambiente (.env)</h3>
    <pre>DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=release_week_db
DB_USERNAME=root
DB_PASSWORD=</pre>

    <h3>Migrar banco</h3>
    <pre>php artisan migrate</pre>

    <h3>Configurar storage</h3>
    <pre>php artisan storage:link</pre>

    <h3>Rodar aplicação</h3>
    <pre>php artisan serve</pre>

    <p>Acesse: <strong>http://localhost:8000</strong></p>
</div>

<div class="section">
    <h2>🔐 Usuários de Teste</h2>

    <p><strong>Admin</strong><br>
    Email: admin@releaseweek.com<br>
    Senha: 12345678</p>

    <p><strong>Analista</strong><br>
    Email: analista@releaseweek.com<br>
    Senha: 12345678</p>
</div>

<div class="section">
    <h2>🔧 Comandos Úteis</h2>
    <pre>php artisan optimize:clear
php artisan route:list
npm run dev</pre>
</div>

<div class="section">
    <h2>🐛 Problemas Comuns</h2>
    <ul>
        <li>Imagens não carregam → <code>php artisan storage:link</code></li>
        <li>Erro 404 → <code>php artisan route:clear</code></li>
        <li>Menu vazio → verificar releases aprovadas</li>
    </ul>
</div>

<footer>
    <p></p>
</footer>

</body>
</html>
