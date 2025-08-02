@extends('layouts.app')

@section('content')
    <div class="d-flex">
        @include('layouts.sidebar')

        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">{{ __('Profile') }}</div>

                        <div class="card-body">
                            <form action="{{ route('profile.update') }}" method="POST" class=" d-flex flex-column">
                                @csrf
                                @method('PUT')

                                <div class="rounded-circle overflow-hidden mx-auto mb-4">
                                    <img src="{{ asset('assets/img/avatar.jpg') }}" alt="Profile Photo">
                                </div>
                                <div class="mb-3">
                                    <label for="nip"
                                        class="form-label">{{ Auth::user()->member->type === 'pegawai' ? 'NIP' : 'NISN' }}</label>
                                    <input type="text" class="d-none"
                                        value="{{ Auth::user()->member->type === 'pegawai' ? Auth::user()->member->nip : Auth::user()->member->nisn }}"
                                        readonly>
                                    <div class="form-control">
                                        {{ Auth::user()->member->type === 'pegawai' ? Auth::user()->member->nip : Auth::user()->member->nisn }}
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control editable-input" name="name" id="name"
                                        aria-describedby="name" data-original="{{ Auth::user()->member->name }}"
                                        value="{{ Auth::user()->member->name }}" readonly required>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" class="form-control editable-input" name="email" id="email"
                                        aria-describedby="email" data-original="{{ Auth::user()->email }}"
                                        value="{{ Auth::user()->email }}" readonly required>
                                </div>
                                <div class="d-flex gap-3 mt-3 justify-content-end" id="update-act">
                                    <button class="btn btn-sm btn-warning d-flex align-items-center justify-content-center"
                                        onclick="enableInputsProfile()" type="button">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" width="24" class="me-2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>

                                        Update
                                    </button>
                                </div>
                                <div class="d-flex gap-3 mt-3 justify-content-end d-none" id="save-act">
                                    <button
                                        class="btn btn-sm btn-secondary d-flex align-items-center justify-content-center"
                                        type="button" onclick="disableInputsProfile()">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" width="24" class="me-2">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                        </svg>

                                        Cancle
                                    </button>
                                    <button class="btn btn-sm btn-primary d-flex align-items-center justify-content-center"
                                        type="submit">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" width="24" class="me-2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                                        </svg>

                                        Save
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-8">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <span>{{ __('Vehicles') }}</span>
                            <button class="btn btn-sm btn-primary d-flex align-items-center" type="button"
                                onclick="addVehicle()">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" width="24" class="me-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                                </svg>

                                Add Vehicle
                            </button>
                        </div>

                        <div class="card-body d-flex gap-3 flex-wrap" id="vehicle-container">
                            @foreach (Auth::user()->member->vehicles as $vehicle)
                                <div class="col-3 border rounded p-2">
                                    <form class="d-flex flex-column" method="POST"
                                        action="{{ route('vehicles.update', $vehicle->id) }}">
                                        @csrf
                                        @method('PUT')

                                        <div class="mb-3">
                                            <label for="type-{{ $vehicle->id }}" class="form-label">Vehicle
                                                Type</label>
                                            <input type="text" name="vehicle_type"
                                                class="form-control editable-vehicle-{{ $vehicle->id }}"
                                                id="type-{{ $vehicle->id }}" aria-describedby="text"
                                                data-{{ $vehicle->id }}="{{ ucfirst($vehicle->vehicle_type) }}"
                                                value="{{ ucfirst($vehicle->vehicle_type) }}" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label for="num-plat-{{ $vehicle->id }}" class="form-label">
                                                Number Plat
                                            </label>
                                            <input type="text" name="number_plat"
                                                class="form-control editable-vehicle-{{ $vehicle->id }}"
                                                id="num-plat-{{ $vehicle->id }}" aria-describedby="text"
                                                data-{{ $vehicle->id }}="{{ $vehicle->number_plat }}"
                                                value="{{ $vehicle->number_plat }}" readonly>
                                        </div>
                                        <div class="d-flex justify-content-end gap-2"
                                            id="update-vehicle-{{ $vehicle->id }}">
                                            <button class="btn btn-warning d-flex align-items-center" type="button"
                                                onclick="enableInputsVehicle({{ $vehicle->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    width="16">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                                </svg>
                                            </button>
                                        </div>
                                        <div class="d-flex justify-content-end gap-2 d-none"
                                            id="save-vehicle-{{ $vehicle->id }}">
                                            <button class="btn btn-secondary d-flex align-items-center" type="button"
                                                onclick="disableInputsVehicle({{ $vehicle->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    width="16">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 18 18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                            <button class="btn btn-primary d-flex align-items-center" type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    width="16">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                                                </svg>
                                            </button>
                                        </div>
                                    </form>
                                    <form method="POST" action="{{ route('vehicles.destroy', $vehicle->id) }}"
                                        onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger d-flex align-items-center ms-auto mt-2"
                                            type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" width="16">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function hiddenUpdateProfile() {
            const updateAct = document.getElementById('update-act');
            updateAct.classList.add('d-none');

            const saveAct = document.getElementById('save-act');
            saveAct.classList.remove('d-none');
        }

        function showUpdateProfile() {
            const updateAct = document.getElementById('update-act');
            updateAct.classList.remove('d-none');

            const saveAct = document.getElementById('save-act');
            saveAct.classList.add('d-none');
        }

        function enableInputsProfile() {
            const inputs = document.querySelectorAll('.editable-input');

            inputs.forEach(input => {
                input.removeAttribute('readonly');
            });

            hiddenUpdateProfile();
        }

        function disableInputsProfile() {
            const inputs = document.querySelectorAll('.editable-input');

            inputs.forEach(input => {
                const originalValue = input.getAttribute('data-original');
                input.value = originalValue;
                input.setAttribute('readonly', true);
            });

            showUpdateProfile();
        }

        function addVehicle() {
            const container = document.getElementById('vehicle-container');

            const newCard = document.createElement('div');
            newCard.className = 'col-3';

            newCard.innerHTML = `
                <form class="border rounded p-2 d-flex flex-column" method='POST' action="{{ route('vehicles.store') }}">
                    <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]').content}">

                    <div class="mb-3">
                        <label for="vehicle-type" class="form-label">Vehicle Type</label>
                        <input type="text" class="form-control" id="vehicle-type" aria-describedby="text" name="vehicle_type"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="number_plat" class="form-label">Number Plat</label>
                        <input type="text" class="form-control" id="number-plat" aria-describedby="text" name="number_plat"
                            required>
                    </div>
                    <div class="d-flex justify-content-end gap-2">
                        <button class="btn btn-secondary d-flex align-items-center remove-card" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" width="16">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                            </svg>
                        </button>
                        <button class="btn btn-primary d-flex align-items-center" type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" width="16">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                            </svg>
                        </button>
                    </div>
                </form>
            `;

            newCard.querySelector('.remove-card').addEventListener('click', function() {
                newCard.remove();
            });

            container.appendChild(newCard);
        }

        function hiddenUpdateVehicle(id) {
            const updateVehicle = document.getElementById(`update-vehicle-${id}`);
            updateVehicle.classList.add('d-none');

            const saveVehicle = document.getElementById(`save-vehicle-${id}`);
            saveVehicle.classList.remove('d-none');
        }

        function showUpdateVehicle(id) {
            const updateVehicle = document.getElementById(`update-vehicle-${id}`);
            updateVehicle.classList.remove('d-none');

            const saveVehicle = document.getElementById(`save-vehicle-${id}`);
            saveVehicle.classList.add('d-none');
        }

        function enableInputsVehicle(id) {
            const inputs = document.querySelectorAll(`.editable-vehicle-${id}`);

            inputs.forEach(input => {
                input.removeAttribute('readonly');
            });

            hiddenUpdateVehicle(id);
        }

        function disableInputsVehicle(id) {
            const inputs = document.querySelectorAll(`.editable-vehicle-${id}`);

            inputs.forEach(input => {
                const originalVehicleValue = input.getAttribute(`data-${id}`);
                input.value = originalVehicleValue;
                input.setAttribute('readonly', true);
            });

            showUpdateVehicle(id);
        }
    </script>
@endsection
