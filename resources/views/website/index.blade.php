@extends('website.layouts.main')
@section('content')

<link href="https://fonts.googleapis.com/css2?family=Noto+Naskh+Arabic&display=swap" rel="stylesheet">

<style>
    body {
        direction: rtl;
        font-family: 'Noto Naskh Arabic', serif;
        background: linear-gradient(to bottom, #f9fdfb, #e7f3ed);
        margin: 0;
        padding: 0;
    }

    .quran-layout {
        display: flex;
        gap: 2rem;
        max-width: 1300px;
        margin: auto;
        padding: 2rem;
    }

    .quran-content {
        flex: 1.5;
        background: #ffffff;
        padding: 2rem;
        border-radius: 16px;
        box-shadow: 0 0 30px rgba(0, 0, 0, 0.05);
        min-height: 80vh;
    }

    .sidebar {
        flex: 0.5;
        background: #ffffff;
        padding: 2rem;
        border-radius: 16px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.03);
    }

    .sidebar h4 {
        margin-bottom: 0.5rem;
        color: #0f5132;
    }

    .sidebar select {
        width: 100%;
        padding: 10px 12px;
        margin-bottom: 1.5rem;
        border: 1px solid #ccc;
        border-radius: 8px;
        font-size: 16px;
    }

    .ayah {
        background: #f7fffc;
        border-right: 6px solid #198754;
        padding: 1.5rem;
        margin-bottom: 1.2rem;
        border-radius: 12px;
        font-size: 24px;
        line-height: 2;
        position: relative;
        transition: all 0.3s ease-in-out;
    }

    .ayah:hover {
        background-color: #e9fbee;
    }

    .ayah-number {
        position: absolute;
        top: 10px;
        left: 12px;
        background: #198754;
        color: white;
        font-size: 14px;
        padding: 4px 10px;
        border-radius: 50px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .text-muted {
        color: #888;
        font-size: 18px;
        text-align: center;
        margin-top: 2rem;
    }

    .spinner {
        text-align: center;
        margin: 2rem 0;
    }

    .spinner div {
        display: inline-block;
        width: 1rem;
        height: 1rem;
        margin: 0 4px;
        background-color: #198754;
        border-radius: 100%;
        animation: bouncedelay 1.4s infinite ease-in-out both;
    }

    .spinner .bounce1 {
        animation-delay: -0.32s;
    }

    .spinner .bounce2 {
        animation-delay: -0.16s;
    }

    @keyframes bouncedelay {

        0%,
        80%,
        100% {
            transform: scale(0);
        }

        40% {
            transform: scale(1);
        }
    }
</style>

<div class="quran-layout">

    <div class="sidebar">
        <h4>اختر الجزء (Juzz)</h4>
        <select>
            @foreach ($juzz as $j)
            <option value="{{ $j->number }}">الجزء {{ $j->number }} - {{ $j->name }}</option>
            @endforeach
        </select>

        <h4>اختر السورة (Surah)</h4>
        <select id="surah-selector">
            @foreach ($surahs as $index => $surah)
            <option value="{{ $surah->id }}" {{ $index === 0 ? 'selected' : '' }}>
                {{ $surah->id }}. {{ $surah->name }} ({{ $surah->english_name }})
            </option>
            @endforeach
        </select>
    </div>

    <div class="quran-content">
        <div id="ayahs-container">
            <p class="text-muted">تحميل الآيات...</p>
        </div>
    </div>

</div>

<script>
    function loadAyahs(surahNumber) {
        const container = document.getElementById('ayahs-container');
        container.innerHTML = `
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    `;

        fetch(`/get-ayahs/${surahNumber}`)
            .then(res => res.json())
            .then(data => {
                container.innerHTML = '';

                if (data.length === 0) {
                    container.innerHTML = '<p class="text-muted">لا توجد آيات لهذه السورة.</p>';
                    return;
                }

                data.forEach(ayah => {
                    const ayahEl = document.createElement('div');
                    ayahEl.className = 'ayah';
                    ayahEl.innerHTML = `
                    <span class="ayah-number">${ayah.ayah_number}</span>
                    <div class="arabic-text">${ayah.text}</div>
                    <div class="translation urdu">${ayah.urdu_text}</div>
                    <div class="translation english">${ayah.english_text}</div>
                `;
                    container.appendChild(ayahEl);
                });
            })
            .catch(err => {
                container.innerHTML = '<p class="text-muted">حدث خطأ أثناء تحميل الآيات.</p>';
                console.error(err);
            });
    }


    document.getElementById('surah-selector').addEventListener('change', function() {
        loadAyahs(this.value);
    });

    document.addEventListener('DOMContentLoaded', function() {
        const defaultSurah = document.getElementById('surah-selector').value;
        loadAyahs(defaultSurah);
    });
</script>

@endsection