@extends('layouts.app')

@section('content')
    <div class="d-flex">
        @include('layouts.sidebar')

        <div class="container py-4">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Register Guest') }}</div>

                        <div class="card-body">
                            <form action="{{ route('guests.store') }}" method="post" class="d-flex flex-column">
                                @csrf

                                <div class="row">
                                    <div class="mb-3 col-6">
                                        <label for="name">Guest Name</label>
                                        <input type="text" name="name" class="form-control" id="name" required>
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="no-telp">Guest Contact (HP)</label>
                                        <input type="text" name="no_telp" class="form-control" id="no-telp" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <label for="number-plat">Number Plat</label>
                                            <input type="text" name="number_plat" class="form-control" id="number-plat"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="vehicle-type">Vehicle Type</label>
                                            <select name="vehicle_type" id="vehicle-type" class="form-control" required>
                                                <option value="">-- Choose --</option>
                                                <option value="mobil">Mobil</option>
                                                <option value="motor">Motor</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3 col-6">
                                        <label for="needs">Needs</label>
                                        <textarea class="form-control" name="needs" id="needs" rows="4" style="resize: none;" required></textarea>
                                    </div>
                                </div>


                                <button type="submit" class="btn btn-primary ms-auto">
                                    Logging

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" width="16" class="ms-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
