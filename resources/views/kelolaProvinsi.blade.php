@extends('main')

@section('content')
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahProvinsi">
        Tambah Provinsi
    </button>

    <div class="modal fade" id="tambahProvinsi" tabindex="-1" aria-labelledby="tambahProvinsiLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="/kelolaProvinsi" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="tambahProvinsiLabel">Tambah Provinsi</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="provinsi" class="form-label">Nama Provinsi</label>
                            <input type="text" name="name" class="form-control" id="provinsi">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
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
                <span>Kelola Provinsi</span>
            </strong>
        </div>
        <div class="card-body">
            <table id="example" class="display" style="width:100%">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Provinsi</th>
                        <th class="w-50 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <div class="input-group d-flex justify-content-center">
                                    <div>
                                        <button type="button" class="btn bg-danger mb-0 text-white" data-bs-toggle="modal"
                                            data-bs-target="#modal-hapus{{$item->id}}">
                                            Hapus
                                        </button>
                                        <div class="modal fade" id="modal-hapus{{$item->id}}" tabindex="-1" role="dialog"
                                            aria-labelledby="modal-hapus{{$item->id}}" aria-hidden="true">
                                            <div class="modal-dialog modal-danger modal-dialog-centered modal-"
                                                role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <div class="py-3 text-center">
                                                            <i class="ni ni-fat-remove ni-3x" style="color: red"></i>
                                                            <h4 class="text-gradient text-danger mt-4">Yakin Hapus Data Ini?
                                                            </h4>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div>
                                                            <form action="/kelolaProvinsi/{{ $item->id }}"
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
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editProvinsi{{ $item->id }}">
                                            Edit
                                        </button>

                                        <div class="modal fade" id="editProvinsi{{ $item->id }}" tabindex="-1"
                                            aria-labelledby="editProvinsi{{ $item->id }}Label" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form action="/kelolaProvinsi/{{$item->id}}" method="post">
                                                    @csrf
                                                    @method('patch')
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5"
                                                                id="editProvinsi{{ $item->id }}Label">Edit Provinsi
                                                            </h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3">
                                                                <label for="provinsi" class="form-label">Nama
                                                                    Provinsi</label>
                                                                <input type="text" name="name" value="{{$item->name}}" class="form-control" id="provinsi">
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-warning">Submit</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
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
@endpush
