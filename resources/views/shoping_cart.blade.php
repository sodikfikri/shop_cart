@extends('template.main')
@section('title', 'Shoping Cart')
@section('content')
<div class="text-center m-3">
    <h1>Troli Anda</h1>
</div>
<div class="table-responsive" style="margin-top: 5rem">
    <table class="table" id="dataTable" width="100%" cellspacing="0">
        <thead>
            <tr>
                <th>PRODUK</th>
                <th>PILIHAN HARGA</th>
                <th>KUANTITAS</th>
                <th>SUBTOTAL</th>
                <th>HAPUS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $val)
            <tr id="{{ $val->code }}">
                <td>
                    <div class="row">
                        <div class="col-2">
                            <img src="{{ asset('assets/images/bj1.png') }}" alt="" style="height: 50px;">
                        </div>
                        <div class="col-6">
                            <span style="color: cadetblue; font-weight: bold">{{ $val->name }}</span><br>
                            <span style="color: grey; font-size: 14px; font-weight: bold">{{ $val->code }}</span>
                        </div>
                    </div>
                </td>
                <td>Rp. {{ number_format($val->price) }}</td>
                <td>
                    <span id="e-qty" style="cursor: pointer" data-id="{{ $val->id }}">
                        {{ $val->quantity }}
                    </span>
                </td>
                <td id="total-price">Rp. {{ number_format($val->total_price) }}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm waves-effect" id="delete" data-id="{{ $val->id }}"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div style="float: right; margin-right: 10rem">
        <span style="font-weight: bold; color: forestgreen; cursor: pointer;" data-bs-toggle="modal" data-bs-target="#modal-discount" id="">Gunakan Kode Diskon/Reward <span id="code-reward"></span> </span>
        {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Launch demo modal
          </button> --}}
    </div>
    <br>
    <hr>
    <div style="float: right; margin-right: 10rem">
        <span style="margin-right: 5rem; font-weight: bold">TOTAL</span>
        <span id="grand-price"></span>
    </div>
    
    <div class="modal fade" id="modal-qty" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah KUANTITAS</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="">
                    <div class="mb-3">
                        <input type="hidden" id="id-hide" value="">
                        <input type="number" class="form-control" id="form-qty">
                    </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="btn-update-qty">Update</button>
            </div>
          </div>
        </div>
      </div>
    <div class="modal fade" id="modal-discount" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Kode Diskon</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="">
                    <div class="mb-3">
                        {{-- <input type="number" class="form-control" id="code-discount"> --}}
                        <select class="form-control" id="code-discount">
                            <option value="" selected>Pilih Kode Diskon</option>
                        </select>
                    </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary" id="btn-save-discount">Update</button>
            </div>
          </div>
        </div>
      </div>
</div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="{{ asset('assets/js/shop.js') }}"></script>
@endsection