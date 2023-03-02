<div class="modal fade " id="modalForm" style="display: none; padding-right: 17px;" aria-modal="true" role="dialog" 
data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog-centered modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Large Modal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                
                <form action="" method="post">
                    @csrf
                    @method('PUT')

                    {{-- Add transaksi --}}
                    <label class="mt-2" for="nama">Transaksi</label>
                    <select type="text" name="transaksi_id" id="transaksi_id" value="{{ old('transaksi_id')}}" class="form-control @error('transaksi_id') is-invalid @enderror">
                        <option selected>Pilih...</option>
                        @foreach($transaksi as $transaksi)
                            <option value="{{$transaksi->id}}">{{$transaksi->nama}}</option>
                        @endforeach
                    @error('transaksi_id')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    </select>

                    {{-- Add paket --}}
                    <label class="mt-2" for="nama">Nama-Paket</label>
                    <select type="text" name="paket_id" id="paket_id" value="{{ old('paket_id')}}" class="form-control @error('paket_id') is-invalid @enderror">
                        <option selected>Pilih...</option>
                        @foreach($paket as $paket)
                            <option value="{{$paket->id}}">{{$paket->nama}}</option>
                        @endforeach
                    @error('paket_id')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    </select>


                    {{-- Add qty --}}
                    <div class="mt-4 mb-4">
                        <label class="mb-2" for="nama">qty</label>
                        <input type="number" name="qty" id="qty" value="{{ old('qty')}}" class="form-control @error('qty') is-invalid @enderror">
                        @error('qty')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    
                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn btn-success btn-flat">Simpan</button>
                    </div>
                </form>

            </div>
        </div>

    </div>

</div>