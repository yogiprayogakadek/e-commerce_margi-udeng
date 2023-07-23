<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <div class="card-title">Data Produk</div>
            </div>
            <div class="col-6 text-end">
                <div class="card-options">
                    <button class="btn btn-primary btn-add" style="margin-left: 2px">
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
                    <th>Kategori</th>
                    <th>Nama Produk</th>
                    <th>Foto</th>
                    <th>Data</th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produk as $produk)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$produk->kategori->nama}}</td>
                    <td>{{$produk->nama}}</td>
                    <td>
                        <img src="{{$produk->foto}}" class="img-fluid" width="100px">
                    </td>
                    <td>
                        <button class="btn btn-primary btn-detail-data" data-id="{{$produk->id}}">
                            <i class="fa fa-eye"></i> Data
                        </button>
                    </td>
                    <td>{!! $produk->status == true ? '<span class="badge bg-success">Aktif</span>' : '<span class="badge bg-danger">Tidak Aktif</span>' !!}</td>
                    <td>
                        <button class="btn btn-success btn-edit" data-id="{{$produk->id}}">
                            <i class="bx bx-pencil"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
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
