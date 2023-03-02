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
                    
                    <div class="form-group">
                        <label class="mt-2" for="nama">Outlet</label>
                        <select type="text" name="outlet_id" id="outlet_id" value="{{ old('outlet_id')}}" class="form-control @error('outlet_id') is-invalid @enderror">
                            <option selected>Pilih...</option>
                            @foreach($outlet as $outlet)
                            <option value="{{$outlet->id}}">{{$outlet->nama}}</option>
                            @endforeach
                            @error('outlet_id')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="nama">Kode-Invoice</label>
                        <input type="text" name="kode_invoice" class="form-control" value="{{ $kode_invoice }}" aria-label="Disabled input example" readonly>
                    </div>
                        
                        <div class="form-group">
                            <label class="mt-2" for="nama">Member</label>
                            <select type="text" name="member_id" id="member_id" value="{{ old('member_id')}}" class="form-control @error('member_id') is-invalid @enderror">
                                <option selected>Pilih...</option>
                                @foreach($member as $member)
                                <option value="{{$member->id}}">{{$member->nama}}</option>
                                @endforeach
                                @error('member_id')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                                @enderror
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="mt-2" for="nama">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" id="tanggal">
                        </div>

                        <div class="form-group">
                            <label class="mt-2" for="nama">Batas-Waktu</label>
                            <input type="date" class="form-control" name="batas_waktu" id="batas_waktu">
                        </div>

                        <div class="form-group">
                            <label class="mt-2" for="nama">Tanggal-Bayar</label>
                            <input type="date" class="form-control" name="tanggal_bayar" id="tanggal_bayar">
                        </div>

                        {{-- Add biaya_tambahan --}}
                    <label class="mt-2" for="nama">Biaya-Tambahan</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <b>Rp</b>
                            </div>
                        </div>
                        <input type="text" name="biaya_tambahan" id="biaya_tambahan" value="{{ old('biaya_tambahan')}}" class="form-control currency @error('biaya_tambahan') is-invalid @enderror">
                        @error('biaya_tambahan')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    {{-- Add diskon --}}
                    <label class="mt-2" for="nama">Diskon</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <b>Rp</b>
                            </div>
                        </div>
                        <input type="text" name="diskon" id="diskon" value="{{ old('diskon')}}" class="form-control currency @error('diskon') is-invalid @enderror">
                        @error('diskon')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label class="mt-2" for="nama">Status</label>
                        <select name="status" id="status" value="{{ old('status')}}" class="form-control">
                            <option selected>Pilih...</option>
                            <option value="baru"> Baru</option>
                            <option value="proses"> Sedang-di-Proses</option>
                            <option value="selesai"> Selesai</option>
                            <option value="diambil"> Telah-Diambil</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="mt-2" for="nama">Status-Pembayaran</label>
                        <select name="bayar" id="bayar" value="{{ old('bayar')}}" class="form-control">
                            <option selected>Pilih...</option>
                            <option value="belum_dibayar"> Belum-di-Bayar</option>
                            <option value="sudah_dibayar"> Sudah-di-Bayar</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label class="mt-2" for="nama">User</label>
                        <select type="text" name="user_id" id="user_id" value="{{ old('user_id')}}" class="form-control @error('user_id') is-invalid @enderror">
                            <option selected>Pilih...</option>
                            @foreach($user as $user)
                            <option value="{{$user->id}}">{{$user->nama}}</option>
                            @endforeach
                            @error('user_id')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror
                        </select>
                    </div>

                    
                    <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn btn-success btn-flat">Simpan</button>
                    </div>
                </form>

            </div>
        </div>

    </div>

</div>