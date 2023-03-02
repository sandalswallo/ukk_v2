@extends('layouts.app')

@section('title')
    Transaksi
@endsection

@section('content')
<section class="section">
    <div class="section-header">
        <h1>Data Transaksi</h1>
    </div>

    <div class="section-body">
        <div class="row">

            {{-- Data Transaksi --}}
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    {{-- Judul --}}
                    <div class="card-header">
                        <div class="col-12 col-md-10 col-lg-10">
                            <h4>Data Transaksi</h4>
                        </div>
                        <div class="col-12 col-md-2 col-lg-2">
                            <button type="button" onclick="addForm('{{ route('transaksi.store') }}')" class="btn btn-primary shadow-sm rounded-pill">
                                    <i class="fa fa-plus"></i> Tambah
                            </button>
                        </div>
                    </div>

                    {{-- Tabel --}}
                    <div class="card-body" style="width: auto;">
                        <table class="table table-striped text-nowrap">
                            <thead>
                                <tr>
                                    <td scope="col" style="width: auto;">No</td>
                                    <td scope="col">Nama Outlet</td>
                                    <td scope="col">Kode-Invoice</td>
                                    <td scope="col">Member</td>                                   
                                    <td scope="col">Tanggal</td>                                   
                                    <td scope="col">Batas-Waktu</td>                                   
                                    <td scope="col">Tanggal-Bayar</td>                                   
                                    <td scope="col">Biaya-Tambahan</td>                                   
                                    <td scope="col">Diskon</td>                                   
                                    <td scope="col">Status</td>                                   
                                    <td scope="col">Bayar</td>                                   
                                    <td scope="col">User</td>                                   
                                    <td scope="col" style="width: auto;">Aksi</td>
                                </tr>
                            </thead>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</section>

@include('transaksi.form')

@endsection

@push('script')
    <script>

        $('body').addClass('sidebar-mini')
        // Data Tables
        let table;

        $(function() {
            table = $('.table').DataTable({
                proccesing: true,
                autowidth: false,
                ajax: {
                    url: '{{ route('transaksi.data') }}'
                },
                columns: [
                    {data: 'DT_RowIndex'},
                    {data: 'outlet_id'},
                    {data: 'kode_invoice'},
                    {data: 'member_id'},
                    {data: 'tanggal'},
                    {data: 'tanggal_bayar'},
                    {data: 'batas_waktu'},
                    {data: 'biaya_tambahan'},
                    {data: 'diskon'},
                    {data: 'status'},
                    {data: 'bayar'},
                    {data: 'user_id'},
                    {data: 'aksi'}
                ]
            });
        })

        $('#modalForm').on('submit', function(e){
            if(! e.preventDefault()){
                $.post($('#modalForm form').attr('action'), $('#modalForm form').serialize())
                .done((response) => {
                    $('#modalForm').modal('hide');
                    table.ajax.reload();
                    iziToast.success({
                        title: 'Sukses',
                        message: 'Data berhasil disimpan',
                        position: 'topRight'
                    })
                })
                .fail((errors) => {
                    iziToast.error({
                        title: 'Gagal',
                        message: 'Data gagal disimpan',
                        position: 'topRight'
                    })
                    return;
                })
            }
        })

        function addForm(url){
            $('#modalForm').modal('show');
            $('#modalForm .modal-title').text('Tambah Data Transaksi');
            $('#modalForm form')[0].reset();

            $('#modalForm form').attr('action', url);
            $('#modalForm [name=_method]').val('post');
        }

        function editData(url){
            $('#modalForm').modal('show');
            $('#modalForm .modal-title').text('Edit Data Transaksi');
            
            $('#modalForm form')[0].reset();
            $('#modalForm form').attr('action', url);
            $('#modalForm [name=_method]').val('put');
            $.get (url)
                .done((response) => {
                    $('#modalForm [name=outlet_id]').val(response.outlet_id);
                    $('#modalForm [name=kode_invoice]').val(response.kode_invoice);
                    $('#modalForm [name=member_id]').val(response.member_id);
                    $('#modalForm [name=tanggal]').val(response.tanggal);
                    $('#modalForm [name=batas_waktu]').val(response.batas_waktu);
                    $('#modalForm [name=tanggal_bayar]').val(response.tanggal_bayar);
                    $('#modalForm [name=biaya_tambahan]').val(response.biaya_tambahan);
                    $('#modalForm [name=diskon]').val(response.diskon);
                    $('#modalForm [name=status]').val(response.status);
                    $('#modalForm [name=bayar]').val(response.bayar);
                    $('#modalForm [name=user_id]').val(response.user_id);
                    // console.log(response.nama);
                })
                .fail((errors) => {
                    alert('Tidak Dapat Menampilkan Data');
                    return;
                })
        }

        function deleteData(url){
            swal({
                title: "Apa anda yakin menghapus data ini?",
                text: "Jika anda klik OK, maka data akan terhapus",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    $.post(url, {
                    '_token' : $('[name=csrf-token]').attr('content'),
                    '_method' : 'delete'
                })
                .done((response) => {
                    swal({
                    title: "Sukses",
                    text: "Data berhasil dihapus!",
                    icon: "success",
                    });
                })
                .fail((errors) => {
                    swal({
                    title: "Gagal",
                    text: "Data gagal dihapus!",
                    icon: "error",
                    });
                })
                table.ajax.reload();
                }
            });

        }
    </script>
@endpush