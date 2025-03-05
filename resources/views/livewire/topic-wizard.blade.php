<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header text-white" style="background: linear-gradient(135deg, #007bff, #0056b3);">
            <h4 class="mb-0 text-center">📜 Multi-Step Topic Form</h4>
        </div>
        <div class="card-body p-4">

            {{-- Step 1: Topic Details --}}
            @if($step === 1)
            <div>
                <h5 class="mb-3 text-primary">📝 Step 1: Enter Topic Details</h5>

                <div class="mb-3">
                    <label class="form-label">Topic Name</label>
                    <input type="text" wire:model="topic_name" class="form-control rounded" placeholder="Enter topic name">
                    @error('topic_name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Alternative Name</label>
                    <input type="text" wire:model="topic_alternative_name" class="form-control rounded" placeholder="Alternative name">
                    @error('topic_alternative_name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea wire:model="topic_description" class="form-control rounded" rows="3" placeholder="Brief description"></textarea>
                    @error('topic_description') <span class="text-danger">{{ $message }}</span> @enderror
                </div>

                <button wire:click="nextStep" class="btn btn-primary mt-3 px-4">Next ➡️</button>
            </div>
            @endif

            {{-- Step 2: Select Ayah --}}
            @if($step === 2)
            <div>
                <h5 class="mb-3 text-success">📖 Step 2: Select Ayah</h5>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label class="form-label">Select Surah</label>
                        <select wire:model="selectedSurah" class="form-control rounded">
                            <option value="">-- Select Surah --</option>
                            @foreach($surahs as $surah)
                            <option value="{{ $surah->id }}">{{ $surah->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-8">
                        <label class="form-label">Select Ayah</label>
                        <select wire:model="selectedAyah" class="form-control rounded">
                            <option value="">-- Select Ayah --</option>
                            @foreach($ayahsList as $ayah)
                            <option value="{{ $ayah['id'] }}">{{ $ayah['text'] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


                <div class="mb-3">
                    <label class="form-label">Ayah Description</label>
                    <textarea wire:model="ayahDescription" class="form-control rounded" rows="3" placeholder="Enter description"></textarea>
                </div>

                <button wire:click="addAyah" class="btn btn-success px-4">➕ Add Ayah</button>

                <ul class="list-group mt-3">
                    @foreach($ayahs as $index => $ayah)
                    <li class="list-group-item d-flex justify-content-between align-items-center shadow-sm">
                        <span>
                            📖 Surah: {{ $ayah['surah_id'] }} | Ayah:
                            {{ collect($ayahsList)->firstWhere('id', $ayah['ayah_id'])['text'] ?? 'N/A' }}
                            <br> 📝 {{ $ayah['description'] }}
                        </span>
                        <button wire:click="removeAyah({{ $index }})" class="btn btn-outline-danger btn-sm">🗑️ Remove</button>
                    </li>
                    @endforeach
                </ul>

                <div class="mt-3 d-flex justify-content-between">
                    <button wire:click="prevStep" class="btn btn-secondary px-4">⬅️ Previous</button>
                    <button wire:click="nextStep" class="btn btn-primary px-4">Next ➡️</button>
                </div>
            </div>
            @endif

            {{-- Step 3: Enter Hadith --}}
            @if($step === 3)
            <div>
                <h5 class="mb-3 text-warning">📜 Step 3: Enter Hadith</h5>

                <div class="mb-3">
                    <label class="form-label">Hadith (Arabic)</label>
                    <textarea wire:model="hadithTextArabic" class="form-control rounded" rows="3" placeholder="Enter Arabic Hadith"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Hadith (Urdu)</label>
                    <textarea wire:model="hadithTextUrdu" class="form-control rounded" rows="3" placeholder="Enter Urdu Hadith"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Hadith (English)</label>
                    <textarea wire:model="hadithTextEnglish" class="form-control rounded" rows="3" placeholder="Enter English Hadith"></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Hadith Description</label>
                    <textarea wire:model="hadithDescription" class="form-control rounded" rows="3" placeholder="Brief description"></textarea>
                </div>

                <button wire:click="addHadith" class="btn btn-success px-4">➕ Add Hadith</button>

                <ul class="list-group mt-3">
                    @foreach($hadiths as $index => $hadith)
                    <li class="list-group-item d-flex justify-content-between align-items-center shadow-sm">
                        <div>
                            <span class="d-block fw-bold">📜 Arabic: {{ $hadith['text_arabic'] }}</span>
                            <span class="d-block">🕌 Urdu: {{ $hadith['text_urdu'] }}</span>
                            <span class="d-block">🌍 English: {{ $hadith['text_english'] }}</span>
                            <span class="d-block text-muted">📝 {{ $hadith['description'] }}</span>
                        </div>
                        <button wire:click="removeHadith({{ $index }})" class="btn btn-outline-danger btn-sm">🗑️ Remove</button>
                    </li>
                    @endforeach
                </ul>


                <div class="mt-3 d-flex justify-content-between">
                    <button wire:click="prevStep" class="btn btn-secondary px-4">⬅️ Previous</button>
                    <button wire:click="saveTopic" class="btn btn-success px-4">💾 Save Topic</button>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>