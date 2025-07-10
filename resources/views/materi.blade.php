@extends('layout.landing.app')
@section('content')
    @push('styles')
        <style>
            body {
                /* background-color: brown; */
            }
        </style>
    @endpush
<div class="container-xxl py-5">
    <div class="container">
        <!-- Header -->
        <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <p class="d-inline-block border rounded-pill py-1 px-4">Detail Materi</p>
            <h1 class="mb-3">{{ $Lomba->nama }}</h1>
        </div>  

        <!-- Lomba Konten -->
        <div class="row justify-content-center">
            <div class="col-lg-10 wow fadeInUp" data-wow-delay="0.2s">
                <div class="card article-card border-0 shadow-sm">
                    <img src="{{ asset($Lomba->foto ?? 'img/unsplash/default.jpg') }}"
                         class="card-img-top"
                         alt="{{ $Lomba->nama }}"
                         style="height: 300px; object-fit: cover;">

                    <div class="card-body mt-4">
                        <div class="text-muted mb-3">
                            <i class="fas fa-user-md me-1"></i> {{ $Lomba->penulis }}
                        </div>

                        <div class="Lomba-konten">
                            {!! $Lomba->deskripsi !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lomba Terbaru -->
        @if($LombaTerbaru->count())
        <div class="row mt-5">
            <div class="col-12 text-center mb-4">
                <h4>Lomba Lainnya</h4>
            </div>

            @foreach($LombaTerbaru as $a)
            <div class="col-md-4 wow fadeInUp" data-wow-delay="0.{{ $loop->iteration }}s">
                <div class="card h-100 article-card border-0 shadow-sm">
                    <img src="{{ asset($a->foto ?? 'img/unsplash/default.jpg') }}"
                         class="card-img-top"
                         alt="{{ $a->nama }}"
                         style="height: 200px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $a->nama }}</h5>
                        <small class="text-muted"><i class="far fa-calendar-alt me-1"></i>{{ $a->created_at->format('d M Y') }}</small>
                        <p class="card-text mt-2">{{ Str::limit(strip_tags($a->deskripsi), 100) }}</p>
                        <a href="{{ route('materi.detail', $a->id) }}" class="btn btn-sm btn-outline-primary rounded-pill mt-2">Baca Selengkapnya</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>
<!-- Lomba Detail End -->

@endsection

@section('styles')
<style>
    .article-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-radius: 12px;
        overflow: hidden;
    }
    .article-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.15);
    }
    .Lomba-konten {
        line-height: 1.8;
        font-size: 1rem;
    }
</style>

@endsection