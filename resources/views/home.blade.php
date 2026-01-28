<x-app-layout>
    <x-slot name="header">
        <!-- Header vazio para remover o título -->
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Logo Teorema Grande -->
            <div class="text-center mb-12">
                <div class="inline-flex items-center justify-center mb-6">
                    <div class="h-24 w-24 bg-blue-600 rounded-2xl flex items-center justify-center shadow-lg">
                        <span class="text-white font-bold text-4xl">T</span>
                    </div>
                </div>
                <h1 class="text-4xl font-bold text-gray-900 mb-4">TEOREMA</h1>
                <p class="text-xl text-gray-600">Documentação de Correções e Melhorias do Sistema</p>
            </div>

            <!-- Conteúdo Principal -->
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-8 lg:p-12">
                    <!-- Introdução -->
                    <div class="mb-10">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Bem-vindo à documentação de correções de chamadas e melhorias do nosso sistema de tecnologia.</h2>
                        <p class="text-gray-700 text-lg leading-relaxed">
                            Este documento tem como objetivo fornecer um guia abrangente e detalhado sobre como documentamos e implementamos as correções de erros (bugs) e as melhorias no sistema. Através deste processo estruturado, buscamos garantir a manutenção da qualidade e a evolução contínua do nosso software, oferecendo uma experiência robusta e confiável aos nossos usuários.
                        </p>
                    </div>

                    <!-- Objetivos -->
                    <div class="mb-10">
                        <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                            <span class="bg-blue-100 text-blue-600 rounded-full p-2 mr-3">🎯</span>
                            Objetivos da Documentação
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-blue-50 p-6 rounded-lg">
                                <h4 class="font-bold text-blue-800 mb-2">Transparência e Clareza</h4>
                                <p class="text-blue-700">Fornecer uma visão clara e detalhada dos problemas encontrados e das ações tomadas para resolvê-los.</p>
                            </div>
                            <div class="bg-green-50 p-6 rounded-lg">
                                <h4 class="font-bold text-green-800 mb-2">Histórico de Alterações</h4>
                                <p class="text-green-700">Manter um registro histórico de todas as correções e melhorias realizadas, facilitando o acompanhamento e a auditoria do desenvolvimento do sistema.</p>
                            </div>
                            <div class="bg-purple-50 p-6 rounded-lg">
                                <h4 class="font-bold text-purple-800 mb-2">Facilitação da Comunicação</h4>
                                <p class="text-purple-700">Melhorar a comunicação entre as equipes de desenvolvimento, suporte e demais stakeholders, garantindo que todos estejam alinhados quanto às mudanças implementadas.</p>
                            </div>
                            <div class="bg-yellow-50 p-6 rounded-lg">
                                <h4 class="font-bold text-yellow-800 mb-2">Aprimoramento Contínuo</h4>
                                <p class="text-yellow-700">Identificar áreas de melhoria contínua no sistema, promovendo um ciclo de feedback e atualização constante.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Melhoria Contínua -->
                    <div class="mb-10">
                        <h3 class="text-xl font-bold text-gray-900 mb-4 flex items-center">
                            <span class="bg-green-100 text-green-600 rounded-full p-2 mr-3">🚀</span>
                            Melhoria Contínua
                        </h3>
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <p class="text-gray-700 leading-relaxed">
                                Além das correções de erros, esta documentação também abrange as melhorias implementadas no sistema. Cada melhoria é registrada de maneira similar às correções de erros, com uma descrição detalhada da funcionalidade aprimorada, a justificativa para a mudança e os benefícios esperados.
                            </p>
                        </div>
                    </div>

                    <!-- Conclusão -->
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-8 rounded-lg">
                        <h3 class="text-xl font-bold text-gray-900 mb-4">Conclusão</h3>
                        <p class="text-gray-700 text-lg leading-relaxed">
                            A documentação sistemática e detalhada das correções de erros e das melhorias é essencial para manter a integridade e a evolução do nosso sistema. Esperamos que este documento sirva como uma referência útil para todos os envolvidos e contribua para um desenvolvimento mais eficiente e transparente. Com este processo, reforçamos nosso compromisso com a qualidade e a satisfação dos nossos usuários.
                        </p>
                    </div>

                    <!-- Acesso Rápido -->
                    <div class="mt-12 pt-8 border-t border-gray-200">
                        <h3 class="text-xl font-bold text-gray-900 mb-6 text-center">Acesso Rápido</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <a href="{{ route('releases.index') }}" 
                               class="bg-white border border-gray-200 rounded-lg p-6 text-center hover:shadow-lg transition-shadow">
                                <div class="text-3xl mb-3">📋</div>
                                <h4 class="font-bold text-gray-900 mb-2">Releases</h4>
                                <p class="text-gray-600 text-sm">Acesse todas as releases documentadas</p>
                            </a>
                            
                            @auth
                                <a href="{{ route('releases.minha-area') }}" 
                                   class="bg-white border border-gray-200 rounded-lg p-6 text-center hover:shadow-lg transition-shadow">
                                    <div class="text-3xl mb-3">👤</div>
                                    <h4 class="font-bold text-gray-900 mb-2">Minha Área</h4>
                                    <p class="text-gray-600 text-sm">Acompanhe suas releases</p>
                                </a>
                                
                                @can('access-analista')
                                    <a href="{{ route('admin.releases.index') }}" 
                                       class="bg-white border border-gray-200 rounded-lg p-6 text-center hover:shadow-lg transition-shadow">
                                        <div class="text-3xl mb-3">⚙️</div>
                                        <h4 class="font-bold text-gray-900 mb-2">Administração</h4>
                                        <p class="text-gray-600 text-sm">Gerencie releases do sistema</p>
                                    </a>
                                @endcan
                            @else
                                <a href="{{ route('login') }}" 
                                   class="bg-white border border-gray-200 rounded-lg p-6 text-center hover:shadow-lg transition-shadow">
                                    <div class="text-3xl mb-3">🔑</div>
                                    <h4 class="font-bold text-gray-900 mb-2">Login</h4>
                                    <p class="text-gray-600 text-sm">Acesse sua conta</p>
                                </a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>