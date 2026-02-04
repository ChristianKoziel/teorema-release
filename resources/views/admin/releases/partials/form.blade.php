@csrf

<div class="row">
    <!-- Coluna 1 -->
    <div class="col-md-6">
        <!-- Número do Chamado -->
        <div class="mb-3">
            <label for="numero_chamado" class="form-label">
                <strong>Número do Chamado *</strong>
            </label>
            <input type="text" 
                   name="numero_chamado" 
                   id="numero_chamado"
                   value="{{ old('numero_chamado', $release->numero_chamado ?? '') }}"
                   class="form-control"
                   required>
            @error('numero_chamado')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <!-- Agente -->
        <div class="mb-3">
            <label for="agente" class="form-label">
                <strong>Agente Responsável *</strong>
            </label>
            <input type="text" 
                   name="agente" 
                   id="agente"
                   value="{{ old('agente', $release->agente ?? '') }}"
                   class="form-control"
                   required>
            @error('agente')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <!-- Release Código -->
        <div class="mb-3">
            <label for="release_codigo" class="form-label">
                <strong>Código da Release *</strong>
            </label>
            <input type="text" 
                   name="release_codigo" 
                   id="release_codigo"
                   value="{{ old('release_codigo', $release->release_codigo ?? '') }}"
                   class="form-control"
                   placeholder="Ex: RW-2024-001"
                   required>
            @error('release_codigo')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <!-- Data de Liberação -->
        <!-- Substitua o campo data_liberacao por: -->
        <div class="mb-3">
            <label for="data_liberacao" class="form-label">
                <strong>Data de Liberação *</strong>
            </label>
            <input type="date" 
                name="data_liberacao" 
                id="data_liberacao"
                value="{{ 
                    old('data_liberacao', 
                        isset($release) && $release->data_liberacao 
                            ? (is_string($release->data_liberacao) 
                                ? $release->data_liberacao 
                                : $release->data_liberacao->format('Y-m-d'))
                            : date('Y-m-d')
                    )
                }}"
                class="form-control"
                required>
            @error('data_liberacao')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tipo de Chamada -->
        <div class="mb-3">
            <label for="tipo_chamada" class="form-label">
                <strong>Tipo de Chamada *</strong>
            </label>
            <select name="tipo_chamada" 
                    id="tipo_chamada"
                    class="form-select"
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
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <!-- Status -->
        @if(isset($release) && auth()->user()->isAdmin())
            <div class="mb-3">
                <label for="status" class="form-label">
                    <strong>Status *</strong>
                </label>
                <select name="status" 
                        id="status"
                        class="form-select"
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
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
        @else
            <input type="hidden" name="status" value="{{ old('status', $release->status ?? 'rascunho') }}">
        @endif
    </div>

    <!-- Coluna 2 -->
    <div class="col-md-6">
        <!-- Ano, Mês, Semana -->
        <div class="row mb-3">
            <div class="col-md-4">
                <label for="ano" class="form-label">
                    <strong>Ano *</strong>
                </label>
                <input type="number" 
                       name="ano" 
                       id="ano"
                       value="{{ old('ano', $release->ano ?? date('Y')) }}"
                       min="2023"
                       max="2030"
                       class="form-control"
                       required>
                @error('ano')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="mes" class="form-label">
                    <strong>Mês *</strong>
                </label>
                <select name="mes" 
                        id="mes"
                        class="form-select"
                        required>
                    <option value="">Selecione...</option>
                    @for($i = 1; $i <= 12; $i++)
                        <option value="{{ $i }}" {{ old('mes', $release->mes ?? date('m')) == $i ? 'selected' : '' }}>
                            {{ $i }} - {{ \Carbon\Carbon::create()->month($i)->locale('pt_BR')->monthName }}
                        </option>
                    @endfor
                </select>
                @error('mes')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-4">
                <label for="semana" class="form-label">
                    <strong>Semana *</strong>
                </label>
                <select name="semana" 
                        id="semana"
                        class="form-select"
                        required>
                    <option value="">Selecione...</option>
                    @for($i = 1; $i <= 53; $i++)
                        <option value="{{ $i }}" {{ old('semana', $release->semana ?? date('W')) == $i ? 'selected' : '' }}>
                            Semana {{ $i }}
                        </option>
                    @endfor
                </select>
                @error('semana')
                    <div class="text-danger small">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <!-- Imagem -->
        <div class="mb-3">
            <label for="imagem" class="form-label">
                <strong>Imagem (Opcional)</strong>
            </label>
            <input type="file" 
                   name="imagem" 
                   id="imagem"
                   accept="image/*"
                   class="form-control">
            @error('imagem')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <!-- Link do Manual -->
        <div class="mb-3">
            <label for="link_manual" class="form-label">
                <strong>Link do Manual (Opcional)</strong>
            </label>
            <input type="url" 
                   name="link_manual" 
                   id="link_manual"
                   value="{{ old('link_manual', $release->link_manual ?? '') }}"
                   placeholder="https://..."
                   class="form-control">
            @error('link_manual')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<!-- Descrição -->
<div class="mb-3">
    <label for="descricao" class="form-label">
        <strong>Descrição *</strong>
    </label>
    <textarea name="descricao" 
              id="descricao"
              rows="3"
              class="form-control"
              placeholder="Descreva o problema ou melhoria..."
              required>{{ old('descricao', $release->descricao ?? '') }}</textarea>
    @error('descricao')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

<!-- Descrição da Correção/Melhoria -->
<div class="mb-4">
    <label for="descricao_correcao" class="form-label">
        <strong>Descrição da Correção/Melhoria *</strong>
    </label>
    <textarea name="descricao_correcao" 
              id="descricao_correcao"
              rows="4"
              class="form-control"
              placeholder="Descreva como foi implementada a correção ou melhoria..."
              required>{{ old('descricao_correcao', $release->descricao_correcao ?? '') }}</textarea>
    @error('descricao_correcao')
        <div class="text-danger small">{{ $message }}</div>
    @enderror
</div>

<!-- Botões -->
<div class="d-flex justify-content-between border-top pt-4">
    <a href="{{ isset($release) ? route('admin.releases.show', $release) : route('admin.releases.index') }}" 
       class="btn btn-secondary">
        <i class="fas fa-times me-1"></i> Cancelar
    </a>
    
    <button type="submit" class="btn btn-primary">
        <i class="fas fa-save me-1"></i> 
        {{ isset($release) ? 'Atualizar Release' : 'Criar Release' }}
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
        document.getElementById('mes').value = date.getMonth() + 1;
        document.getElementById('semana').value = weekNumber;
    });
</script>