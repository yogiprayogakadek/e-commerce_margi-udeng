<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <div class="card-title">Tambah Data Produk - {{$produk->nama}}</div>
            </div>
            <div class="col-6 text-end">
                <div class="card-options">
                    <button class="btn btn-primary btn-data-detail-produk" style="margin-left: 2px">
                        <i class="bx bx-arrow-back"></i> Data Produk
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form id="formEditDataProduk">
            <input type="hidden" name="size" id="size" value="{{$data['size']}}">
            <div class="row mb-4">
                <label for="harga" class="col-sm-1 col-form-label">Harga</label>
                <div class="col-sm-11">
                    <input type="text" class="form-control harga" id="harga" name="harga" placeholder="masukkan harga produk" value="{{toRupiah($data['harga'])}}">
                    <div class="invalid-feedback error-harga"></div>
                </div>
            </div>
            <div class="row mb-4">
                <label for="stok" class="col-sm-1 col-form-label">Stok</label>
                <div class="col-sm-11">
                    <input type="text" class="form-control stok" id="stok" name="stok" placeholder="masukkan stok produk" value="{{$data['stok']}}">
                    <div class="invalid-feedback error-stok"></div>
                </div>
            </div>
            <div class="row mb-4">
                <label for="status" class="col-sm-1 col-form-label">Status</label>
                <div class="col-sm-11">
                    <select name="status" class="form-control status">
                        <option value="1" {{$data['status'] == true ? 'selected' : ''}}>Aktif</option>
                        <option value="0" {{$data['status'] == false ? 'selected' : ''}}>Tidak Aktif</option>
                    </select>
                    <div class="invalid-feedback error-status"></div>
                </div>
            </div>
            <div class="row mb-4">
                <label for="foto" class="col-sm-1 col-form-label">Foto Produk</label>
                <div class="col-sm-11">
                    <input type="file" class="form-control foto mt-3" id="foto" name="foto" placeholder="masukkan foto produk">
                    <div class="invalid-feedback error-foto"></div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer text-end">
        <button class="btn btn-info btn-update-detail-produk pull-right" type="button">
            <i class="fa fa-save"></i> Simpan
        </button>
    </div>
</div>
