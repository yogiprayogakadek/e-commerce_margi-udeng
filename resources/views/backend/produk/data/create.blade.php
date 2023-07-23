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
        <form id="formAddDataProduk">
            <div class="row mb-4">
                <label for="size" class="col-sm-1 col-form-label">Ukuran Produk</label>
                <div class="col-sm-11">
                    <select name="size" id="size" class="size form-control">
                        @foreach ($size as $value)
                            <option value="{{$value}}">{{$value}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback error-size"></div>
                </div>
            </div>
            <div class="row mb-4 hidden-input" hidden>
                <label for="harga" class="col-sm-1 col-form-label">Harga</label>
                <div class="col-sm-11">
                    <input type="text" class="form-control harga" id="harga" name="harga" placeholder="masukkan harga produk">
                    <div class="invalid-feedback error-harga"></div>
                </div>
            </div>
            <div class="row mb-4 hidden-input" hidden>
                <label for="stok" class="col-sm-1 col-form-label">Stok</label>
                <div class="col-sm-11">
                    <input type="text" class="form-control stok" id="stok" name="stok" placeholder="masukkan stok produk">
                    <div class="invalid-feedback error-stok"></div>
                </div>
            </div>
            <div class="row mb-4 hidden-input" hidden>
                <label for="foto" class="col-sm-1 col-form-label">Foto Produk</label>
                <div class="col-sm-11">
                    <input type="file" class="form-control foto mt-3" id="foto" name="foto" placeholder="masukkan foto produk">
                    <div class="invalid-feedback error-foto"></div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer text-end">
        <button class="btn btn-info btn-save-detail-produk pull-right" type="button">
            <i class="fa fa-save"></i> Simpan
        </button>
    </div>
</div>
