<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <div class="card-title">Data Produk - {{$produk->nama}}</div>
            </div>
            <div class="col-6 text-end">
                <div class="card-options">
                    <button class="btn btn-info btn-data" style="margin-left: 2px">
                        <i class="bx bx-arrow-back"></i> Data Produk
                    </button>
                    <button class="btn btn-primary btn-add-detail-produk" style="margin-left: 2px">
                        <i class="bx bx-plus-medical"></i> Tambah
                    </button>
                    <button class="btn btn-success btn-print ml-2" style="margin-left: 2px">
                        <i class="fa fa-print"></i> Print
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-stripped" id="tableData">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Size</th>
                    <th>Harga Produk</th>
                    <th>Stok</th>
                    <th>Foto</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @if ($produk->data != null)
                @foreach (json_decode($produk->data, true) as $key => $data)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$data['size']}}</td>
                    <td>{{toRupiah($data['harga'])}}</td>
                    <td>{{$data['stok']}}</td>
                    <td>
                        <img src="{{$data['foto']}}" class="img-fluid" width="100px">
                    </td>
                    <td>{!! $data['status'] == true ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-danger">Tidak Aktif</span>' !!}</td>
                    <td>
                        <button class="btn btn-success btn-edit-detail-produk" data-size="{{$data['size']}}">
                            <i class="bx bx-pencil"></i>
                        </button>
                        {{-- <button class="btn btn-danger btn-delete-detail-produk" data-size="{{$data['size']}}">
                            <i class="bx bx-trash"></i>
                        </button> --}}
                    </td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>

<script>
    $('#tableData').DataTable({
        language: {
            paginate: {
                previous: "<i class='fa fa-arrow-left'>",
                next: "<i class='fa fa-arrow-right'>"
            },
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            lengthMenu: "Menampilkan _MENU_ data",
            search: "Cari:",
            emptyTable: "Tidak ada data tersedia",
            zeroRecords: "Tidak ada data yang cocok",
            loadingRecords: "Memuat data...",
            processing: "Memproses...",
            infoFiltered: "(difilter dari _MAX_ total data)"
        },
        lengthMenu: [
            [5, 10, 15, 20, -1],
            [5, 10, 15, 20, "All"]
        ],
    });
</script>
