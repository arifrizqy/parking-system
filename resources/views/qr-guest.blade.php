@extends('layouts.app')

@section('content')
    <div class="container text-center">
        <h2 class="mb-3">QR Code untuk Tamu</h2>

        {!! $qrCode !!}

        <p class="mt-3">
            <strong>Plat Nomor:</strong> {{ $log->vehicle->number_plat }}<br>
            <strong>Jenis Kendaraan:</strong> {{ ucfirst($log->vehicle->vehicle_type) }}<br>
            <strong>Nama Tamu:</strong> {{ $log->vehicle->owner->name }}
        </p>

        <a href="{{ route('guests') }}" class="btn btn-secondary mt-4">Kembali</a>
    </div>
@endsection
