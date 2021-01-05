@extends('layouts.admin')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $title }}</h1>

    @if (session('success'))
    <div class="alert alert-success border-left-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="row">
        <div class="col">
            <table class="table">
                <thead>
                    <tr>
                        <th>Kode Pembayaran</th>
                        <th>Projek</th>
                        <th>Harga</th>
                        <th>Tanggal Beli</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $d)
                    <tr>
                        <td scope="row">{{ $d->payment_code }}</td>
                        <td><a target="_blank" href="{{ route('project.detail', $d->project->id) }}">{{ $d->project->name }}</a></td>
                        <td>Rp{{ number_format($d->project->price, 0, ',', '.') }}</td>
                        <td>{{ $d->created_at->format('D, d F Y - H:i') }}</td>
                        <td>
                            @if($d->is_paid == 0)
                            <form action="{{ route('kantong.destroy', $d->id) }}" method="post"> @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" href="#" role="button" type="submit" onclick="return confirm('Anda yakin ingin membatalkan ini?')"><i class="fa fa-trash" aria-hidden="true"></i> Batal</button>
                            </form>
                            @else
                            Sudah Dibayar
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
