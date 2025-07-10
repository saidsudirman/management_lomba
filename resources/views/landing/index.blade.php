@extends('layout.landing.app')
@section('content')
    @push('styles')
        <style>
            body {
                /* background-color: brown; */
            }
        </style>
    @endpush
    <div class="banner-carousel banner-carousel-1 mb-0">
        <div class="banner-carousel-item" style="background-image:url({{ asset('img/unsplash/impas1.jpg') }})">
            <div class="slider-content">
                <div class="container h-100">
                    <div class="row align-items-center h-100">
                        <div class="col-md-12 text-center">
                            <h2 class="slide-title" data-animation-in="slideInLeft">Selamat Datang Peserta</h2>
                            <h3 class="slide-sub-title" data-animation-in="slideInRight">IMPAS EDUCATION #13
                            </h3>
                            <p data-animation-in="slideInLeft" data-duration-in="1.2">
                                {{-- <a href="services.html" class="slider btn btn-primary">Our Services</a>
                                <a href="contact.html" class="slider btn btn-primary border">Contact Now</a> --}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="banner-carousel-item" style="background-image:url({{ asset('img/unsplash/impas2.jpg') }})">
            <div class="slider-content text-left">
                <div class="container h-100">
                    <div class="row align-items-center h-100">
                        <div class="col-md-12">
                            <h2 class="slide-title-box" data-animation-in="slideInDown">Kami Siap Mengajar Teman-Teman</h2>
                            <h3 class="slide-title" data-animation-in="fadeIn">Untuk Menambahkan Ilmu Di Dunia IT</h3>
                            <h3 class="slide-sub-title" data-animation-in="slideInLeft"># IMPAS DIPA </h3>
                            <p data-animation-in="slideInRight">
                                {{-- <a href="services.html" class="slider btn btn-primary border">Pelayanan Kami</a> --}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="banner-carousel-item" style="background-image:url({{ asset('img/unsplash/impas3.jpg') }})">
            <div class="slider-content text-right">
                <div class="container h-100">
                    <div class="row align-items-center h-100">
                        <div class="col-md-12">
                            <h2 class="slide-title" data-animation-in="slideInDown">Segera Mendaftar</h2>
                            <h3 class="slide-sub-title" data-animation-in="fadeIn">Tambah Ilmu Anda di Sini</h3>
                            <p class="slider-description lead" data-animation-in="slideInRight">
                                Kami akan mengajarkan Anda
                                dalam meraih kesuksesan melalui pendidikan dan teknologi yang berkelanjutan.
                            </p>
                            <div data-animation-in="slideInLeft">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    {{-- slider icon img --}}
    <section id="ts-service-area" class="ts-service-area pb-0">
        <div class="container">

            <div class="my-center-slider my-icon-slider">

                <div class=" ">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" style="width: 250px" class="img img-fluid text-center mx-auto"
                                src="{{ asset('img/logo1.png') }}" alt="logo berakhlak">
                        </div>
                    </div><!-- Service1 end -->
                </div><!-- Col 1 end -->
                <div class=" ">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" style="width: 250px" class="img img-fluid text-center mx-auto"
                                src="{{ asset('img/logo-kiri.png') }}"
                                alt="logo bangga melayani">
                        </div>
                    </div><!-- Service1 end -->
                </div><!-- Col 1 end -->
                <div class=" ">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" style="width: 250px" class="img img-fluid text-center mx-auto"
                                src="{{ asset('img/logo2.jpeg') }}"
                                alt="logo sehat tanpa korupsi">
                        </div>
                    </div><!-- Service1 end -->
                </div><!-- Col 1 end -->
                <div class=" ">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" style="width: 250px" class="img img-fluid text-center mx-auto"
                                src="{{ asset('img/logo3.png') }}"
                                alt="logo kami siap zi wbk">
                        </div>
                    </div><!-- Service1 end -->
                </div><!-- Col 1 end -->



            </div><!-- Main row end -->


        </div>
        <!--/ Container end -->
    </section><!-- Service end -->




    <section id="ts-features" class="ts-features">
        <div class="container">
            <div class="row">


                <div class="col-lg-12">
                    <div class="ts-intro">
                        <h2 class="into-title">Tentang Kami</h2>
                        <h3 class="into-sub-title">IMPAS DIPA</h3>
                        <p class="my-sub-content">
                            Ikatan Mahasiswa Papua Universitas Dipa Makassar (IMPAS DIPA) didirikan sebagai wadah kebersamaan, pengembangan diri, dan perjuangan mahasiswa Papua yang menempuh pendidikan di Universitas Dipa Makassar. Organisasi ini lahir dari semangat solidaritas dan kebutuhan akan ruang untuk saling mendukung di tengah perantauan, khususnya dalam menghadapi tantangan akademik, sosial, dan budaya.

IMPAS DIPA berdiri dengan tujuan utama mempererat tali persaudaraan antar mahasiswa Papua, menjaga identitas budaya, serta mendorong partisipasi aktif dalam kegiatan intelektual dan kemasyarakatan di lingkungan kampus maupun di luar. Sejak awal berdirinya, IMPAS DIPA telah menjadi rumah bagi para mahasiswa untuk bertumbuh secara akademis dan sosial, serta menjadi jembatan antara mahasiswa Papua dan berbagai elemen di Universitas Dipa Makassar.


                        </p>
                    </div><!-- Intro box end -->



                </div><!-- Col end -->

                <!-- <div class="col-lg-6 mt-4 mt-lg-4 justify-content-center">
                        <h3 class="into-sub-title"> </h3>
                        <div class="box-video"> -->

                <!--<iframe width="420" height="315" title="Program Pengembangan keprofesian Guru. Pendidikan Jasmani, olahraga dan kesehatan" src="https://www.youtube.com/embed/gJ3g7xX9O-s"-->
                <!--    allowfullscreen>-->
                <!--</iframe>-->
                <!-- <div class="video-placeholder" data-src="https://www.youtube.com"
                                onclick="loadVideo(this)">
                                <div class="video-title">Rencana Pelaksanaan Pembelajaran</div>
                            </div> -->
                <!--<div class="video-title">Balai Besar Guru Penggerak</div>-->
            </div>
            <!--/ Accordion end -->
        </div><!-- Col end -->




        </div><!-- Row end -->
        </div><!-- Container end -->
    </section><!-- Feature are end -->

    <section id="ts-service-area" class="ts-service-area pb-0">
        <div class="container">

            <div class="row my-icon2-slider">

                <div class="col-lg col-md ">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" class="w-100"
                                src="{{ asset('landing/images/icon-slider/slider2/icon-web-jurnal.png') }}"
                                alt="icon web jurnal">
                        </div>
                        <div class="text-center">
                            <div class="ts-service-info">
                                <h3 class="service-box-title"><a href="service-single.html">Lihat Materi</a></h3>

                            </div>
                        </div>
                    </div><!-- Service1 end -->
                </div><!-- Col 1 end -->

                <div class="col-lg col-md ">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" class="w-100"
                                src="{{ asset('landing/images/icon-slider/slider2/icon-web-pengaduan.png') }}"
                                alt="icon web pengaduan">
                        </div>
                        <div class="text-center">
                            <div class="ts-service-info">
                                <h3 class="service-box-title"><a href="#">Daftar Kegiatan</a></h3>

                            </div>
                        </div>
                    </div><!-- Service1 end -->
                </div><!-- Col 1 end -->

                <div class="col-lg col-md ">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" class="w-100"
                                src="{{ asset('landing/images/icon-slider/slider2/icon-web-ppid.png') }}"
                                alt="icon web ppid">
                        </div>
                        <div class="text-center">
                            <div class="ts-service-info">
                                <h3 class="service-box-title"><a
                                        href="https://sites.google.com/instruktur.belajar.id/ult-RPPHsulsel">Print Hasil Daftar</a></h3>

                            </div>
                        </div>
                    </div><!-- Service1 end -->
                </div><!-- Col 1 end -->

                <div class="col-lg col-md ">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" class="w-100"
                                src="{{ asset('landing/images/icon-slider/slider2/icon-web-sim-penggiat.png') }}"
                                alt="icon web sim penggiat">
                        </div>
                        <div class="text-center">
                            <div class="ts-service-info">
                                <h3 class="service-box-title"><a href="#">Pergi Ke Stand</a></h3>

                            </div>
                        </div>
                    </div><!-- Service1 end -->
                </div><!-- Col 1 end -->

                <div class="col-lg col-md ">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" class="w-100"
                                src="{{ asset('landing/images/icon-slider/slider2/icon-web-virtual-tour.png') }}"
                                alt="icon web virtual tour">
                        </div>
                        <div class="text-center">
                            <div class="ts-service-info">
                                <h3 class="service-box-title"><a href="#">Pembayaran</a></h3>

                            </div>
                        </div>
                    </div><!-- Service1 end -->
                </div><!-- Col 1 end -->

                <div class="col-lg col-md ">
                    <div class="ts-service-box">
                        <div class="ts-service-image-wrapper">
                            <img loading="lazy" class="w-100"
                                src="{{ asset('landing/images/icon-slider/slider2/icon-web-visualisasi-data.png') }}"
                                alt="icon web visualisasi data">
                        </div>
                        <div class="text-center">
                            <div class="ts-service-info">
                                <h3 class="service-box-title"><a href="#">Ikut Materi</a></h3>

                            </div>
                        </div>
                    </div><!-- Service1 end -->
                </div><!-- Col 1 end -->


            </div><!-- Main row end -->


        </div>
        <!--/ Container end -->
    </section><!-- Service end -->
        <div class="container mt-4">
            <div class="row justify-content-center">
                @foreach ($lombas as $lomba)
                    <div class="col-md-4 mb-4 d-flex">
                        <div class="card shadow-sm w-100 text-center" style="border: none; border-radius: 10px; overflow: hidden;">
                            @if ($lomba->foto)
                                <img src="{{ asset($lomba->foto) }}" alt="{{ $lomba->nama }}" style="width: 100%; height: 200px; object-fit: cover;">
                            @endif

                            <div class="card-body">
                                <h5 class="card-title">{{ $lomba->nama }}</h5>
                                <h7 class="card-title">{{ $lomba->harga }}</h7>

                                <div class="d-flex justify-content-center text-muted mb-2" style="gap: 10px;">
                                    <small><i class="far fa-calendar-alt"></i> {{ \Carbon\Carbon::parse($lomba->tanggal_mulai)->format('d M') }}</small>
                                    <small><i class="fas fa-arrow-right"></i></small>
                                    <small><i class="far fa-calendar-check"></i> {{ \Carbon\Carbon::parse($lomba->tanggal_selesai)->format('d M Y') }}</small>
                                </div>

                                <p class="card-text" style="font-size: 0.9rem;">
                                    {{ Str::limit($lomba->deskripsi, 100) }}
                                </p>
                            </div>
                            <div class="card-footer bg-transparent border-top-0">
                                <a href="{{ route('materi.detail', $lomba->id) }}" class="btn btn-link px-0">Baca Selengkapnya <i class="fas fa-arrow-right ms-2"></i></a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
            </div><!-- Main row end -->


        </div>
        <!--/ Container end -->
    </section><!-- Service end -->




    <!--/ News end -->
    @push('scripts')
        <script>
            function loadVideo(element) {
                var iframe = document.createElement('iframe');
                iframe.setAttribute('width', '420');
                iframe.setAttribute('height', '315');
                iframe.setAttribute('title',
                    'Program Pengembangan keprofesian Guru. Pendidikan Jasmani, olahraga dan kesehatan');
                iframe.setAttribute('src', element.getAttribute('data-src'));
                iframe.setAttribute('allowfullscreen', '');
                element.parentNode.replaceChild(iframe, element);
            }

            // Optionally, you can use Intersection Observer to load video only when in viewport
            document.addEventListener('DOMContentLoaded', function () {
                var lazyVideos = [].slice.call(document.querySelectorAll('.video-placeholder'));

                if ('IntersectionObserver' in window) {
                    var lazyVideoObserver = new IntersectionObserver(function (entries, observer) {
                        entries.forEach(function (video) {
                            if (video.isIntersecting) {
                                loadVideo(video.target);
                                lazyVideoObserver.unobserve(video.target);
                            }
                        });
                    });

                    lazyVideos.forEach(function (video) {
                                lazyVideoObserv er.observe(video);
                    });
                } else {
                    // Fallback for older browsers
                    lazyVideos.forEach(function (video) {
                        loadVideo(video);
                    });
                }
            });
        </script>
    @endpush
@endsection