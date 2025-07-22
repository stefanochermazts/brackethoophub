@extends('layouts.admin')

@section('title', __('admin.tournament_wizard') . ' - ' . __('admin.step') . ' 2')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Progress Bar -->
    <div class="mb-8">
        <div class="flex items-center justify-between text-sm font-medium text-gray-600 mb-2">
            <span>{{ __('admin.step') }} 2 {{ __('admin.of') }} 5: {{ __('admin.categories_setup') }}</span>
            <span>40%</span>
        </div>
        <div class="w-full bg-gray-200 rounded-full h-2">
            <div class="bg-orange-500 h-2 rounded-full transition-all duration-300" style="width: 40%"></div>
        </div>
    </div>

    <!-- Wizard Card -->
    <div class="stat-card p-8">
        <div class="text-center mb-8">
            <div class="w-16 h-16 bg-orange-500 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-primary mb-2">{{ __('admin.categories_setup') }}</h1>
            <p class="text-secondary">Definisci le categorie del torneo "{{ $wizardData['step1']['name'] ?? '' }}"</p>
        </div>

        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                <div class="flex">
                    <svg class="w-5 h-5 text-red-400 mt-0.5 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                    <div>
                        <h3 class="text-sm font-medium text-red-800">Errori di validazione:</h3>
                        <ul class="mt-1 text-sm text-red-700 list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endif

        <form action="{{ route('admin.tournaments.wizard.store.step2') }}" method="POST" id="categoriesForm">
            @csrf
            
            <!-- Categories Container -->
            <div id="categoriesContainer" class="space-y-6 mb-8">
                @php
                    $existingCategories = old('categories', $wizardData['step2']['categories'] ?? []);
                    if (empty($existingCategories)) {
                        $existingCategories = [[]]; // Almeno una categoria di default
                    }
                @endphp
                
                @foreach($existingCategories as $index => $category)
                    <div class="category-item border border-gray-200 rounded-lg p-6 relative" data-index="{{ $index }}">
                        <!-- Remove Button -->
                        @if($index > 0)
                            <button type="button" class="remove-category absolute top-4 right-4 p-2 text-red-400 hover:text-red-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        @endif

                        <div class="flex items-center mb-4">
                            <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center mr-3">
                                <span class="text-sm font-medium text-orange-600">{{ $index + 1 }}</span>
                            </div>
                            <h3 class="text-lg font-medium text-primary">{{ __('admin.category') }} {{ $index + 1 }}</h3>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Nome Categoria -->
                            <div class="md:col-span-1">
                                <label class="block text-sm font-medium text-primary mb-2">
                                    {{ __('admin.category_name') }} <span class="text-red-500">*</span>
                                </label>
                                <input type="text" 
                                       name="categories[{{ $index }}][name]" 
                                       value="{{ $category['name'] ?? '' }}"
                                       placeholder="Es. Under 18, Senior, Esordienti"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors"
                                       required>
                            </div>

                            <!-- Sesso Categoria -->
                            <div class="md:col-span-1">
                                <label class="block text-sm font-medium text-primary mb-2">
                                    {{ __('admin.category_gender') }} <span class="text-red-500">*</span>
                                </label>
                                <select name="categories[{{ $index }}][gender]"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors"
                                        required>
                                    <option value="">Seleziona...</option>
                                    <option value="male" {{ ($category['gender'] ?? '') == 'male' ? 'selected' : '' }}>
                                        {{ __('admin.male') }}
                                    </option>
                                    <option value="female" {{ ($category['gender'] ?? '') == 'female' ? 'selected' : '' }}>
                                        {{ __('admin.female') }}
                                    </option>
                                    <option value="mixed" {{ ($category['gender'] ?? '') == 'mixed' ? 'selected' : '' }}>
                                        {{ __('admin.mixed') }}
                                    </option>
                                </select>
                            </div>

                            <!-- Descrizione -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-primary mb-2">
                                    {{ __('admin.category_description') }} <span class="text-gray-400">({{ __('admin.optional') }})</span>
                                </label>
                                <textarea name="categories[{{ $index }}][description]" 
                                          rows="2"
                                          placeholder="Descrizione della categoria, regole specifiche..."
                                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors">{{ $category['description'] ?? '' }}</textarea>
                            </div>

                            <!-- Età Minima -->
                            <div>
                                <label class="block text-sm font-medium text-primary mb-2">
                                    {{ __('admin.min_age') }} <span class="text-gray-400">({{ __('admin.optional') }})</span>
                                </label>
                                <input type="number" 
                                       name="categories[{{ $index }}][min_age]" 
                                       value="{{ $category['min_age'] ?? '' }}"
                                       min="5" 
                                       max="100"
                                       placeholder="Es. 16"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors">
                            </div>

                            <!-- Età Massima -->
                            <div>
                                <label class="block text-sm font-medium text-primary mb-2">
                                    {{ __('admin.max_age') }} <span class="text-gray-400">({{ __('admin.optional') }})</span>
                                </label>
                                <input type="number" 
                                       name="categories[{{ $index }}][max_age]" 
                                       value="{{ $category['max_age'] ?? '' }}"
                                       min="5" 
                                       max="100"
                                       placeholder="Es. 18"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors">
                            </div>

                            <!-- Numero Minimo Squadre -->
                            <div>
                                <label class="block text-sm font-medium text-primary mb-2">
                                    {{ __('admin.min_teams') }} <span class="text-red-500">*</span>
                                </label>
                                <input type="number" 
                                       name="categories[{{ $index }}][min_teams]" 
                                       value="{{ $category['min_teams'] ?? '3' }}"
                                       min="3" 
                                       max="64"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors"
                                       required>
                            </div>

                            <!-- Numero Massimo Squadre -->
                            <div>
                                <label class="block text-sm font-medium text-primary mb-2">
                                    {{ __('admin.max_teams') }} <span class="text-gray-400">({{ __('admin.optional') }})</span>
                                </label>
                                <input type="number" 
                                       name="categories[{{ $index }}][max_teams]" 
                                       value="{{ $category['max_teams'] ?? '' }}"
                                       min="3" 
                                       max="64"
                                       placeholder="{{ __('admin.unlimited') }}"
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors">
                            </div>

                            <!-- Formula Categoria -->
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-primary mb-4">
                                    {{ __('admin.category_format') }} <span class="text-red-500">*</span>
                                </label>
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                    <!-- Round Robin -->
                                    <label class="relative cursor-pointer">
                                        <input type="radio" 
                                               name="categories[{{ $index }}][format]" 
                                               value="round_robin" 
                                               {{ ($category['format'] ?? '') == 'round_robin' ? 'checked' : '' }}
                                               class="sr-only peer" 
                                               required>
                                        <div class="p-3 border-2 border-gray-200 rounded-lg peer-checked:border-orange-500 peer-checked:bg-orange-50 transition-all">
                                            <div class="flex items-center">
                                                <div class="w-3 h-3 border-2 border-gray-300 rounded-full peer-checked:border-orange-500 peer-checked:bg-orange-500 mr-2"></div>
                                                <span class="text-sm font-medium">{{ __('admin.round_robin') }}</span>
                                            </div>
                                        </div>
                                    </label>

                                    <!-- Knockout -->
                                    <label class="relative cursor-pointer">
                                        <input type="radio" 
                                               name="categories[{{ $index }}][format]" 
                                               value="knockout" 
                                               {{ ($category['format'] ?? '') == 'knockout' ? 'checked' : '' }}
                                               class="sr-only peer">
                                        <div class="p-3 border-2 border-gray-200 rounded-lg peer-checked:border-orange-500 peer-checked:bg-orange-50 transition-all">
                                            <div class="flex items-center">
                                                <div class="w-3 h-3 border-2 border-gray-300 rounded-full peer-checked:border-orange-500 peer-checked:bg-orange-500 mr-2"></div>
                                                <span class="text-sm font-medium">{{ __('admin.knockout') }}</span>
                                            </div>
                                        </div>
                                    </label>

                                    <!-- Mixed -->
                                    <label class="relative cursor-pointer">
                                        <input type="radio" 
                                               name="categories[{{ $index }}][format]" 
                                               value="mixed" 
                                               {{ ($category['format'] ?? '') == 'mixed' ? 'checked' : '' }}
                                               class="sr-only peer">
                                        <div class="p-3 border-2 border-gray-200 rounded-lg peer-checked:border-orange-500 peer-checked:bg-orange-50 transition-all">
                                            <div class="flex items-center">
                                                <div class="w-3 h-3 border-2 border-gray-300 rounded-full peer-checked:border-orange-500 peer-checked:bg-orange-500 mr-2"></div>
                                                <span class="text-sm font-medium">{{ __('admin.mixed_format') }}</span>
                                            </div>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Add Category Button -->
            <div class="text-center mb-8">
                <button type="button" 
                        id="addCategory"
                        class="px-6 py-3 border-2 border-dashed border-orange-300 text-orange-600 hover:border-orange-500 hover:text-orange-700 rounded-lg transition-colors flex items-center mx-auto">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    {{ __('admin.add_category') }}
                </button>
            </div>

            <!-- Actions -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('admin.tournaments.wizard.step1') }}" 
                   class="px-6 py-3 text-gray-600 hover:text-gray-800 transition-colors flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    {{ __('admin.previous_step') }}
                </a>
                
                <button type="submit" 
                        class="px-8 py-3 bg-orange-500 hover:bg-orange-600 text-white font-medium rounded-lg transition-colors flex items-center">
                    {{ __('admin.next_step') }}
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>
        </form>
    </div>
