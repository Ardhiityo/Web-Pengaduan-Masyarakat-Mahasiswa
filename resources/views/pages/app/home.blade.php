@extends('layouts.app')

@section('title', 'Home')

@section('content')
    @auth
        <h6 class="greeting">Hi, {{ Auth::user()->name }} 👋</h6>
    @else
        <h6 class="greeting">Hi, Sahabat MaFIK 👋</h6>
    @endauth
    <h4 class="home-headline">Laporkan masalahmu dan kami segera atasi itu</h4>

    <div class="gap-4 py-3 overflow-auto d-flex align-items-center justify-content-between" id="category"
        style="white-space: nowrap;">
        @foreach ($reportCategories as $reportCategory)
            <a href="{{ route('report.index', ['category' => $reportCategory->name]) }}" class="category d-inline-block">
                <div class="icon">
                    <img src="{{ asset('storage/' . $reportCategory->image) }}" alt="icon">
                </div>
                <p>{{ $reportCategory->name }}</p>
            </a>
        @endforeach
    </div>

    <div class="py-3" id="reports">
        <div class="d-flex justify-content-between align-items-center">
            <h6>Pengaduan terbaru</h6>
            <a href="{{ route('report.index') }}" class="text-primary text-decoration-none show-more">
                Lihat semua
            </a>
        </div>

        <div class="gap-3 mt-3 d-flex flex-column">
            @foreach ($latestReports as $report)
                <div class="border-0 shadow-none card card-report">
                    <a href="{{ route('report.code', $report->code) }}" class="text-decoration-none text-dark">
                        <div class="p-0 card-body">
                            <div class="mb-2 card-report-image position-relative">
                                <img src="{{ asset('storage/' . $report->image) }}" alt="image">

                                @if (isset($report->reportStatuses->last()->status))
                                    <div
                                        class="{{ $report->reportStatuses->last()->status === 'completed' ? 'badge-status done' : 'badge-status on-process' }}">
                                        @if ($report->reportStatuses->last()->status === 'delivered')
                                            Diterima
                                        @endif
                                        @if ($report->reportStatuses->last()->status === 'in_process')
                                            Diproses
                                        @endif
                                        @if ($report->reportStatuses->last()->status === 'completed')
                                            Selesai
                                        @endif
                                        @if ($report->reportStatuses->last()->status === 'rejected')
                                            Ditolak
                                        @endif
                                    </div>
                                @else
                                    <div class="badge-status on-process">
                                        Belum diterima
                                    </div>
                                @endif

                            </div>

                            <div class="mb-2 d-flex justify-content-between align-items-end">
                                <div class="d-flex align-items-center ">
                                    <img src="{{ asset('assets/app/images/icons/MapPin.png') }}" alt="map pin"
                                        class="icon me-2">
                                    <p class="text-primary city">
                                        {{ \Illuminate\Support\Str::words($report->address, 2, '...') }}
                                    </p>
                                </div>

                                <p class="text-secondary date">
                                    Pada {{ \Illuminate\Support\Str::words($report->created_at, 3, '...') }}
                                </p>
                            </div>

                            <h1 class="card-title">
                                {{ \Illuminate\Support\Str::words($report->title, 2, '...') }}
                            </h1>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
