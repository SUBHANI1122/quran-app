<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Surah;
use App\Models\Ayah;
use App\Models\HadithReference;
use App\Models\Topic;
use App\Models\TopicAyah;
use App\Models\TopicHadith;

class TopicWizard extends Component
{
    public $step = 1;
    public $topic_id;

    public $topic_name, $topic_alternative_name, $topic_description;
    public $selectedSurah, $selectedAyah, $ayahDescription;
    public $ayahsList = [];
    public $ayahs = [];

    public $hadithTextArabic, $hadithTextUrdu, $hadithTextEnglish, $hadithDescription;
    public $hadiths = [];
    public $status = 'draft';
    public $references = [];

    public function mount($topic_id = null)
    {
        if ($topic_id) {
            $this->topic_id = $topic_id;
            $this->loadTopicData();
        }
    }

    public function loadTopicData()
    {
        $topic = Topic::with(['ayahs', 'hadiths'])->findOrFail($this->topic_id);

        $this->topic_name = $topic->name;
        $this->topic_alternative_name = $topic->alternative_name;
        $this->topic_description = $topic->description;
        $this->status = $topic->status;

        // Load related Ayahs
        $this->ayahs = $topic->ayahs->map(function ($ayah) {
            return [
                'surah_id' => $ayah->surah_id,
                'ayah_id' => $ayah->ayah_id,
                'description' => $ayah->description,
            ];
        })->toArray();

        $this->hadiths = $topic->hadiths->map(function ($hadith) {
            return [
                'text_arabic' => $hadith->hadith_text_arabic,
                'text_urdu' => $hadith->hadith_text_urdu,
                'text_english' => $hadith->hadith_text_english,
                'description' => $hadith->description,
                'references' => $hadith->references->map(function ($reference) {
                    return [
                        'book_name' => $reference->book_name,
                        'reference_number' => $reference->reference_number,
                    ];
                })->toArray(), // Load references as an array
            ];
        })->toArray();
    }

    public function updatedSelectedSurah()
    {
        if ($this->selectedSurah) {
            $this->ayahsList = Ayah::where('surah_number', $this->selectedSurah)->get()->toArray();
        } else {
            $this->ayahsList = [];
        }
        $this->selectedAyah = null;
    }

    public function nextStep()
    {
        if ($this->step === 1) {
            $this->validate([
                'topic_name' => 'required|string|max:255',
                'topic_alternative_name' => 'nullable|string|max:255',
                'topic_description' => 'required|string',
            ]);
        }

        if ($this->step < 4) {
            $this->step++;
        }
    }

    public function prevStep()
    {
        if ($this->step > 1) {
            $this->step--;
        }
    }

    public function addAyah()
    {
        if ($this->selectedSurah && $this->selectedAyah && $this->ayahDescription) {
            $this->ayahs[] = [
                'surah_id' => $this->selectedSurah,
                'ayah_id' => $this->selectedAyah,
                'description' => $this->ayahDescription
            ];

            $this->selectedAyah = null;
            $this->ayahDescription = null;
        }
    }

    public function removeAyah($index)
    {
        unset($this->ayahs[$index]);
        $this->ayahs = array_values($this->ayahs);
    }

    public function addHadith()
    {
        if ($this->hadithTextArabic && $this->hadithTextUrdu && $this->hadithTextEnglish && $this->hadithDescription) {
            $this->hadiths[] = [
                'text_arabic' => $this->hadithTextArabic,
                'text_urdu' => $this->hadithTextUrdu,
                'text_english' => $this->hadithTextEnglish,
                'description' => $this->hadithDescription,
                'references' => $this->references
            ];

            $this->hadithTextArabic = null;
            $this->hadithTextUrdu = null;
            $this->hadithTextEnglish = null;
            $this->hadithDescription = null;
            $this->references = [];
        }
    }


    public function removeHadith($index)
    {
        unset($this->hadiths[$index]);
        $this->hadiths = array_values($this->hadiths);
    }

    public function addReference()
    {
        $this->references[] = ['book_name' => '', 'reference_number' => ''];
    }

    public function removeReference($hadithIndex, $referenceIndex)
    {
        if (isset($this->hadiths[$hadithIndex]['references'][$referenceIndex])) {
            unset($this->hadiths[$hadithIndex]['references'][$referenceIndex]);
            $this->hadiths[$hadithIndex]['references'] = array_values($this->hadiths[$hadithIndex]['references']);
        }
    }

    public function saveTopic()
    {
        $this->validate([
            'topic_name' => 'required|string|max:255',
            'topic_alternative_name' => 'nullable|string|max:255',
            'topic_description' => 'required|string',
            'status' => 'required|in:draft,published',
        ]);

        if ($this->topic_id) {
            $topic = Topic::findOrFail($this->topic_id);
            $topic->update([
                'name' => $this->topic_name,
                'alternative_name' => $this->topic_alternative_name,
                'description' => $this->topic_description,
                'status' => $this->status,
            ]);

            TopicAyah::where('topic_id', $this->topic_id)->delete();
            TopicHadith::where('topic_id', $this->topic_id)->delete();
            HadithReference::whereIn('hadith_id', TopicHadith::where('topic_id', $this->topic_id)->pluck('id'))->delete();
        } else {
            // Create new topic
            $topic = Topic::create([
                'name' => $this->topic_name,
                'alternative_name' => $this->topic_alternative_name,
                'description' => $this->topic_description,
                'status' => $this->status,
            ]);
        }

        // Save Ayahs
        foreach ($this->ayahs as $ayah) {
            TopicAyah::create([
                'topic_id' => $topic->id,
                'surah_id' => $ayah['surah_id'],
                'ayah_id' => $ayah['ayah_id'],
                'description' => $ayah['description'],
            ]);
        }

        // Save Hadiths and References
        foreach ($this->hadiths as $hadith) {
            $newHadith = TopicHadith::create([
                'topic_id' => $topic->id,
                'hadith_text_arabic' => $hadith['text_arabic'],
                'hadith_text_urdu' => $hadith['text_urdu'],
                'hadith_text_english' => $hadith['text_english'],
                'description' => $hadith['description'],
            ]);

            // Save Hadith References
            if (isset($hadith['references']) && is_array($hadith['references'])) {
                foreach ($hadith['references'] as $reference) {
                    HadithReference::create([
                        'topic_hadiths_id' => $newHadith->id,
                        'book_name' => $reference['book_name'],
                        'reference_number' => $reference['reference_number'],
                    ]);
                }
            }
        }

        session()->flash('message', 'Topic saved successfully!');
        return redirect()->route('topics.index');
    }



    public function render()
    {
        return view('livewire.topic-wizard', [
            'surahs' => Surah::all(),
        ]);
    }
}
