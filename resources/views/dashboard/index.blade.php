@extends('layouts.main')

@section('content')

<div class="container-scroller">

    @include('layouts.navbar')

    <main>
        <!-- Container START -->
        <div class="container">
            <div class="row g-4">
                @if (Auth::user()->role == 'operator')
                @include('operator.dashboard')
                @elseif (Auth::user()->role == 'mahasiswa')
                @include('operator.dashboard')
                @elseif (Auth::user()->role == 'dosen')
                @include('dosen.dashboard')
                @else
                @include('depaertemen.dashboard')
                @endif
            </div> <!-- Row END -->
        </div>
        <!-- Container END -->
    </main>

</div>

@endsection