{{-- ... di dalam blok @if(Auth::user()->role === 'dosen') ... --}}

    <a href="{{ route('dosen.dashboard') }}">Dashboard</a>
    <a href="{{ route('dosen.review.index') }}">Review Judul ({{ $judulMenunggu ?? '?' }})</a>
    <a href="{{ route('dosen.bimbingan.index') }}">Daftar Bimbingan</a>

{{-- ... --}}
