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
       
                    {{-- Add benda --}}
                    <label class="mt-2" for="nama">Nama-Benda</label>
                    <select type="text" name="benda_id" id="benda_id" value="{{ old('benda_id')}}" class="form-control @error('benda_id') is-invalid @enderror">
                        <option selected>Pilih...</option>
                        @foreach($benda as $benda)
                            <option value="{{$benda->id}}">{{$benda->nama}}</option>
                        @endforeach
                    @error('benda_id')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    </select>

                    {{-- Add jenis_paket --}}
                    <label class="mt-2" for="nama">Jenis-Paket</label>
                    <select type="text" name="jenis_paket_id" id="jenis_paket_id" value="{{ old('jenis_paket_id')}}" class="form-control @error('jenis_paket_id') is-invalid @enderror">
                        <option selected>Pilih...</option>
                        @foreach($jenis_paket as $jenis_paket)
                            <option value="{{$jenis_paket->id}}">{{$jenis_paket->nama}}</option>
                        @endforeach
                    @error('jenis_paket_id')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    </select>

                    {{-- Add layanan --}}
                    <label class="mt-2" for="nama">Jenis-Layanan</label>
                    <select type="text" name="layanan_id" id="layanan_id" value="{{ old('layanan_id')}}" class="form-control @error('layanan_id') is-invalid @enderror">
                        <option selected>Pilih...</option>
                        @foreach($layanan as $layanan)
                            <option value="{{$layanan->id}}">{{$layanan->nama}}</option>
                        @endforeach
                    @error('layanan_id')
                        <div class="text-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    </select>

                   {{-- Add berat --}}
                   <label class="mt-2" for="nama">Satuan-Berat</label>
                   <select type="text" name="berat_id" id="berat_id" value="{{ old('berat_id')}}" class="form-control @error('berat_id') is-invalid @enderror">
                       <option selected>Pilih...</option>
                       @foreach($berat as $berat)
                           <option value="{{$berat->id}}">{{$berat->nama}}</option>
                       @endforeach
                   @error('berat_id')
                       <div class="text-danger">
                           {{ $message }}
                       </div>
                   @enderror
                   </select>

                    {{-- Add Harga --}}
                    <label class="mb-2" for="nama">Harga</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <b>Rp</b>
                            </div>
                        </div>
                        <input type="text" name="harga" id="harga" value="{{ old('harga')}}" class="form-control currency @error('harga') is-invalid @enderror">
                        @error('harga')
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