</div>

<script>
let categoryIndex = {{ count($existingCategories) }};

// Template per nuova categoria
function getCategoryTemplate(index) {
    return `
        <div class="category-item border border-gray-200 rounded-lg p-6 relative" data-index="${index}">
            <button type="button" class="remove-category absolute top-4 right-4 p-2 text-red-400 hover:text-red-600 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>

            <div class="flex items-center mb-4">
                <div class="w-8 h-8 bg-orange-100 rounded-full flex items-center justify-center mr-3">
                    <span class="text-sm font-medium text-orange-600">${index + 1}</span>
                </div>
                <h3 class="text-lg font-medium text-primary">{{ __('admin.category') }} ${index + 1}</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-1">
                    <label class="block text-sm font-medium text-primary mb-2">
                        {{ __('admin.category_name') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="text" 
                           name="categories[${index}][name]" 
                           placeholder="Es. Under 18, Senior, Esordienti"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors"
                           required>
                </div>

                <div class="md:col-span-1">
                    <label class="block text-sm font-medium text-primary mb-2">
                        {{ __('admin.category_gender') }} <span class="text-red-500">*</span>
                    </label>
                    <select name="categories[${index}][gender]"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors"
                            required>
                        <option value="">Seleziona...</option>
                        <option value="male">{{ __('admin.male') }}</option>
                        <option value="female">{{ __('admin.female') }}</option>
                        <option value="mixed">{{ __('admin.mixed') }}</option>
                    </select>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-primary mb-2">
                        {{ __('admin.category_description') }} <span class="text-gray-400">({{ __('admin.optional') }})</span>
                    </label>
                    <textarea name="categories[${index}][description]" 
                              rows="2"
                              placeholder="Descrizione della categoria, regole specifiche..."
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-primary mb-2">
                        {{ __('admin.min_age') }} <span class="text-gray-400">({{ __('admin.optional') }})</span>
                    </label>
                    <input type="number" 
                           name="categories[${index}][min_age]" 
                           min="5" 
                           max="100"
                           placeholder="Es. 16"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors">
                </div>

                <div>
                    <label class="block text-sm font-medium text-primary mb-2">
                        {{ __('admin.max_age') }} <span class="text-gray-400">({{ __('admin.optional') }})</span>
                    </label>
                    <input type="number" 
                           name="categories[${index}][max_age]" 
                           min="5" 
                           max="100"
                           placeholder="Es. 18"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors">
                </div>

                <div>
                    <label class="block text-sm font-medium text-primary mb-2">
                        {{ __('admin.min_teams') }} <span class="text-red-500">*</span>
                    </label>
                    <input type="number" 
                           name="categories[${index}][min_teams]" 
                           value="3"
                           min="3" 
                           max="64"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors"
                           required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-primary mb-2">
                        {{ __('admin.max_teams') }} <span class="text-gray-400">({{ __('admin.optional') }})</span>
                    </label>
                    <input type="number" 
                           name="categories[${index}][max_teams]" 
                           min="3" 
                           max="64"
                           placeholder="{{ __('admin.unlimited') }}"
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-colors">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-primary mb-4">
                        {{ __('admin.category_format') }} <span class="text-red-500">*</span>
                    </label>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                        <label class="relative cursor-pointer">
                            <input type="radio" 
                                   name="categories[${index}][format]" 
                                   value="round_robin" 
                                   class="sr-only peer" 
                                   required>
                            <div class="p-3 border-2 border-gray-200 rounded-lg peer-checked:border-orange-500 peer-checked:bg-orange-50 transition-all">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 border-2 border-gray-300 rounded-full peer-checked:border-orange-500 peer-checked:bg-orange-500 mr-2"></div>
                                    <span class="text-sm font-medium">{{ __('admin.round_robin') }}</span>
                                </div>
                            </div>
                        </label>

                        <label class="relative cursor-pointer">
                            <input type="radio" 
                                   name="categories[${index}][format]" 
                                   value="knockout" 
                                   class="sr-only peer">
                            <div class="p-3 border-2 border-gray-200 rounded-lg peer-checked:border-orange-500 peer-checked:bg-orange-50 transition-all">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 border-2 border-gray-300 rounded-full peer-checked:border-orange-500 peer-checked:bg-orange-500 mr-2"></div>
                                    <span class="text-sm font-medium">{{ __('admin.knockout') }}</span>
                                </div>
                            </div>
                        </label>

                        <label class="relative cursor-pointer">
                            <input type="radio" 
                                   name="categories[${index}][format]" 
                                   value="mixed" 
                                   class="sr-only peer">
                            <div class="p-3 border-2 border-gray-200 rounded-lg peer-checked:border-orange-500 peer-checked:bg-orange-50 transition-all">
                                <div class="flex items-center">
                                    <div class="w-3 h-3 border-2 border-gray-300 rounded-full peer-checked:border-orange-500 peer-checked:bg-orange-500 mr-2"></div>
                                    <span class="text-sm font-medium">{{ __('admin.mixed_format') }}</span>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>
            </div>
        </div>
    `;
}

