<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <div class="card-title">Tambah Produk</div>
            </div>
            <div class="col-6 text-end">
                <div class="card-options">
                    <button class="btn btn-primary btn-data" style="margin-left: 2px">
                        <i class="bx bx-arrow-back"></i> Data
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form id="formAdd">
            <div class="row mb-4">
                <label for="kategori" class="col-sm-1 col-form-label">Kategori Produk</label>
                <div class="col-sm-11">
                    <select name="kategori" id="kategori" class="kategori form-control">
                        @foreach ($kategori as $key => $value)
                            <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback error-kategori"></div>
                </div>
            </div>
            <div class="row mb-4 hidden-input" hidden>
                <label for="nama" class="col-sm-1 col-form-label">Nama Produk</label>
                <div class="col-sm-11">
                    <input type="text" class="form-control nama" id="nama" name="nama" placeholder="masukkan nama produk">
                    <div class="invalid-feedback error-nama"></div>
                </div>
            </div>
            <div class="row mb-4 hidden-input" hidden>
                <label for="deskripsi" class="col-sm-1 col-form-label">Deskripsi Produk</label>
                <div class="col-sm-11">
                    <textarea class="form-control deskripsi" id="deskripsi" name="deskripsi" placeholder="masukkan deskripsi produk"></textarea>
                    <div class="invalid-feedback error-deskripsi"></div>
                </div>
            </div>
            <div class="row mb-4 hidden-input" hidden>
                <label for="foto" class="col-sm-1 col-form-label">Foto Produk</label>
                <div class="col-sm-11">
                    <input type="file" class="form-control foto" id="foto" name="foto" placeholder="masukkan foto produk">
                    <div class="invalid-feedback error-foto"></div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer text-end">
        <button class="btn btn-info btn-save pull-right" type="button">
            <i class="fa fa-save"></i> Simpan
        </button>
    </div>
</div>
