<?php

namespace App\Providers;

use App\Models\Release;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }
    
    public function boot(): void
    {
        View::composer('*', function ($view) {
            // Menu lateral hierárquico: Ano → Mês → Semana
            $menuAnos = Release::aprovadas()
                ->select('ano')
                ->distinct()
                ->orderBy('ano', 'desc')
                ->pluck('ano');
            
            $menuEstruturado = [];
            
            foreach ($menuAnos as $ano) {
                $meses = Release::aprovadas()
                    ->where('ano', $ano)
                    ->select('mes')
                    ->distinct()
                    ->orderBy('mes')
                    ->pluck('mes');
                
                $menuEstruturado[$ano] = [];
                
                foreach ($meses as $mes) {
                    $semanas = Release::aprovadas()
                        ->where('ano', $ano)
                        ->where('mes', $mes)
                        ->select('semana')
                        ->distinct()
                        ->orderBy('semana')
                        ->pluck('semana');
                    
                    $menuEstruturado[$ano][$mes] = $semanas;
                }
            }
            
            $view->with('menuLateral', $menuEstruturado);
        });
    }
}