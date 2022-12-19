@extends('layouts.user_type.auth')

@section('content')

<div>

    <div class="container-fluid py-4">
        <div class="card">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Edit Data') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                @foreach($penyedia as $p)
                <form role="form text-left" method="POST" action="{{ route('post_edit_penyedia') }}">
                    @csrf
                    <input type="text" class="form-control" name="id" id="id" value="{{ $p->id }}" hidden>
                    <div class="mb-3">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" placeholder="Username" name="username" id="username" aria-label="Name" aria-describedby="name" value="{{ $p->username }}">
                        @error('name')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" placeholder="Email" name="email" id="email" aria-label="Email" aria-describedby="email-addon" value="{{ $p->email }}">
                        @error('email')
                        <p class="text-danger text-xs mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <div class="form-group">
                            <label for="exampleFormControlSelect2">Role</label>
                            <select class="form-control" name="role" id="exampleFormControlSelect2" style="-webkit-appearance: listbox !important;">
                                <option>{{$p->role}}</option>
                                <option>admin</option>
                                <option>penyedia</option>
                                <option>user</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Simpan' }}</button>
                    </div>
                </form>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection