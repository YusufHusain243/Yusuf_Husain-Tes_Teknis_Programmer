@extends('main')

@section('content')
    <div class="row">
        <div class="col-6">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahPenduduk">
                Tambah Penduduk
            </button>
        </div>
        <div class="col-6 d-flex justify-content-end">
            <form action="/laporan" method="post">
                @csrf
                <input type="hidden" name="laporan" value="{{ json_encode($data['penduduk']) }}">
                <button type="submit" class="btn btn-success">
                    Export Penduduk
                </button>
            </form>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Pilih Provinsi
                </button>
                <ul class="dropdown-menu">
                    @foreach ($data['provinsi'] as $item)
                        <li><a class="dropdown-item" href="/filterProvinsi/{{ $item->id }}">{{ $item->name }}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    Pilih Kabupaten
                </button>
                <ul class="dropdown-menu">
                    @foreach ($data['kabupaten'] as $item)
                        <li><a class="dropdown-item" href="/filterKabupaten/{{ $item->id }}">{{ $item->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    <div class="modal fade" id="tambahPenduduk" tabindex="-1" aria-labelledby="tambahPendudukLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="/kelolaPenduduk" method="post">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="tambahPendudukLabel">Tambah Penduduk</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" name="name" class="form-control" id="nama">
                        </div>
                        <div class="mb-3">
                            <label for="nik" class="form-label">NIK</label>
                            <input type="number" name="nik" class="form-control" id="nik">
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" name="birth_date" class="form-control" id="tanggal_lahir">
                        </div>
                        <div class="mb-3 ">
                            <label class="form-label">Jenis Kelamin</label>
                            <div class="card" style="max-height: 100px;overflow-y:auto;">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="Laki Laki" name="gender"
                                        id="male">
                                    <label class="form-check-label" for="male">
                                        Laki Laki
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" value="Perempuan" name="gender"
                                        id="female">
                                    <label class="form-check-label" for="female">
                                        Perempuan
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 ">
                            <label for="provinsi" class="form-label">Provinsi</label>
                            <div class="card" style="max-height: 100px;overflow-y:auto;">
                                @foreach ($data['provinsi'] as $item)
                                    <div class="form-check" id="provinsi">
                                        <input class="form-check-input" type="radio" value="{{ $item->id }}"
                                            name="id_provinsi" oninput="selectProv({{ $item->id }})"
                                            id="provinsi{{ $item->id }}">
                                        <label class="form-check-label" for="provinsi{{ $item->id }}">
                                            {{ $item->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="mb-3" id="kabupaten" style="display: none;">
                            <label for="kabupaten" class="form-label">Kabupaten</label>
                            <div class="card" style="max-height: 100px;overflow-y:auto;">
                                <div id="output"></div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <br>
    <br>
    <div class="card">
        <div class="card-header">
            <strong>
                <span>Kelola Penduduk</span>
            </strong>
        </div>
        <div class="card-body">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Aksi</th>
                        <th>Nama</th>
                        <th>NIK</th>
                        <th>Tgl Lahir</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
                        <th>TimeStamp</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data['penduduk'] as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="input-group">
                                    <div>
                                        <button type="button" class="btn bg-danger mb-0 text-white"
                                            data-bs-toggle="modal" data-bs-target="#modal-hapus{{ $item->id }}">
                                            Hapus
                                        </button>
                                        <div class="modal fade" id="modal-hapus{{ $item->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="modal-hapus{{ $item->id }}"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-danger modal-dialog-centered modal-"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="py-3 text-center">
                                                            <i class="ni ni-fat-remove ni-3x" style="color: red"></i>
                                                            <h4 class="text-gradient text-danger mt-4">Yakin Hapus Data
                                                                Ini?
                                                            </h4>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div>
                                                            <form action="/kelolaPenduduk/{{ $item->id }}"
                                                                method="post">
                                                                @csrf
                                                                @method('delete')
                                                                <button type="submit"
                                                                    class="btn btn-danger btn-sm">Hapus</button>
                                                            </form>
                                                        </div>
                                                        <div>
                                                            <button type="button" class="btn btn-primary btn-sm ml-auto"
                                                                data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <button type="submit" id="button"
                                            onclick="selectProv2({{ $item->id_provinsi }})" on class="btn btn-warning"
                                            data-bs-toggle="modal" data-bs-target="#editPenduduk{{ $item->id }}">
                                            Edit
                                        </button>

                                        <div class="modal fade" id="editPenduduk{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="editPenduduk{{ $item->id }}Label" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form action="/kelolaPenduduk/{{ $item->id }}" method="post">
                                                    @csrf
                                                    @method('patch')
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5"
                                                                id="editPenduduk{{ $item->id }}Label">Edit
                                                                Penduduk</h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="nama" class="form-label">Nama</label>
                                                                <input type="text" value="{{ $item->name }}"
                                                                    name="name" class="form-control" id="nama">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="nik" class="form-label">NIK</label>
                                                                <input type="number" value="{{ $item->nik }}"
                                                                    name="nik" class="form-control" id="nik">
                                                            </div>
                                                            <div class="mb-3">
                                                                <label for="tanggal_lahir" class="form-label">Tanggal
                                                                    Lahir</label>
                                                                <input type="date" value="{{ $item->birth_date }}"
                                                                    name="birth_date" class="form-control"
                                                                    id="tanggal_lahir">
                                                            </div>
                                                            <div class="mb-3 ">
                                                                <label class="form-label">Jenis Kelamin</label>
                                                                <div class="card"
                                                                    style="max-height: 100px;overflow-y:auto;">
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio"
                                                                            value="Laki Laki" name="gender"
                                                                            id="male"
                                                                            {{ $item->gender == 'Laki Laki' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="male">
                                                                            Laki Laki
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio"
                                                                            value="Perempuan" name="gender"
                                                                            id="female"
                                                                            {{ $item->gender == 'Perempuan' ? 'checked' : '' }}>
                                                                        <label class="form-check-label" for="female">
                                                                            Perempuan
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3 ">
                                                                <label for="provinsi" class="form-label">Provinsi</label>
                                                                <div class="card"
                                                                    style="max-height: 100px;overflow-y:auto;">
                                                                    @foreach ($data['provinsi'] as $prov)
                                                                        <div class="form-check" id="provinsi">
                                                                            <input class="form-check-input" type="radio"
                                                                                value="{{ $prov->id }}"
                                                                                name="id_provinsi"
                                                                                oninput="selectProv2({{ $prov->id }})"
                                                                                id="provinsi{{ $prov->id }}"
                                                                                {{ $item->id_provinsi == $prov->id ? 'checked' : '' }}>
                                                                            <label class="form-check-label"
                                                                                for="provinsi{{ $prov->id }}">
                                                                                {{ $prov->name }}
                                                                            </label>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                            <div class="mb-3" id="kabupaten2" style="display: none;">
                                                                <label for="kabupaten"
                                                                    class="form-label">Kabupaten</label>
                                                                <div class="card"
                                                                    style="max-height: 100px;overflow-y:auto;">
                                                                    <div id="output2"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->nik }}</td>
                            <td>{{ $item->birth_date }}</td>
                            <td>{{ $item->prov . ', ' . $item->kab }}</td>
                            <td>{{ $item->gender }}</td>
                            <td>{{ $item->updated_at }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('after-script')
    <script>
        new DataTable('#example');
    </script>

    <script>
        function selectProv(id) {
            document.getElementById("kabupaten").style.display = "block";
            document.getElementById("output").innerHTML = "";

            $.ajax({
                type: 'POST',
                url: '/getKabupaten',
                data: {
                    _token: "{{ csrf_token() }}",
                    prov_id: id,
                },
                success: function(response) {
                    for (item of response) {
                        $("#output").append(
                            "<div class='form-check'><input class='form-check-input' type='radio' value='" +
                            item.id + "'name='id_kabupaten'><label class='form-check-label'>" + item.name +
                            "</label></div>");
                    }
                },
            });
        }

        function selectProv2(id) {
            document.getElementById("kabupaten2").style.display = "block";
            document.getElementById("output2").innerHTML = "";

            $.ajax({
                type: 'POST',
                url: '/getKabupaten',
                data: {
                    _token: "{{ csrf_token() }}",
                    prov_id: id,
                },
                success: function(response) {
                    for (item of response) {
                        console.log(response);
                        $("#output2").append(
                            "<div class='form-check'><input class='form-check-input' type='radio' value='" +
                            item.id + "'name='id_kabupaten'><label class='form-check-label'>" + item.name +
                            "</label></div>");
                    }
                },
            });
        }
    </script>
@endpush