// Aggiungi categoria
document.getElementById('addCategory').addEventListener('click', function() {
    const container = document.getElementById('categoriesContainer');
    const newCategory = document.createElement('div');
    newCategory.innerHTML = getCategoryTemplate(categoryIndex);
    container.appendChild(newCategory.firstElementChild);
    categoryIndex++;
    updateCategoryNumbers();
});

// Rimuovi categoria
document.addEventListener('click', function(e) {
    if (e.target.closest('.remove-category')) {
        const categoryItem = e.target.closest('.category-item');
        if (document.querySelectorAll('.category-item').length > 1) {
            categoryItem.remove();
            updateCategoryNumbers();
        }
    }
});

// Aggiorna numerazione categorie
function updateCategoryNumbers() {
    const categories = document.querySelectorAll('.category-item');
    categories.forEach((category, index) => {
        category.dataset.index = index;
        const numberElement = category.querySelector('.bg-orange-100 span');
        const titleElement = category.querySelector('h3');
        if (numberElement) numberElement.textContent = index + 1;
        if (titleElement) titleElement.textContent = `{{ __('admin.category') }} ${index + 1}`;
        
        // Aggiorna i name degli input
        const inputs = category.querySelectorAll('input, select, textarea');
        inputs.forEach(input => {
            const name = input.getAttribute('name');
            if (name) {
                const newName = name.replace(/categories\[\d+\]/, `categories[${index}]`);
                input.setAttribute('name', newName);
            }
        });
    });
}

// Validazione età
document.addEventListener('input', function(e) {
    if (e.target.name && e.target.name.includes('[min_age]')) {
        const categoryIndex = e.target.name.match(/\[(\d+)\]/)[1];
        const maxAgeInput = document.querySelector(`input[name="categories[${categoryIndex}][max_age]"]`);
        if (maxAgeInput && e.target.value) {
            maxAgeInput.min = e.target.value;
        }
    }
});
</script>
@endsection 