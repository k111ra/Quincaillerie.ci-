@csrf

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@php
    $section = $section ?? null;
    $type = old('type', $section->type ?? 'category');
    $sourceId = old('source_id', $section->source_id ?? null);
@endphp

<div class="mb-3">
    <label class="form-label" for="title">Titre de la section</label>
    <input type="text" id="title" name="title" class="form-control"
        value="{{ old('title', $section->title ?? '') }}" placeholder="Ex. Nos produits les plus vendus" required>
    <small class="text-muted">Ce titre s'affiche au-dessus de la liste de produits sur l'accueil.</small>
</div>

<div class="mb-3">
    <label class="form-label" for="type">Type de source</label>
    <select id="type" name="type" class="form-select" onchange="toggleSource()">
        <option value="category" {{ $type === 'category' ? 'selected' : '' }}>Catégorie</option>
        <option value="tag" {{ $type === 'tag' ? 'selected' : '' }}>Tag</option>
    </select>
</div>

<div class="mb-3" id="source-category">
    <label class="form-label" for="source_category">Catégorie</label>
    <select id="source_category" class="form-select" data-source>
        <option value="">— Choisir une catégorie —</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}"
                {{ $type === 'category' && (int) $sourceId === $category->id ? 'selected' : '' }}>
                {{ $category->name }}{{ $category->parent_id ? '' : ' (principale)' }}
            </option>
        @endforeach
    </select>
    <small class="text-muted">Les produits de cette catégorie <em>et de ses sous-catégories</em> seront affichés.</small>
</div>

<div class="mb-3 d-none" id="source-tag">
    <label class="form-label" for="source_tag">Tag</label>
    <select id="source_tag" class="form-select" data-source>
        <option value="">— Choisir un tag —</option>
        @foreach ($tags as $tag)
            <option value="{{ $tag->id }}"
                {{ $type === 'tag' && (int) $sourceId === $tag->id ? 'selected' : '' }}>
                {{ $tag->name }}
            </option>
        @endforeach
    </select>
    <small class="text-muted">Tous les produits portant ce tag seront affichés.</small>
</div>

{{-- Valeur réellement envoyée : alimentée par le select actif via JS --}}
<input type="hidden" name="source_id" id="source_id" value="{{ $sourceId }}">

<div class="row">
    <div class="col-md-4 mb-3">
        <label class="form-label" for="display">Style d'affichage</label>
        <select id="display" name="display" class="form-select">
            @php $display = old('display', $section->display ?? 'grid'); @endphp
            <option value="grid" {{ $display === 'grid' ? 'selected' : '' }}>Grille</option>
            <option value="slider" {{ $display === 'slider' ? 'selected' : '' }}>Carrousel (slider)</option>
            <option value="tabs" {{ $display === 'tabs' ? 'selected' : '' }}>Onglets par sous-catégorie</option>
        </select>
        <small class="text-muted">« Onglets » ne fonctionne qu'avec une catégorie ayant des sous-catégories.</small>
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label" for="limit">Nombre de produits</label>
        <input type="number" id="limit" name="limit" class="form-control" min="1" max="50"
            value="{{ old('limit', $section->limit ?? 8) }}" required>
    </div>

    <div class="col-md-4 mb-3">
        <label class="form-label" for="position">Ordre d'affichage</label>
        <input type="number" id="position" name="position" class="form-control"
            value="{{ old('position', $section->position ?? 0) }}">
        <small class="text-muted">Plus petit = plus haut sur la page.</small>
    </div>
</div>

<div class="mb-3">
    <div class="form-check form-switch">
        <input type="hidden" name="is_active" value="0">
        <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
            {{ old('is_active', $section->is_active ?? true) ? 'checked' : '' }}>
        <label class="form-check-label" for="is_active">Section active (visible sur l'accueil)</label>
    </div>
</div>

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary">Enregistrer</button>
    <a href="{{ route('admin.home-sections.index') }}" class="btn btn-outline-secondary">Annuler</a>
</div>

<script>
        function toggleSource() {
            var type = document.getElementById('type').value;
            var catBlock = document.getElementById('source-category');
            var tagBlock = document.getElementById('source-tag');
            var hidden = document.getElementById('source_id');

            if (type === 'tag') {
                catBlock.classList.add('d-none');
                tagBlock.classList.remove('d-none');
                hidden.value = document.getElementById('source_tag').value;
            } else {
                tagBlock.classList.add('d-none');
                catBlock.classList.remove('d-none');
                hidden.value = document.getElementById('source_category').value;
            }
        }

        // Garde le champ caché synchronisé avec le select actif.
        document.querySelectorAll('[data-source]').forEach(function (el) {
            el.addEventListener('change', function () {
                document.getElementById('source_id').value = this.value;
            });
        });

        document.addEventListener('DOMContentLoaded', toggleSource);
    </script>
