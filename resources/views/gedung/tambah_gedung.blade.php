@extends('layouts.user_type.auth')

@section('content')

<div>

    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Tambah Data') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form role="form text-left" method="POST" action="{{ route('post_gedung') }}">
                    @csrf
                    <div class="mb-3">
                    <label for="gedung">Nama Gedung</label>
                        <input type="text" class="form-control" placeholder="Nama Gedung" name="nama_gedung" id="nama_gedung" aria-label="nama_gedung" aria-describedby="nama_gedung">
                    </div>
                    <div class="mb-3">
                    <label for="lokasi">Lokasi</label>
                        <textarea class="form-control" id="lokasi" rows="3" placeholder="Masukan lokasi" name="lokasi"></textarea>
                    </div>
                    <div class="mb-3">
                    <label for="harga">Harga</label>
                        <input type="text" class="form-control" placeholder="Harga" name="harga" id="harga" aria-label="harga" aria-describedby="harga">
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Simpan' }}</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection