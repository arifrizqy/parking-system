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
                                                <span
                                                    class="{{ $log->leave_at ?? 'badge bg-warning' }}">{{ $log->leave_at ?? 'Belum keluar' }}
                                                </span>
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
