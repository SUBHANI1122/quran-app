@extends('layouts/layoutMaster')

@section('title', 'Topics - Quran App')

@section('vendor-style')
@vite([
'resources/assets/vendor/libs/datatables-bs5/datatables.bootstrap5.scss',
'resources/assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.scss',
'resources/assets/vendor/libs/flatpickr/flatpickr.scss',
'resources/assets/vendor/libs/sweetalert2/sweetalert2.scss'
])
@endsection

@section('vendor-script')
@vite([
'resources/assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js',
'resources/assets/vendor/libs/moment/moment.js',
'resources/assets/vendor/libs/flatpickr/flatpickr.js',
'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'
])
@endsection

@section('page-script')
@vite([
'resources/assets/js/tables-datatables-advanced.js',
'resources/js/topics.js'
])
@endsection
@php
use Illuminate\Support\Str;
@endphp

@section('content')

<!-- Topics List -->
<div class="card">
    <div class="d-flex justify-content-between align-items-center m-5">
        <h5 class="mb-0">Topics</h5>
        <a href="{{ route('topic.create') }}" class="btn btn-primary add-new">Add Topic</a>
    </div>
    <div class="card-datatable table-responsive">
        <table class="table datatables-topics">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Topic Name</th>
                    <th>Description</th>
                    <th>Ayah Count</th>
                    <th>Hadith Count</th>
                    <th>Favourite</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topics as $index => $topic)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $topic->name }}</td>
                    <td>{{ Str::limit($topic->description, 50) }}</td>
                    <td>{{ $topic->ayahs_count }}</td>
                    <td>{{ $topic->hadiths_count }}</td>
                    <td>
                        <button onclick="setTopicOfTheDay({{ $topic->id }}, this)" class="border-0 bg-transparent p-0">
                            @if($topic->topic_of_the_day)
                            <i class="fas fa-star text-warning"></i>
                            @else
                            <i class="far fa-star text-secondary"></i>
                            @endif
                        </button>
                    </td>
                    <td>
                        @if($topic->status === 'published')
                        <span class="badge bg-success">Published</span>
                        @else
                        <span class="badge bg-warning">Draft</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('topic.edit', $topic->id) }}" class="btn btn-sm btn-warning">
                            <i class="fas fa-edit"></i>
                        </a>
                        <button class="btn btn-sm btn-danger delete-topic" data-id="{{ $topic->id }}">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('.datatables-topics').DataTable({
                responsive: true,
                autoWidth: false,
                pageLength: 10
            });

            document.querySelectorAll('.delete-topic').forEach(button => {
                button.addEventListener('click', function() {
                    let topicId = this.getAttribute('data-id');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch(`/topics/${topicId}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                    }
                                }).then(response => response.json())
                                .then(data => {
                                    if (data.success) {
                                        Swal.fire('Deleted!', 'The topic has been deleted.', 'success');
                                        location.reload();
                                    }
                                });
                        }
                    });
                });
            });
        });

        function setTopicOfTheDay(topicId, element) {
            fetch(`/topics/set-topic-of-the-day/${topicId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        document.querySelectorAll('.fas.fa-star').forEach(star => {
                            star.classList.replace('fas', 'far');
                            star.classList.replace('text-warning', 'text-secondary');
                        });

                        // Update the clicked element's icon
                        let icon = element.querySelector('i');
                        if (icon.classList.contains('far')) {
                            icon.classList.replace('far', 'fas');
                            icon.classList.replace('text-secondary', 'text-warning');
                        }
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>

    @endsection