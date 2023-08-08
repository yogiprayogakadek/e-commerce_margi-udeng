<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <div class="card-title">Data Order</div>
            </div>
            <div class="col-6 text-end">
                <div class="card-options">
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
                    <th>Order Code</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Detail Order</th>
                    <th>Status</th>
                    {{-- <th></th> --}}
                </tr>
            </thead>
            <tbody>
                @foreach ($order as $order)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$order->order_code}}</td>
                    <td>{{$order->user->customer->nama}}</td>
                    <td>{{toRupiah($order->pembayaran->total)}}</td>
                    <td>
                        <a href="javascript:void(0);" class="detail-order" data-id="{{$order->id}}">Lihat</a>
                    </td>
                    <td>{!! $order->status == 'Success' ? '<span class="badge bg-success">'.$order->status.'</span>' : '<span class="badge bg-danger">'.$order->status.'</span>' !!}</td>
                    {{-- <td>
                        <button class="btn btn-success btn-edit" data-id="{{$order->id}}">
                            <i class="bx bx-pencil"></i>
                        </button>
                    </td> --}}
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail order</h5>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fa fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <table class="table table-responsive" id="tableDetail">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Harga</th>
                                    <th>Size</th>
                                    <th>Kuantitas</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" class="text-center">
                                        <strong>Total</strong>
                                    </td>
                                    <td class="total"></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
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
