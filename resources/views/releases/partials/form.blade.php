@csrf

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Coluna 1 -->
    <div class="space-y-6">
        <!-- Número do Chamado -->
        <div>
            <label for="numero_chamado" class="block text-sm font-medium text-gray-700">
                Número do Chamado *
            </label>
            <input type="text" 
                   name="numero_chamado" 
                   id="numero_chamado"
                   value="{{ old('numero_chamado', $release->numero_chamado ?? '') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                   required>
            @error('numero_chamado')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Agente -->
        <div>
            <label for="agente" class="block text-sm font-medium text-gray-700">
                Agente Responsável *
            </label>
            <input type="text" 
                   name="agente" 
                   id="agente"
                   value="{{ old('agente', $release->agente ?? '') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                   required>
            @error('agente')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Release Código -->
        <div>
            <label for="release_codigo" class="block text-sm font-medium text-gray-700">
                Código da Release *
            </label>
            <input type="text" 
                   name="release_codigo" 
                   id="release_codigo"
                   value="{{ old('release_codigo', $release->release_codigo ?? '') }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                   placeholder="Ex: RW-2024-001"
                   required>
            @error('release_codigo')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Data de Liberação -->
        <div>
            <label for="data_liberacao" class="block text-sm font-medium text-gray-700">
                Data de Liberação *
            </label>
            <input type="date" 
                   name="data_liberacao" 
                   id="data_liberacao"
                   value="{{ old('data_liberacao', $release->data_liberacao ?? date('Y-m-d')) }}"
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                   required>
            @error('data_liberacao')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Tipo de Chamada -->
        <div>
            <label for="tipo_chamada" class="block text-sm font-medium text-gray-700">
                Tipo de Chamada *
            </label>
            <select name="tipo_chamada" 
                    id="tipo_chamada"
                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                    required>
                <option value="">Selecione...</option>
                <option value="Correção" {{ old('tipo_chamada', $release->tipo_chamada ?? '') == 'Correção' ? 'selected' : '' }}>
                    🔧 Correção
                </option>
                <option value="Melhoria" {{ old('tipo_chamada', $release->tipo_chamada ?? '') == 'Melhoria' ? 'selected' : '' }}>
                    🚀 Melhoria
                </option>
            </select>
            @error('tipo_chamada')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Status -->
        @if(isset($release) && auth()->user()->isAdmin())
            <div>
                <label for="status" class="block text-sm font-medium text-gray-700">
                    Status *
                </label>
                <select name="status" 
                        id="status"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                        required>
                    <option value="rascunho" {{ old('status', $release->status ?? '') == 'rascunho' ? 'selected' : '' }}>
                        📝 Rascunho
                    </option>
                    <option value="em_analise" {{ old('status', $release->status ?? '') == 'em_analise' ? 'selected' : '' }}>
                    🔍 Em Análise
                    </option>
                    <option value="aprovado" {{ old('status', $release->status ?? '') == 'aprovado' ? 'selected' : '' }}>
                        ✅ Aprovado
                    </option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        @else
            <input type="hidden" name="status" value="{{ old('status', $release->status ?? 'rascunho') }}">
        @endif
    </div>

    <!-- Coluna 2 -->
    <div class="space-y-6">
        <!-- Ano, Mês, Semana -->
        <div class="grid grid-cols-3 gap-4">
            <div>
                <label for="ano" class="block text-sm font-medium text-gray-700">
                    Ano *
                </label>
                <input type="number" 
                       name="ano" 
                       id="ano"
                       value="{{ old('ano', $release->ano ?? date('Y')) }}"
                       min="2023"
                       max="2030"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                       required>
                @error('ano')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="mes" class="block text-sm font-medium text-gray-700">
                    Mês *
                </label>
                <input type="number" 
                       name="mes" 
                       id="mes"
                       value="{{ old('mes', $release->mes ?? date('m')) }}"
                       min="1"
                       max="12"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                       required>
                @error('mes')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="semana" class="block text-sm font-medium text-gray-700">
                    Semana *
                </label>
                <input type="number" 
                       name="semana" 
                       id="semana"
                       value="{{ old('semana', $release->semana ?? date('W')) }}"
                       min="1"
                       max="53"
                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                       required>
                @error('semana')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Imagem -->
        <div>
            <label for="imagem" class="block text-sm font-medium text-gray-700">
                Imagem (Opcional)
            </label>
            <input type="file" 
                   name="imagem" 
                   id="imagem"
                   accept="image/*"
                   class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
            @error('imagem')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
            
            @if(isset($release) && $release->imagem)
                <div class="mt-2">
                    <p class="text-sm text-gray-500">Imagem atual:</p>
                    <img src="{{ asset('storage/' . $release->imagem) }}" 
                         alt="Imagem atual" 
                         class="mt-1 h-20 w-auto rounded border">
                    <label class="mt-1 flex items-center text-sm text-gray-500">
                        <input type="checkbox" name="remove_imagem" value="1" class="mr-2">
                        Remover imagem
                    </label>
                </div>
            @endif
        </div>

        <!-- Link do Manual -->
        <div>
            <label for="link_manual" class="block text-sm font-medium text-gray-700">
                Link do Manual (Opcional)
            </label>
            <input type="url" 
                   name="link_manual" 
                   id="link_manual"
                   value="{{ old('link_manual', $release->link_manual ?? '') }}"
                   placeholder="https://..."
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
            @error('link_manual')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>

