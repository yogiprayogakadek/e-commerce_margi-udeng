@extends('backend.templates.master')

@section('title', 'Order')
@section('sub-title', 'Data')

@section('content')
<div class="row">
    <div class="col-12 render">
        {{-- render --}}
    </div>
</div>
@endsection

@push('script')
    <script src="{{asset('assets/main/functions/order/main.js')}}"></script>
@endpush
