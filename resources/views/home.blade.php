@extends('layouts.app')

@section('title', 'Home - Teorema Sistemas')

@section('content')
<div class="hero-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h1 class="hero-title">Documentação de Releases</h1>
                <p class="hero-subtitle">
                    Bem-vindo ao sistema de documentação de releases, correções e melhorias da Teorema Sistemas.
                    Mantenha-se atualizado sobre as últimas atualizações do nosso sistema.
                </p>
            </div>
        </div>
    </div>
</div>

<!-- SEÇÃO DE DOCUMENTAÇÃO DE CORREÇÕES -->
<div class="container py-5">
    <div class="doc-content">
        <div class="doc-header">
            <h1 class="doc-title">Documentação de Correções e Melhorias do Sistema</h1>
            <p class="doc-subtitle">
                Bem-vindo à documentação de correções de chamadas e melhorias do nosso sistema de tecnologia. 
                Este documento tem como objetivo fornecer um guia abrangente e detalhado sobre como documentamos 
                e implementamos as correções de erros (bugs) e as melhorias no sistema.
            </p>
        </div>

        <div class="doc-section">
            <h2 class="doc-section-title">
                <i class="fas fa-bullseye"></i>Objetivos da Documentação
            </h2>
            <p class="doc-text">
                Através deste processo estruturado, buscamos garantir a manutenção da qualidade e a evolução 
                contínua do nosso software, oferecendo uma experiência robusta e confiável aos nossos usuários.
            </p>
            
            <div class="process-steps">
            <div class="process-step">
                <div class="step-icon">
                    <i class="fas fa-eye"></i>
                </div>
                <h3 class="step-title">Transparência e Clareza</h3>
                <p class="step-description">
                    Fornecer uma visão clara e detalhada dos problemas encontrados e das ações 
                    tomadas para resolvê-los.
                </p>
            </div>
            
            <div class="process-step">
                <div class="step-icon">
                    <i class="fas fa-history"></i>
                </div>
                <h3 class="step-title">Histórico de Alterações</h3>
                <p class="step-description">
                    Manter um registro histórico de todas as correções e melhorias realizadas, 
                    facilitando o acompanhamento e a auditoria do desenvolvimento do sistema.
                </p>
            </div>
            
            <div class="process-step">
                <div class="step-icon">
                    <i class="fas fa-comments"></i>
                </div>
                <h3 class="step-title">Facilitação da Comunicação</h3>
                <p class="step-description">
                    Melhorar a comunicação entre as equipes de desenvolvimento, suporte e demais 
                    stakeholders, garantindo que todos estejam alinhados quanto às mudanças implementadas.
                </p>
            </div>
            
            <div class="process-step">
                <div class="step-icon">
                    <i class="fas fa-chart-line"></i>
                </div>
                <h3 class="step-title">Aprimoramento Contínuo</h3>
                <p class="step-description">
                    Identificar áreas de melhoria contínua no sistema, promovendo um ciclo de 
                    feedback e atualização constante.
                </p>
            </div>
        </div>
        </div>

        {{-- <div class="doc-section">
            <h2 class="doc-section-title">
                <i class="fas fa-tools"></i>Processo de Documentação
            </h2>
            <p class="doc-text">
                Cada correção de erro (bug) é registrada com informações detalhadas, incluindo:
            </p>
            
            <ul class="doc-list">
                <li class="doc-list-item">
                    <i class="fas fa-bug"></i>
                    <strong>Descrição do Problema</strong>
                    <p>Uma explicação clara e detalhada do erro encontrado, incluindo os sintomas observados e o impacto no sistema.</p>
                </li>
                
                <li class="doc-list-item">
                    <i class="fas fa-search"></i>
                    <strong>Causa Raiz</strong>
                    <p>Análise técnica que identifica a origem do problema, incluindo investigação de logs, código-fonte e comportamento do sistema.</p>
                </li>
                
                <li class="doc-list-item">
                    <i class="fas fa-wrench"></i>
                    <strong>Solução Implementada</strong>
                    <p>Descrição detalhada da correção aplicada, incluindo alterações de código, configurações ajustadas e procedimentos executados.</p>
                </li>
                
                <li class="doc-list-item">
                    <i class="fas fa-vial"></i>
                    <strong>Testes Realizados</strong>
                    <p>Registro dos testes executados para validar a correção, incluindo cenários testados e resultados obtidos.</p>
                </li>
                
                <li class="doc-list-item">
                    <i class="fas fa-calendar-check"></i>
                    <strong>Data e Responsável</strong>
                    <p>Informações sobre quando a correção foi realizada e quem foi o responsável pela implementação.</p>
                </li>
            </ul>
        </div> --}}

        <div class="doc-highlight-box">
            <h3 class="doc-highlight-title">
                <i class="fas fa-chart-line"></i>Melhoria Contínua
            </h3>
            <p class="doc-text">
                Além das correções de erros, esta documentação também abrange as melhorias implementadas no sistema. 
                Cada melhoria é registrada de maneira similar às correções de erros, com uma descrição detalhada da 
                funcionalidade aprimorada, a justificativa para a mudança e os benefícios esperados.
            </p>
        </div>

        <div class="doc-section">
            <h2 class="doc-section-title">
                <i class="fas fa-clipboard-check"></i>Garantia de Qualidade
            </h2>
            <p class="doc-text">
                Para garantir a qualidade das correções e melhorias, seguimos um processo rigoroso que inclui:
            </p>
            
            <ul class="doc-list">
                <li class="doc-list-item">
                    <i class="fas fa-code-branch"></i>
                    <strong>Revisão de Código</strong>
                    <p>Todas as alterações passam por revisão técnica por pelo menos um desenvolvedor sênior antes da implementação.</p>
                </li>
                
                <li class="doc-list-item">
                    <i class="fas fa-server"></i>
                    <strong>Ambientes de Teste</strong>
                    <p>Utilizamos ambientes de staging idênticos à produção para validar as correções antes do deploy.</p>
                </li>
                
                <li class="doc-list-item">
                    <i class="fas fa-history"></i>
                    <strong>Rollback Automatizado</strong>
                    <p>Procedimentos de rollback são preparados e testados para cada deploy, garantindo reversibilidade em caso de problemas.</p>
                </li>
                
                <li class="doc-list-item">
                    <i class="fas fa-shield-alt"></i>
                    <strong>Monitoramento Pós-Implementação</strong>
                    <p>Após cada deploy, monitoramos ativamente o sistema para identificar qualquer comportamento inesperado.</p>
                </li>
            </ul>
        </div>

        <div class="doc-footer">
            <p class="doc-footer-text">
                A documentação sistemática e detalhada das correções de erros e das melhorias é essencial para 
                manter a integridade e a evolução do nosso sistema. Esperamos que este documento sirva como uma 
                referência útil para todos os envolvidos e contribua para um desenvolvimento mais eficiente e 
                transparente. Com este processo, reforçamos nosso compromisso com a qualidade e a satisfação 
                dos nossos usuários.
            </p>
        </div>
    </div>
