@extends('app')
@section('content')
  <div class="container">
    <div class="text-center mb-5">
      <h5 class="text-center my-3">Tambah Data Keluarga</h5>
      <a href="{{ route('families.index') }}" class="btn btn-danger btn-sm">
        <i class="fa-solid fa-chevron-left fa-sm me-1"></i>
        Kembali
      </a>
    </div>

    <form action="{{ route('families.store') }}" method="POST">
      @csrf

      <div class="row justify-content-center">
        <div class="col-md-6">
  
          <div class="mb-4">
            <label for="name">Nama</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
            @error('name')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
  
          <div class="mb-4">
            <label for="gender">Jenis Kelamin</label>
            <select name="gender" id="gender" class="form-control @error('gender') is-invalid @enderror" required>
              <option value="Male" {{ old('gender') === 'Male' ? 'selected' : '' }}>Laki-laki</option>
              <option value="Female" {{ old('gender') === 'Female' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('gender')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
  
          <div class="mb-4">
            <label for="parent_id">Pilih Orang Tua</label>
            <select class="form-select" id="parent_id" name="parent_id" data-placeholder="Pilih Orang Tua" style="width: 100%;">
              <option></option>
              @foreach ($families as $item)
                @if (old('parent_id') == $item->id)
                  <option value="{{ $item->id }}" selected>{{ $item->name }}</option>
                @else
                  <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endif
              @endforeach
            </select>
            <span>
              <small class="text-muted">Kosongkan jika tidak ingin memilih (Misal menambahkan Kakek/Nenek)</small>
            </span>
            @error('parent_id')
              <div class="invalid-feedback">{{ $message }}</div>
            @enderror
          </div>
  
          <div class="mb-4">
            <button type="submit" class="btn btn-primary">Simpan Data Baru</button>
          </div>
  
        </div>
      </div>

    </form>

  </div>
@endsection
@push('js')
  <script>
    $('#parent_id' ).select2( {
        theme: "bootstrap-5",
        width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
        placeholder: $( this ).data( 'placeholder' ),
        allowClear: true
    });
  </script>
@endpush