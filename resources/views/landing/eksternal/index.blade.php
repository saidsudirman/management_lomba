@extends('layouts.landing.app')
@section('content')
    <!-- Banner Area -->
    <div id="banner-area" class="banner-area"
        style="background-image:url({{ asset('landing/images/banner/bannerEksternal.png') }})">
        <div class="banner-text">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="banner-heading">
                            <h1 class="banner-title">Eksternal BBGP </h1>
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb justify-content-center">
                                    <li class="breadcrumb-item"><a href="/">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Eksternal</li>
                                </ol>
                            </nav>
                        </div>
                    </div><!-- Col end -->
                </div><!-- Row end -->
            </div><!-- Container end -->
        </div><!-- Banner text end -->
    </div><!-- Banner area end -->

    <div class="container my-4">
        <div class="row">
            <div class="col">
                <h4>Registrasi Data Eksternal</h4>
                <h5>Silahkan pilih kategori pendidikan untuk mengisi form.</h5>
                <div class="d-flex mt-3 mb-5">
                    <div class="">
                        <a href="{{ route('user.form_guru', 'Tenaga Pendidik') }}" class="btn btn-primary btn-lg p-2">
                            <i class="fas fa-chalkboard-teacher mr-1"></i>Tenaga Pendidik
                        </a>
                    </div>
                    <div class="mx-3">
                        <a href="{{ route('user.form_guru', 'Tenaga Kependidikan') }}" class="btn btn-info btn-lg p-2">
                            <i class="fas fa-school mr-1"></i>Tenaga Kependidikan
                        </a>
                    </div>
                    <div class="">
                        <a href="{{ route('user.form_guru', 'Stakeholder') }}" class="btn btn-warning btn-lg p-2">
                            <i class="fas fa-layer-group mr-1"></i>Stakeholder
                        </a>
                    </div>
                    <div class="">
                        <button id="resetBtn" class="btn btn-success btn-lg  mx-4">
                            <i class="fas fa-redo-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-md-8">
                <div class="form-group">
                    <h5>Pencarian Data Eksternal BBGP </h5>
                    <input name="nama" id="namaFilter" type="text" value="" placeholder="Masukkan nama anda"
                        class="form-control">
                </div>
            </div>
        </div>
        <h5>Filter Data Eksternal</h5>

        <div class="row">
            <div class="col-md-3 mb-4">
                <label>Jabatan Ketenagaan</label>
                <select required name="jenisJabatan" class="form-control " id="jabEksternal">
                    <option value="">-- Filter By Jabatan Ketenagaan --</option>
                    <option value="Tenaga Pendidik">Tenaga Pendidik</option>
                    <option value="Tenaga Kependidikan">Tenaga Kependidikan</option>
                    <option value="Stakeholder">Stakeholder</option>
                </select>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>Jabatan</label>
                    <select name="jabJenis" class="form-control" id="jabJenis">
                        <option value="">-- Pilih Jenis Jabatan --</option>
                    </select>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <label>Kategori Jabatan </label>
                <select name="jabKategori" class="form-control" id="jabKategori">
                    <option value="">-- Pilih Kategori --</option>
                </select>
            </div>

            <div class="col-md-3" id="colJabatan">
                <div class="form-group">
                    <label>Latar Jabatan</label>
                    <select name="jabLatar" class="form-control" id="jabLatar">
                        <option value="">-- Pilih Latar Jabatan --</option>

                    </select>
                </div>
            </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label>Jenis Tugas</label>
                    <select name="jabTugas" class="form-control" id="jabTugas">
                        <option value="">-- Pilih Tugas Jabatan --</option>
                    </select>
                </div>
            </div>

        </div>

        <div class="data-not-found alert alert-info">Silahkan cari data eksternal anda, jika tidak ada.
            Silahkan hubungi admin / registrasi pada button diatas</div>
        <div class="table-responsive">
            <table class="table table-striped" id="table-guru" style="width:100%">
                <thead>
                    <tr>
                        <th style="width: 1%" class="text-center">#</th>
                        <th style="width: 20%">NPSN Sekolah</th>
                        <th style="width: 30%">Nama Lengkap</th>
                        {{-- <th>NIK</th> --}}
                        <th>Status Kepegawaian</th>
                        <th>Ketenagaan</th>
                        <th>Kategori Jabatan</th>
                        <th>Jenis Jabatan</th>
                        <th>Tugas Jabatan</th>
                        <th>Latar Jabatan</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datas as $i => $data)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $data->npsn_sekolah }} <br> {{ $data->sekolah->nama_sekolah ?? '' }}</td>
                            <td>{{ $data->nama_lengkap }} </td>
                            {{-- <td>{{ $data->no_ktp }}</td> --}}
                            <td>{{ $data->status_kepegawaian }}</td>
                            <td>{{ $data->eksternal_jabatan }}</td>
                            <td>{{ $data->kategori_jabatan }}</td>
                            <td>{{ $data->jenis_jabatan }}</td>
                            <td>{{ $data->tugas_jabatan }}</td>
                            <td>{{ $data->latar_jabatan ?? 'tidak ada' }}</td>
                            <td>
                                <button class="btn btn-info" onclick="showDetail({{ $data->id }})">
                                    Detail
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal HTML -->
    <div style="z-index: 999999;" class="modal fade" id="detailModal" tabindex="-1" role="dialog"
        aria-labelledby="detailModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailModalLabel">Detail Data Eksternal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="detailContent">
                    <!-- Detail content will be loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function showDetail(pegawaiId) {
                $.ajax({
                    url: '{{ route('user.pegawai.detail.eksternal') }}', // Sesuaikan dengan route yang benar
                    type: 'GET',
                    data: {
                        id: pegawaiId
                    },
                    success: function(response) {
                        console.log(response)
                        const dateLahir = new Date(response.data.tgl_lahir);
                        const dayLahir = String(dateLahir.getDate()).padStart(2, '0');
                        const monthLahir = String(dateLahir.getMonth() + 1).padStart(2,
                            '0'); // getMonth() returns 0-11
                        const yearLahir = dateLahir.getFullYear();
                        tgl_Lahir = `${dayLahir}-${monthLahir}-${yearLahir}`;

                        $('#detailContent').html(`
                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Nama Lengkap:</strong> ${response.data.nama_lengkap ?? ''}</p>
                                    
                                    <p><strong>Asal Kabupaten:</strong> ${response.data.kabupaten ?? ''}</p>
                                    
                                    </div>
                                    <div class="col-md-6">    
                                        <p><strong>Jenis Kelamin:</strong> ${response.data.gender ?? ''}</p>
                                 
                                    <p><strong>Status Kepegawaian:</strong> ${response.data.status_kepegawaian ?? ''}</p>
                                </div>
                            </div>
                        `);
                        $('#detailModal').modal('show');
                    },
                    error: function(error) {
                        console.error(error);
                        alert('Error fetching detail.');
                    }
                });
            }

            $(document).ready(function() {
                // Initialize DataTable
                var tableGuru = $('#table-guru').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/2.1.0/i18n/id.json',
                    },
                    bAutoWidth: false,
                });

                const resetBtn = document.querySelector('#resetBtn');
                const namaInput = document.querySelector('#namaFilter');
                const jabEksternal = document.querySelector('#jabEksternal');
                const jabJenis = document.querySelector('#jabJenis');
                const jabKategori = document.querySelector('#jabKategori');
                const jabTugas = document.querySelector('#jabTugas');
                const noDataMessage = document.querySelector('.data-not-found');

                // Function to apply search filters
                function applySearch() {
                    const searchText = namaInput.value.trim();
                    const jabEksternalValue = jabEksternal.value;
                    const jabJenisValue = jabJenis.value;
                    const jabKategoriValue = jabKategori.value;
                    const jabTugasValue = jabTugas.value;

                    console.log('Search Text:', searchText);
                    console.log('Select Value 13:', jabEksternalValue);
                    console.log('Select Value 14:', jabTugasValue);

                    tableGuru.column(2).search(searchText).draw();
                    tableGuru.column(4).search(jabEksternalValue).draw();
                    tableGuru.column(6).search(jabJenisValue).draw();
                    tableGuru.column(5).search(jabKategoriValue).draw();
                    tableGuru.column(7).search(jabTugasValue).draw();

                    const info = tableGuru.page.info();
                    if (info.recordsDisplay === 0) {
                        noDataMessage.style.display = 'block';
                    } else {
                        noDataMessage.style.display = 'none';
                    }
                }

                namaInput.addEventListener('keyup', applySearch);
                jabEksternal.addEventListener('change', applySearch);
                jabJenis.addEventListener('change', applySearch);
                jabKategori.addEventListener('change', applySearch);
                jabTugas.addEventListener('change', applySearch);
                resetBtn.addEventListener('click', function() {
                    location.reload();
                })
            });
        </script>

        <script>
            $(document).ready(function() {
                $('#colJabatan').hide();

                function fillterJabatan() {
                    var jabEksternal = $('#jabEksternal').val();
                    var jabJenis = $('#jabJenis');
                    var jabTugas = $('#jabTugas');
                    var colJabatan = $('#colJabatan');
                    var jabKategori = $('#jabKategori');
                    var option = '';
                    const dataJab = {!! json_encode($status) !!};

                    jabJenis.empty();

                    jabJenis.append($('<option>', {
                        value: '',
                        text: '-- Pilih Jabatan --',
                        disabled: true,
                        selected: true
                    }));

                    jabTugas.empty();
                    jabTugas.append($('<option>', {
                        value: '',
                        text: '-- Pilih Tugas --',
                        disabled: true,
                        selected: true
                    }));

                    jabKategori.empty();
                    jabKategori.append($('<option>', {
                        value: '',
                        text: '-- Pilih Kategori --',
                        disabled: true,
                        selected: true
                    }));
                    colJabatan.hide();


                    if (jabEksternal == 'Tenaga Pendidik') {

                        colJabatan.hide();

                        let dataJabValue = dataJab['s_jabPendidik'].map(item => {
                            option = $("<option>")
                                .text(item.name)
                                .attr('value', item.name)
                                .removeAttr('disabled');
                            jabJenis.append(option);
                        });
                    }
                    if (jabEksternal == 'Tenaga Kependidikan') {
                        colJabatan.show();

                        let dataJabValue = dataJab['s_jabKependidikan'].map(item => {
                            option = $("<option>")
                                .text(item.name)
                                .attr('value', item.name)
                                .removeAttr('disabled');
                            jabJenis.append(option);
                        });
                    }
                    if (jabEksternal == 'Stakeholder') {
                        colJabatan.hide();

                        let dataJabValue = dataJab['s_jabStakeholder'].map(item => {
                            option = $("<option>")
                                .text(item.name)
                                .attr('value', item.name)
                                .removeAttr('disabled');
                            jabJenis.append(option);
                        });
                    }
                }

                function fillterKategori() {
                    var jabKategori = $('#jabKategori').val();
                    var jabTugas = $('#jabTugas');
                    var option = '';
                    const dataJab = {!! json_encode($status) !!};

                    jabTugas.empty();

                    jabTugas.append($('<option>', {
                        value: '',
                        text: '-- Pilih Tugas --',
                        disabled: true,
                        selected: true
                    }));

                    if (jabKategori == 'GP (Guru Penggerak)') {
                        let dataJabValue = dataJab['s_jabTugas'].map(item => {
                            option = $("<option>")
                                .text(item)
                                .attr('value', item)
                                .removeAttr('disabled');
                            jabTugas.append(option);
                        });
                    }
                    if (jabKategori == 'NoN GP (Guru Penggerak)') {
                        let dataJabValue = dataJab['s_jabTugas'].map((item, i) => {
                            option = $("<option>")
                                .text(item)
                                .attr('value', item)
                                .removeAttr('disabled');
                            jabTugas.append(option);
                        });
                    }
                }

                $('#jabEksternal').on('change', function() {
                    fillterJabatan();
                    fillterKategori();
                });

                $('#jabKategori').on('change', function() {
                    var jabLatar = $('#jabLatar');
                    var jabJenis = $('#jabJenis');
                    var jabTugas = $('#jabTugas');

                    var option = '';
                    const dataJab = {!! json_encode($status) !!};

                    var selectedOption = $(this).find('option:selected');
                    var seletJenis = jabJenis.find('option:selected');
                    console.log(selectedOption);
                    console.log(seletJenis);
                    if (selectedOption.text() == 'GP (Guru Penggerak)' && seletJenis.text() ==
                        'Kepala Sekolah') {
                        let dataJabValue = dataJab['s_jabKategoriKepsek'].map((item, i) => {
                            option = $("<option>")
                                .text(item)
                                .attr('value', item)
                                .removeAttr('disabled');
                            jabLatar.append(option);
                        });

                    } else if (selectedOption.text() == 'GP (Guru Penggerak)' && seletJenis.text() ==
                        'Pengawas') {
                        let dataJabValue = dataJab['s_jabKategoriPengawas'].map((item, i) => {
                            option = $("<option>")
                                .text(item)
                                .attr('value', item)
                                .removeAttr('disabled');
                            jabLatar.append(option);
                        });

                    } else if (selectedOption.text() == 'GP (Guru Penggerak)' && (seletJenis.text() ==
                            'Guru' || seletJenis.text() ==
                            'Konselor')) {
                        let dataJabValue = dataJab['s_jabTugas'].map((item, i) => {
                            option = $("<option>")
                                .text(item)
                                .attr('value', item)
                                .removeAttr('disabled');
                            jabTugas.append(option);
                        });

                    } else {
                        jabLatar.empty();
                        jabLatar.append($('<option>', {
                            value: '',
                            text: '-- Pilih Latar Jabatan --',
                            disabled: true,
                            selected: true
                        }));

                        jabTugas.empty();
                        jabTugas.append($('<option>', {
                            value: '',
                            text: '-- Pilih Tugas Jabatan --',
                            disabled: true,
                            selected: true
                        }));
                    }

                    console.log('Selected Value (jabTugas):', selectedOption.val());
                    console.log('Selected Text (jabTugas):', selectedOption.text());
                });

                $('#jabJenis').on('change', function() {
                    var jabKategori = $('#jabKategori');
                    var jabTugas = $('#jabTugas');
                    var jabLatar = $('#jabLatar');
                    var jabJenis = $(this);
                    var option = '';
                    const dataJab = {!! json_encode($status) !!};

                    jabKategori.empty();
                    jabKategori.append($('<option>', {
                        value: '',
                        text: '-- Pilih Kategori --',
                        disabled: true,
                        selected: true
                    }));

                    jabTugas.empty();
                    jabTugas.append($('<option>', {
                        value: '',
                        text: '-- Pilih Tugas --',
                        disabled: true,
                        selected: true
                    }));

                    jabLatar.empty();
                    jabLatar.append($('<option>', {
                        value: '',
                        text: '-- Pilih Latar Jabatan --',
                        disabled: true,
                        selected: true
                    }));

                    var selectedOption = $(this).find('option:selected');

                    if (selectedOption.text() == 'Guru' || selectedOption.text() == 'Konselor') {
                        let dataJabValue = dataJab['s_jabKategori'].map((item, i) => {
                            option = $("<option>")
                                .text(item)
                                .attr('value', item)
                                .removeAttr('disabled');
                            jabKategori.append(option);
                        });
                    } else if (selectedOption.text() == 'Pengawas') {
                        let dataJabValue = dataJab['s_jabKategori'].map((item, i) => {
                            option = $("<option>")
                                .text(item)
                                .attr('value', item)
                                .removeAttr('disabled');
                            jabKategori.append(option);
                        });

                        // dataJab['s_jabKategoriPengawas'].map((item, i) => {
                        //     option = $("<option>")
                        //         .text(item)
                        //         .attr('value', item)
                        //         .removeAttr('disabled');
                        //     jabLatar.append(option);
                        // });

                    } else if (selectedOption.text() == 'Kepala Sekolah') {
                        let dataJabValue = dataJab['s_jabKategori'].map((item, i) => {
                            option = $("<option>")
                                .text(item)
                                .attr('value', item)
                                .removeAttr('disabled');
                            jabKategori.append(option);
                        });

                        // dataJab['s_jabKategoriKepsek'].map((item, i) => {
                        //     option = $("<option>")
                        //         .text(item)
                        //         .attr('value', item)
                        //         .removeAttr('disabled');
                        //     jabLatar.append(option);
                        // });



                    } else {
                        jabKategori.empty();
                        jabKategori.append($('<option>', {
                            value: '',
                            text: '-- Pilih Kategori --',
                            disabled: true,
                            selected: true
                        }));

                        jabTugas.empty();
                        jabTugas.append($('<option>', {
                            value: '',
                            text: '-- Pilih Tugas --',
                            disabled: true,
                            selected: true
                        }));

                        jabLatar.empty();
                        jabLatar.append($('<option>', {
                            value: '',
                            text: '-- Pilih Latar Jabatan --',
                            disabled: true,
                            selected: true
                        }));
                    }

                    console.log('Selected Value (jabKategori):', selectedOption.val());
                    console.log('Selected Text (jabKategori):', selectedOption.text());
                });

                $('#jabLatar').on('change', function() {
                    var jabLatar = $(this);
                    var jabTugas = $('#jabTugas');

                    var option = '';
                    const dataJab = {!! json_encode($status) !!};

                    var selectedOption = $(this).find('option:selected');
                    var seletTugas = jabTugas.find('option:selected');
                    console.log(selectedOption);
                    console.log(seletTugas);

                    jabTugas.empty();
                    jabTugas.append($('<option>', {
                        value: '',
                        text: '-- Pilih Tugas Jabatan --',
                        disabled: true,
                        selected: true
                    }));

                    if (selectedOption.text() != '') {
                        let dataJabValue = dataJab['s_jabTugas'].map((item, i) => {
                            option = $("<option>")
                                .text(item)
                                .attr('value', item)
                                .removeAttr('disabled');
                            jabTugas.append(option);
                        });

                    } else {
                        jabTugas.empty();
                        jabTugas.append($('<option>', {
                            value: '',
                            text: '-- Pilih Tugas Jabatan --',
                            disabled: true,
                            selected: true
                        }));
                    }
                });


            });
        </script>
    @endpush
@endsection
