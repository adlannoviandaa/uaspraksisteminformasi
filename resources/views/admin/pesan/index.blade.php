@extends('layouts.admin')

@section('content')

<div class="content-header">
    <h4 class="mb-3">Pesan Masuk</h4>
</div>

<div class="row">

    <div class="col-md-12">
        <div class="card shadow-sm">

            <div class="card-header">
                <h5 class="card-title">Daftar Pesan</h5>
            </div>

            <div class="card-body p-0">

                <ul class="list-group">

                    @forelse($conversations as $item)
                        <a href="{{ route('admin.pesan.show', $item->id) }}" 
                           class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">

                            <div>
                                <strong>{{ $item->nama }}</strong><br>
                                <span class="text-muted">{{ Str::limit($item->isi, 45) }}</span>
                            </div>

                            <span class="badge 
                                @if($item->status == 'new') bg-danger
                                @elseif($item->status == 'awaiting_reply') bg-warning
                                @else bg-secondary @endif">
                                {{ strtoupper($item->status) }}
                            </span>
                        </a>

                    @empty
                        <li class="list-group-item text-center text-muted">Belum ada pesan</li>
                    @endforelse

                </ul>

            </div>
        </div>
    </div>

</div>

@endsection
