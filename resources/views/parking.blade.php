@extends('layouts.app')

@section('content')
    <div class="d-flex">
        @include('layouts.sidebar')

        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">{{ __('Input Parking Log') }}</div>

                        <div class="card-body d-flex flex-column">
                            <div id="reader" style="width: 300px;" class="mx-auto mb-2"></div>
                            <button
                                class="btn btn-sm btn-primary mx-auto mb-4 d-flex align-items-center justify-content-center"
                                onclick="startScan()">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="me-2" width="16">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.75 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 3.75 9.375v-4.5ZM3.75 14.625c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5a1.125 1.125 0 0 1-1.125-1.125v-4.5ZM13.5 4.875c0-.621.504-1.125 1.125-1.125h4.5c.621 0 1.125.504 1.125 1.125v4.5c0 .621-.504 1.125-1.125 1.125h-4.5A1.125 1.125 0 0 1 13.5 9.375v-4.5Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M6.75 6.75h.75v.75h-.75v-.75ZM6.75 16.5h.75v.75h-.75v-.75ZM16.5 6.75h.75v.75h-.75v-.75ZM13.5 13.5h.75v.75h-.75v-.75ZM13.5 19.5h.75v.75h-.75v-.75ZM19.5 13.5h.75v.75h-.75v-.75ZM19.5 19.5h.75v.75h-.75v-.75ZM16.5 16.5h.75v.75h-.75v-.75Z" />
                                </svg>

                                Scan QR
                            </button>
                            <form action="{{ route('parking-log.store') }}" method="POST">
                                @csrf
                                <input name="member_id" id="member-id" class="d-none">

                                <div class="mb-3">
                                    <label>Nama Member</label>
                                    <input type="text" class="form-control" id="member-name">
                                </div>

                                <div class="mb-3">
                                    <label>Kendaraan</label>
                                    <select class="form-select" name="vehicle_id" id="vehicle-select" required>
                                        <option value="">-- Pilih kendaraan --</option>
                                    </select>
                                </div>

                                <button
                                    class="btn btn-sm btn-success ms-auto mt-3 d-flex align-items-center justify-content-center"
                                    type="submit">
                                    Log Parkir

                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" width="24" class="ms-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <span>{{ __('Table Parking Log') }}</span>
                        </div>

                        <div class="card-body d-flex gap-3">
                            <table class="table table-hover my-0">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th class="d-none d-md-table-cell">Num. Plat</th>
                                        <th class="d-none d-md-table-cell">Veh. Type</th>
                                        <th>Owner</th>
                                        <th class="d-none d-md-table-cell">Enter at</th>
                                        <th class="d-none d-md-table-cell">Leave at</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="table-body">
                                    @foreach ($logs as $i => $log)
                                        <tr>
                                            <td>{{ $i + 1 }}</td>
                                            <td>{{ $log->vehicle->number_plat }}</td>
                                            <td>{{ ucfirst($log->vehicle->vehicle_type) }}</td>
                                            <td>
                                                {{ $log->vehicle->owner->name ?? '-' }}
                                            </td>
                                            <td>{{ $log->enter_at }}</td>
                                            <td>
                                                @if ($log->leave_at)
                                                    <span
                                                        class="{{ $log->leave_at ? 'badge bg-info' : '' }}">{{ $log->leave_at ? $log->leave_at : '' }}
                                                    </span>
                                                @else
                                                    <form action="{{ route('parking-log.leave', $log->id) }}"
                                                        method="POST" onsubmit="return confirm('Yakin kendaraan keluar?')">
                                                        @csrf
                                                        @method('PUT')
                                                        <button class="btn btn-sm btn-warning" type="submit">
                                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                                width="16">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                @endif
                                            </td>
                                            <td>
                                                <form method="POST" action="{{ route('parking-log.destroy', $log->id) }}"
                                                    onsubmit="return confirm('Yakin ingin menghapus log ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger text-white" type="submit">
                                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                            width="16">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/html5-qrcode/html5-qrcode.min.js') }}"></script>

    <script>
        let html5QrCode;
        const qrRegionId = "reader";

        async function startScan() {
            html5QrCode = new Html5Qrcode(qrRegionId);

            const config = {
                fps: 10,
                qrbox: 250
            };

            try {
                await html5QrCode.start({
                        facingMode: "environment"
                    }, // Kamera belakang
                    config,
                    onScanSuccess,
                    onScanFailure
                );
            } catch (err) {
                console.error("Gagal mengakses kamera:", err);
            }
        }

        async function stopScan() {
            if (html5QrCode && html5QrCode.isScanning) {
                try {
                    await html5QrCode.stop();
                    console.log("Scanner stopped.");
                    html5QrCode.clear(); // Membersihkan tampilan
                } catch (err) {
                    console.warn("Gagal menghentikan scanner:", err);
                }
            } else {
                console.log("Scanner belum berjalan atau sudah berhenti.");
            }
        }

        function onScanSuccess(decodedText, decodedResult) {
            console.log("QR terdeteksi:", decodedText);

            // Hentikan scanner setelah berhasil scan
            stopScan();

            if (decodedText.startsWith("MEMBER_ID:")) {
                const memberId = decodedText.split("MEMBER_ID:")[1];
                console.log("Member ID:", memberId);

                // Fetch ke endpoint Laravel
                fetch(`/api/member-data/${memberId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            alert(data.error);
                            return;
                        }
                        console.log(data);

                        // Isi form
                        document.querySelector('#member-id').value = data.member.id;
                        document.querySelector('#member-name').value = data.member.name;

                        const select = document.querySelector('#vehicle-select');
                        select.innerHTML = ''; // Kosongkan dulu

                        data.vehicles.forEach(vehicle => {
                            const option = document.createElement('option');
                            option.value = vehicle.id;
                            option.textContent = `${vehicle.vehicle_type} - ${vehicle.number_plat}`;
                            select.appendChild(option);
                        });

                    })
                    .catch(err => {
                        console.error('Gagal ambil data member:', err);
                    });

            } else if (decodedText.startsWith("LOG_ID:")) {
                const logId = decodedText.split("LOG_ID:")[1];
                console.log("LOG_ID:", logId);

                fetch(`/api/guest-data/${logId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.error) {
                            alert(data.error);
                            return;
                        }
                        // console.log(data.parking.leave_at);

                        const tBody = document.querySelector('#table-body');
                        tBody.innerHTML = `
                            <tr>
                                <td>${data.parking.id}</td>
                                <td>${data.vehicle.number_plat}</td>
                                <td>${data.vehicle.vehicle_type}</td>
                                <td>${data.guest.name}</td>
                                <td>${data.parking.enter_at}</td>
                                <td>
                                    ${data.parking.leave_at
                                    ? `<span class="badge bg-info">${data.parking.leave_at}</span>`
                                    : `<form action="/parking-log/${logId}/leave" method="POST"
                                            onsubmit="return confirm('Yakin kendaraan keluar?')">
                                            @csrf
                                            @method('PUT')
                                            <button class="btn btn-sm btn-warning" type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                    stroke="currentColor" width="16">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15.75 9V5.25A2.25 2.25 0 0 0 13.5 3h-6a2.25 2.25 0 0 0-2.25 2.25v13.5A2.25 2.25 0 0 0 7.5 21h6a2.25 2.25 0 0 0 2.25-2.25V15m3 0 3-3m0 0-3-3m3 3H9" />
                                                </svg>
                                            </button>
                                        </form>`
                                    }
                                </td>
                                <td>
                                    <form method="POST" action="/parking-log/${logId}"
                                        onsubmit="return confirm('Yakin ingin menghapus log ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger text-white" type="submit">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                                stroke="currentColor" width="16">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        `;

                    })
                    .catch(err => {
                        console.error('Gagal ambil data member:', err);
                    });
            }
        }

        function onScanFailure(error) {
            // Bisa dibiarkan kosong atau tampilkan pesan di console
            console.log("Scan gagal:", error);
        }
    </script>
@endsection