<!-- Descrição -->
<div class="mt-6">
    <label for="descricao" class="block text-sm font-medium text-gray-700">
        Descrição *
    </label>
    <textarea name="descricao" 
              id="descricao"
              rows="3"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
              placeholder="Descreva o problema ou melhoria..."
              required>{{ old('descricao', $release->descricao ?? '') }}</textarea>
    @error('descricao')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<!-- Descrição da Correção/Melhoria -->
<div class="mt-6">
    <label for="descricao_correcao" class="block text-sm font-medium text-gray-700">
        Descrição da Correção/Melhoria *
    </label>
    <textarea name="descricao_correcao" 
              id="descricao_correcao"
              rows="4"
              class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
              placeholder="Descreva como foi implementada a correção ou melhoria..."
              required>{{ old('descricao_correcao', $release->descricao_correcao ?? '') }}</textarea>
    @error('descricao_correcao')
        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
    @enderror
</div>

<!-- Botões -->
<div class="mt-8 pt-6 border-t border-gray-200 flex justify-between">
    <a href="{{ isset($release) ? route('admin.releases.show', $release) : route('admin.releases.index') }}" 
       class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
        ← Cancelar
    </a>
    
    <button type="submit" 
            class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 focus:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
        💾 {{ isset($release) ? 'Atualizar Release' : 'Criar Release' }}
    </button>
</div>

<script>
    // Script para calcular semana automaticamente da data
    document.getElementById('data_liberacao').addEventListener('change', function() {
        const date = new Date(this.value);
        const year = date.getFullYear();
        
        // Calcular semana ISO
        const firstDayOfYear = new Date(year, 0, 1);
        const pastDaysOfYear = (date - firstDayOfYear) / 86400000;
        const weekNumber = Math.ceil((pastDaysOfYear + firstDayOfYear.getDay() + 1) / 7);
        
        // Atualizar campos
        document.getElementById('ano').value = year;
        document.getElementById('mes').value = date.getMonth() + 1; // Mês começa em 0
        document.getElementById('semana').value = weekNumber;
    });
    
    // Script para visualização de imagem
    document.getElementById('imagem').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Criar preview se não existir
                let preview = document.getElementById('image-preview');
                if (!preview) {
                    preview = document.createElement('div');
                    preview.id = 'image-preview';
                    preview.className = 'mt-2';
                    e.target.parentNode.appendChild(preview);
                }
                preview.innerHTML = `
                    <p class="text-sm text-gray-500">Preview:</p>
                    <img src="${e.target.result}" class="mt-1 h-20 w-auto rounded border">
                `;
            }
            reader.readAsDataURL(file);
        }
    });
</script>