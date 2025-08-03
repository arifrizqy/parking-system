@extends('layouts.app')

@section('content')
    <div class="d-flex">
        @include('layouts.sidebar')

        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">{{ __('Input Parking Log') }}</div>

                        <div class="card-body">
                            <form action="#" class=" d-flex flex-column">

                                <button class="btn btn-primary mt-3 d-flex align-items-center justify-content-center"
                                    type="submit">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" width="24" class="me-2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.27 20.875L5.999 12Zm0 0h7.5" />
                                    </svg>

                                    Save
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
                                <tbody>
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
                                                    <form action="{{ route('parking-log.leave', $log->id) }}" method="POST"
                                                        onsubmit="return confirm('Yakin kendaraan keluar?')">
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
@endsection