</div>
<!-- FIM DA SEÇÃO DE DOCUMENTAÇÃO -->

<!-- SEÇÃO DOS OBJETIVOS (se você já tiver essa seção, mantenha-a abaixo) -->
<div class="info-section">
    <div class="container">
        <h2 class="section-title">Nosso Objetivo</h2>
        <div class="row g-4">
            <div class="col-lg-3 col-md-6">
                <div class="objective-card">
                    <div class="objective-icon">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <h4>Comunicação Clara</h4>
                    <p>Fornecer informações transparentes sobre as atualizações e melhorias do sistema.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="objective-card">
                    <div class="objective-icon">
                        <i class="fas fa-history"></i>
                    </div>
                    <h4>Histórico Completo</h4>
                    <p>Manter um registro detalhado de todas as releases e correções implementadas.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="objective-card">
                    <div class="objective-icon">
                        <i class="fas fa-search"></i>
                    </div>
                    <h4>Facilidade de Busca</h4>
                    <p>Permitir busca rápida e eficiente por releases específicas ou temas.</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-6">
                <div class="objective-card">
                    <div class="objective-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h4>Colaboração</h4>
                    <p>Promover a colaboração entre equipes através de documentação acessível.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Adicione os estilos CSS necessários para a documentação -->
<style>
    .doc-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem;
    }

    .doc-header {
        text-align: center;
        margin-bottom: 3rem;
        padding-bottom: 2rem;
        border-bottom: 1px solid var(--neutral-200);
    }

    .doc-title {
        color: var(--teorema-blue);
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 1rem;
        letter-spacing: -0.02em;
    }

    .doc-subtitle {
        color: var(--neutral-600);
        font-size: 1.2rem;
        line-height: 1.6;
        max-width: 800px;
        margin: 0 auto;
    }

    .doc-section {
        background: #ffffff;
        border-radius: 12px;
        padding: 2.5rem;
        margin-bottom: 2rem;
        box-shadow: 0 4px 16px rgba(0, 0, 0, 0.05);
        border: 1px solid var(--neutral-200);
    }

    .doc-section-title {
        color: var(--teorema-blue);
        font-size: 1.5rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .doc-section-title i {
        color: var(--teorema-blue);
        font-size: 1.2rem;
    }

    .doc-text {
        color: var(--neutral-700);
        line-height: 1.8;
        margin-bottom: 1.5rem;
        font-size: 1.05rem;
    }

    .doc-list {
        list-style-type: none;
        padding-left: 0;
        margin-bottom: 2rem;
    }

    .doc-list-item {
        padding: 1rem 1rem 1rem 3rem;
        margin-bottom: 1rem;
        background: var(--neutral-50);
        border-radius: 8px;
        border-left: 4px solid var(--teorema-blue);
        position: relative;
        transition: all 0.3s ease;
    }

    .doc-list-item:hover {
        background: var(--teorema-blue-light);
        transform: translateX(5px);
    }

    .doc-list-item i {
        position: absolute;
        left: 1rem;
        top: 1rem;
        color: var(--teorema-blue);
    }

    .doc-list-item strong {
        color: var(--neutral-800);
        display: block;
        margin-bottom: 0.5rem;
        font-size: 1.1rem;
    }

    .doc-list-item p {
        color: var(--neutral-600);
        margin-bottom: 0;
        line-height: 1.6;
    }

    .doc-highlight-box {
        background: linear-gradient(135deg, var(--teorema-blue-light) 0%, #e0f7ff 100%);
        border: 2px solid var(--teorema-blue);
        border-radius: 12px;
        padding: 2rem;
        margin: 2rem 0;
    }

    .doc-highlight-title {
        color: var(--teorema-blue);
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .doc-highlight-title i {
        font-size: 1.5rem;
    }

    .process-steps {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin: 2rem 0;
    }

    .process-step {
        background: #ffffff;
        border-radius: 10px;
        padding: 1.5rem;
        text-align: center;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border-top: 4px solid var(--teorema-blue);
    }

    .process-step:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }

    .step-number {
        width: 40px;
        height: 40px;
        background: var(--teorema-blue);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        margin: 0 auto 1rem;
        font-size: 1.2rem;
    }

    .step-title {
        color: var(--neutral-800);
        font-weight: 700;
        margin-bottom: 0.75rem;
        font-size: 1.1rem;
    }

    .step-description {
        color: var(--neutral-600);
        font-size: 0.95rem;
        line-height: 1.6;
    }

    .doc-footer {
        text-align: center;
        margin-top: 3rem;
        padding-top: 2rem;
        border-top: 1px solid var(--neutral-200);
    }

    .doc-footer-text {
        color: var(--neutral-600);
        font-size: 1.1rem;
        font-style: italic;
        max-width: 800px;
        margin: 0 auto;
        line-height: 1.8;
    }

    @media (max-width: 768px) {
        .doc-title {
            font-size: 2rem;
        }
        
        .doc-subtitle {
            font-size: 1.1rem;
        }
        
        .doc-section {
            padding: 1.5rem;
        }
        
        .doc-section-title {
            font-size: 1.3rem;
        }
        
        .process-steps {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 576px) {
        .doc-content {
            padding: 1rem;
        }
        
        .doc-title {
            font-size: 1.75rem;
        }
    }

    .process-steps {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin: 2rem 0;
    }

    .process-step {
        background: #ffffff;
        border-radius: 10px;
        padding: 1.5rem;
        text-align: center;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border-top: 4px solid var(--teorema-blue);
    }

    .process-step:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }

    .step-icon {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, var(--teorema-blue) 0%, var(--teorema-blue-light) 100%);
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        font-size: 1.5rem;
        box-shadow: 0 4px 10px rgba(0, 123, 255, 0.2);
    }

    .step-icon i {
        font-size: 1.5rem;
    }

    .step-title {
        color: var(--neutral-800);
        font-weight: 700;
        margin-bottom: 0.75rem;
        font-size: 1.1rem;
    }

    .step-description {
        color: var(--neutral-600);
        font-size: 0.95rem;
        line-height: 1.6;
    }
</style>
@endsection