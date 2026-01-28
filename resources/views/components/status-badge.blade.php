@props(['status'])

@php
    $colors = [
        'rascunho' => 'bg-gray-100 text-gray-800',
        'em_analise' => 'bg-yellow-100 text-yellow-800',
        'aprovado' => 'bg-green-100 text-green-800',
    ];
    
    $icons = [
        'rascunho' => '📝',
        'em_analise' => '🔍',
        'aprovado' => '✅',
    ];
    
    $labels = [
        'rascunho' => 'Rascunho',
        'em_analise' => 'Em Análise',
        'aprovado' => 'Aprovado',
    ];
@endphp

<span {{ $attributes->merge(['class' => "inline-flex items-center px-3 py-1 rounded-full text-sm font-semibold {$colors[$status]}"]) }}>
    {{ $icons[$status] }} {{ $labels[$status] }}
</span>