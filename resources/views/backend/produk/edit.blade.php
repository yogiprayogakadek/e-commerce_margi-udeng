<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-6">
                <div class="card-title">Ubah Produk - {{$produk->nama}}</div>
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
        <form id="formEdit">
            <div class="row mb-4">
                <input type="hidden" value="{{$produk->id}}" id="id" name="id">
                <label for="kategori" class="col-sm-1 col-form-label">Kategori Produk</label>
                <div class="col-sm-11">
                    <select name="kategori" id="kategori" class="kategori form-control">
                        @foreach ($kategori as $key => $value)
                            <option value="{{$key}}" {{$key == $produk->kategori_id ? 'selected' : ''}}>{{$value}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback error-kategori"></div>
                </div>
            </div>
            <div class="row mb-4 hidden-input">
                <label for="nama" class="col-sm-1 col-form-label">Nama Produk</label>
                <div class="col-sm-11">
                    <input type="text" class="form-control nama" id="nama" name="nama" placeholder="masukkan nama produk" value="{{$produk->nama}}">
                    <div class="invalid-feedback error-nama"></div>
                </div>
            </div>
            <div class="row mb-4 hidden-input">
                <label for="deskripsi" class="col-sm-1 col-form-label">Deskripsi Produk</label>
                <div class="col-sm-11">
                    <textarea class="form-control deskripsi" id="deskripsi" name="deskripsi" placeholder="masukkan deskripsi produk">{{$produk->deskripsi}}</textarea>
                    <div class="invalid-feedback error-deskripsi"></div>
                </div>
            </div>
            <div class="row mb-4 hidden-input">
                <label for="foto" class="col-sm-1 col-form-label">Foto Produk</label>
                <div class="col-sm-11">
                    <input type="file" class="form-control foto" id="foto" name="foto" placeholder="masukkan foto produk">
                    <span class="text-muted text-small">*kosongkan jika tidak ingin mengganti foto</span>
                    <div class="invalid-feedback error-foto"></div>
                </div>
            </div>
            <div class="row mb-4">
                <label for="status" class="col-sm-1 col-form-label">Status</label>
                <div class="col-md-11">
                    <select class="form-select status" name="status">
                        <option value="">Pilih status...</option>
                        <option value="1" {{$produk->status == true ? 'selected' : ''}}>Aktif</option>
                        <option value="0" {{$produk->status == false ? 'selected' : ''}}>Tidak Aktif</option>
                    </select>
                    <div class="invalid-feedback error-status"></div>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer text-end">
        <button class="btn btn-info btn-update pull-right" type="button">
            <i class="fa fa-save"></i> Simpan
        </button>
    </div>
</div>
