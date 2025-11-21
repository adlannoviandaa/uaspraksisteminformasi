@extends('admin.layouts.app')

@section('content')

<div class="content-header">
    <h4 class="mb-3">Detail Pesan</h4>
</div>

<div class="row">

    <!-- SIDEBAR LIST PESAN -->
    <div class="col-md-4">

        <div class="card shadow-sm">
            <div class="card-header">
                <strong>Pesan Masuk</strong>
            </div>

            <div class="card-body p-0">

                <ul class="list-group">

                    @foreach($allMessages as $msg)
                    <a href="{{ route('admin.pesan.show', $msg->id) }}"
                       class="list-group-item list-group-item-action 
                        @if($msg->id == $pesan->id) active @endif">

                        <strong>{{ $msg->nama }}</strong><br>
                        <span class="text-light">{{ Str::limit($msg->isi, 35) }}</span>
                    </a>
                    @endforeach

                </ul>

            </div>
        </div>
    </div>

    <!-- ISI PESAN -->
    <div class="col-md-8">

        <div class="card shadow-sm">
            <div class="card-header">
                <h5 class="mb-0">Pesan dari: {{ $pesan->nama }}</h5>
                <small class="text-muted">{{ $pesan->email }}</small>
            </div>

            <div class="card-body">

                <!-- Pesan User -->
                <div class="alert alert-secondary">
                    <strong>Pesan:</strong><br>
                    {{ $pesan->isi }}
                </div>

                <!-- Balasan Admin -->
                @if ($pesan->balasan_admin)
                    <div class="alert alert-success">
                        <strong>Balasan Admin:</strong><br>
                        {{ $pesan->balasan_admin }}
                    </div>
                @else
                    <form action="{{ route('admin.pesan.reply', $pesan->id) }}" method="POST">
                        @csrf
                        <label class="mb-1">Balas Pesan</label>
                        <textarea class="form-control mb-3" name="balasan_admin" rows="4" required></textarea>

                        <button class="btn btn-primary">Kirim Balasan</button>
                    </form>
                @endif

            </div>
        </div>
    </div>

</div>

@endsection
