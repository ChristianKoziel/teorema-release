# 📋 Release Week

Sistema web desenvolvido em **Laravel 12.x** para documentação e gerenciamento de releases  
(correções e melhorias), com organização por **ano, mês e semana**, controle de status  
e permissões por perfil de usuário.

---

## 🚀 Tecnologias

- Laravel 12.x
- PHP 8.3.17
- MySQL
- Tailwind CSS
- Laravel Breeze
- Blade Templates

---

## 🎯 Funcionalidades

- Autenticação com controle de roles (**admin** e **analista**)
- CRUD completo de releases
- Status das releases:
  - 📝 Rascunho
  - 🔍 Em análise
  - ✅ Aprovado
- Upload de imagens (até 2MB)
- Menu lateral hierárquico (**Ano → Mês → Semana**)
- Busca por palavras-chave com filtros combinados
- Visualização pública apenas de releases aprovadas
- Layout responsivo (desktop, tablet e mobile)

---

## 👥 Perfis de Usuário

- **Admin**  
  Acesso total ao sistema, pode aprovar releases

- **Analista**  
  Cria e edita apenas as próprias releases

- **Visitante**  
  Visualiza somente releases aprovadas

---

## 🗄️ Modelo de Dados (Resumo)

### Releases
- Número do chamado
- Agente
- Descrição
- Código da release
- Data de liberação
- Tipo (Correção | Melhoria)
- Ano / Mês / Semana
- Status
- Imagem (opcional)
- Link de manual (opcional)

### Usuários
- Nome
- Email
- Senha
- Role (`admin` | `analista`)

---

## ⚙️ Instalação

### Pré-requisitos
- PHP 8.3+
- Composer
- Node.js + NPM
- MySQL

---

### Clonar o projeto
```bash
git clone https://github.com/seu-usuario/release-week.git
cd release-week
Instalar dependências
bash
Copiar código
composer install
npm install
npm run build
Configurar ambiente (.env)
env
Copiar código
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=release_week_db
DB_USERNAME=root
DB_PASSWORD=
Crie o banco de dados antes de continuar.

Migrar banco
bash
Copiar código
php artisan migrate
Configurar storage
bash
Copiar código
php artisan storage:link
Rodar aplicação
bash
Copiar código
php artisan serve
Acesse:

arduino
Copiar código
http://localhost:8000
🔐 Usuários de Teste
Admin
Email: admin@releaseweek.com

Senha: 12345678

Analista
Email: analista@releaseweek.com

Senha: 12345678

🔧 Comandos Úteis
bash
Copiar código
php artisan optimize:clear
php artisan route:list
npm run dev