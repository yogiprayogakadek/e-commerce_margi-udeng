@extends('backend.templates.master')

@push('css')
    <script src="https://cdn.jsdelivr.net/npm/echarts@5.4.2/dist/echarts.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
    <link rel="stylesheet" href="{{asset('assets/main/css/loading.css')}}">
@endpush

@section('content')
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
            <div class="card">
                <div class="card-header bg-primary text-white bg-opacity-75">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label for="awal" class="col-form-label">Tanggal Awal</label>
                                <input type="date" class="form-control" id="awal" name="awal"
                                    value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <label for="akhir" class="col-form-label">Tanggal Akhir</label>
                                <input type="date" class="form-control" id="akhir" name="akhir"
                                    value="{{ date('Y-m-d') }}">
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group">
                                <label for="kategori" class="col-form-label">Kategori</label>
                                <select class="form-control" id="kategori" name="kategori">
                                    <option value="Kategori">Kategori</option>
                                    <option value="Transaksi">Transaksi</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-1">
                            <div class="form-group">
                                <label for="kategori" class="col-form-label" style="color: #8092ec;">Search</label>
                                <button class="btn btn-secondary btn-rounded btn-search">
                                    <i class="bx bx-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div id="main" style="width: 800px;height:700px;"></div>
                </div>
                <div class="card-footer">
                    {{--  --}}
                </div>
            </div>
        </div>
        <div class="col-2"></div>
    </div>
@endsection



@push('script')
    {{--  --}}
@endpush
