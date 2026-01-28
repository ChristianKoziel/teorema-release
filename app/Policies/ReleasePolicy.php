<?php

namespace App\Policies;

use App\Models\Release;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ReleasePolicy
{
    public function viewAny(User $user): bool
    {
        return true;
    }
    
    public function view(User $user, Release $release): bool
    {
        // Analista só vê as próprias releases ou releases aprovadas
        if ($user->isAnalista()) {
            return $release->user_id === $user->id || $release->status === 'aprovado';
        }
        
        return true; // Admin vê tudo
    }
    
    public function create(User $user): bool
    {
        return in_array($user->role, ['admin', 'analista']);
    }
    
    public function update(User $user, Release $release): bool
    {
        if ($user->isAdmin()) {
            return true;
        }
        
        // Analista só edita as próprias releases que não estejam aprovadas
        return $user->isAnalista() 
            && $release->user_id === $user->id 
            && $release->status !== 'aprovado';
    }
    
    public function delete(User $user, Release $release): bool
    {
        if ($user->isAdmin()) {
            return true;
        }
        
        // Analista só exclui as próprias releases que não estejam aprovadas
        return $user->isAnalista() 
            && $release->user_id === $user->id 
            && $release->status !== 'aprovado';
    }
    
    public function alterarStatus(User $user, Release $release): bool
    {
        // Apenas admin pode alterar status
        return $user->isAdmin();
    }
}