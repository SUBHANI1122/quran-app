@extends('layouts/layoutMaster')

@section('title', 'Topics, Ayahs & Hadiths Wizard')

@section('vendor-style')
@vite([
  'resources/assets/vendor/libs/bs-stepper/bs-stepper.scss',
  'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.scss',
  'resources/assets/vendor/libs/select2/select2.scss',
  'resources/assets/vendor/libs/@form-validation/form-validation.scss'
])
@endsection

@section('vendor-script')
@vite([
  'resources/assets/vendor/libs/bs-stepper/bs-stepper.js',
  'resources/assets/vendor/libs/bootstrap-select/bootstrap-select.js',
  'resources/assets/vendor/libs/select2/select2.js',
  'resources/assets/vendor/libs/@form-validation/popular.js',
  'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
  'resources/assets/vendor/libs/@form-validation/auto-focus.js'
])
@endsection

@section('page-script')
@vite([
  'resources/assets/js/form-wizard-numbered.js',
  'resources/js/topics-form-wizard.js'
])

<script>
    document.addEventListener("DOMContentLoaded", function () {
        window.stepper = new Stepper(document.querySelector(".bs-stepper"));
    });

    document.addEventListener("livewire:load", function () {
        window.stepper = new Stepper(document.querySelector(".bs-stepper"));
    });

    document.addEventListener("livewire:update", function () {
        setTimeout(() => {
            window.stepper = new Stepper(document.querySelector(".bs-stepper"));
        }, 500); // Add slight delay to ensure DOM is updated
    });
</script>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
        <h5>Topics, Ayahs & Hadiths Wizard</h5>
    </div>

    <div class="col-12">
        <livewire:topic-wizard />
    </div>
</div>
@endsection
