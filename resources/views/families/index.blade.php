@extends('app')
@section('content')

<div class="container">
  <h5 class="text-center my-5">Family List</h5>

  <div class="mb-3">
    <a href="{{ route('families.create') }}" class="btn btn-primary btn-sm">
      <i class="fa-solid fa-plus me-1"></i>
      Tambah Data
    </a>
  </div>

  <div class="my-3">
    {{ $dataTable->table() }}
  </div>

  <div class="my-3 mb-5">
    <h5 class="text-center">Visualisasi Tampilan Tree View Keluarga</h5>

    <div class="my-3 mb-3">
      <div class="text-center text-white">
        @forelse ($families as $parent)
          <div class="row">
            <div class="col">
              <div class="card mb-2">
                <div class="card-body {{ $parent->gender == 'Male' ? 'bg-primary' : 'bg-danger' }}">{{ $parent->name }}</div>
              </div>

              <div class="row">
                {{-- Children --}}
                @foreach ($parent->children as $child)
                  <div class="col">
                    <div class="card mb-2">
                      <div class="card-body {{ $child->gender == 'Male' ? 'bg-primary' : 'bg-danger' }}">{{ $child->name }}</div>
                    </div>

                    <div class="row">
                      {{-- Grandchild --}}
                      @if ($child->children->count() > 0)
                        @foreach($child->children as $grandchild)
                        <div class="col">
                          <div class="card mb-2">
                            <div class="card-body {{ $grandchild->gender == 'Male' ? 'bg-primary' : 'bg-danger' }}">{{ $grandchild->name }}</div>
                          </div>
                        </div>
                        @endforeach
                      @endif
                      {{-- Grandchild --}}
                    </div>

                  </div>
                @endforeach
                {{-- Children --}}
              </div>
              
            </div>
          </div>
        @empty
          <div class="row">
            <div class="card">
              <div class="card-body text-dark">
                Data Keluarga Kosong atau Belum Ditambahkan
              </div>
            </div>
          </div>
        @endforelse
      </div>
    </div>

    <div class="mb-5">
      <h6><strong>NOTE :</strong></h6>
      <p class="text-primary mb-0">Biru Untuk Jenis Kelamin Laki - Laki</p>
      <p class="text-danger">Merah Untuk Jenis Kelamin Perempuan</p>
    </div>

    <ul>
      @foreach ($families as $person)
        <li>
          {{ $person->name }} ({{ $person->gender }})
          @if ($person->children->count() > 0)
            <ul>
              @foreach ($person->children as $child)
                <li>
                  {{ $child->name }} ({{ $child->gender }})
                  @if ($child->children->count() > 0)
                    <ul>
                      @foreach ($child->children as $grandchild)
                        <li>
                          {{ $grandchild->name }} ({{ $grandchild->gender }})
                        </li>
                      @endforeach
                    </ul>
                  @endif
                </li>
              @endforeach
            </ul>
          @endif
        </li>
      @endforeach
    </ul>
  </div>

</div>
@endsection
@push('js')
  {{ $dataTable->scripts() }}

  <script>
    let table

    $(() => {
      table = $('.table').DataTable()
    })

    function deleteFamily(url) {
      Swal.fire({
        icon: "warning",
        title: "Apakah Anda Yakin?",
        html: "Dengan menekan tombol hapus, Maka <b>Semua Data</b> akan hilang!",
        showCancelButton: true,
        confirmButtonText: "Hapus Data",
        cancelButtonText: "Batalkan",
        cancelButtonColor: "#E74C3C",
        confirmButtonColor: "#3498DB",
        }).then((result) => {
          if (result.value) {
              $.post(url, {
                _token: $("[name=csrf-token]").attr("content"),
                _method: "delete",
              })
                .done((response) => {
                  Swal.fire({
                    icon: "success",
                    title: response.message,
                    confirmButtonText: "Selesai",
                  });
                  table.ajax.reload();
                })
                .fail((errors) => {
                  Swal.fire({
                    icon: "error",
                    title: errors.responseJSON.message,
                    confirmButtonText: "Mengerti",
                  });
                  return;
                });
          } else if (result.dismiss == swal.DismissReason.cancel) {
            Swal.fire({
              icon: "error",
              title: "Tidak ada perubahan disimpan",
              confirmButtonText: "Mengerti",
              confirmButtonColor: "#3498DB",
            });
          }
        });
    }
  </script>
@endpush