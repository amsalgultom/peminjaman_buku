@extends('layouts.app')
@section('title', 'Peminjaman Buku - Request Peminjaman')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Table Request Peminjaman</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="loan-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Judul</th>
                            <th>User</th>
                            <th>Tgl Peminjaman</th>
                            <th>Tgl Pengembalian</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Judul</th>
                            <th>User</th>
                            <th>Tgl Peminjaman</th>
                            <th>Tgl Pengembalian</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

<!-- End of Main Content -->
@endsection

@push('scripts')

<script type="text/javascript">
    $(document).ready(function() {
        $('#loan-table').DataTable({
            serverSide: true,
            ajax: "{{ route('getrequestloan.data') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: "book.judul",
                    name: 'book.judul'
                },
                {
                    data: 'user.name',
                    name: 'user.name'
                },
                {
                    data: 'loan_date',
                    name: 'loan_date'
                },
                {
                    data: 'return_date',
                    name: 'return_date'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'id',
                    name: 'id',
                    render: function(data) {
                        // <a class="btn btn-info btn-circle btn-lg" href=""><i class="fas fa-info-circle"></i></a>
                        return '<a href="javascript:void(0)" data-id="'+data+'" data-toggle="tooltip" data-original-title="Approve" class="approve btn btn-success btn-icon-split"><span class="icon text-white-50"><i class="fas fa-check"></i></span><span class="text">Approve</span></a><br><a <a href="javascript:void(0)" data-id="'+data+'" data-toggle="tooltip" data-original-title="Approve" class="reject btn btn-danger btn-icon-split mt-2"><span class="icon text-white-50"><i class="fa fa-times"></i></span><span class="text">Reject</span></a>';
                    }
                }
            ]
        });
        $('body').on('click', '.approve', function() {
            var id = $(this).data('id');
            console.log(id)
            if (confirm("Aprrove permintaan peminjaman ID = " +id+ " ?") == true) {
                // ajax
                $.ajax({
                    type: "POST",
                    url: "{{ route('getrequestloan.approve') }}",
                    data: {
                        id: id,
                        _token: "{{ csrf_token() }}" // Add the CSRF token here
                    },
                    dataType: 'json',
                    success: function(res) {
                        var oTable = $('#loan-table').dataTable();
                        oTable.fnDraw(false);
                    }
                });
            }
        });
        $('body').on('click', '.reject', function() {
            var id = $(this).data('id');
            console.log(id)
            if (confirm("Reject permintaan peminjaman ID = " +id+ " ?") == true) {
                // ajax
                $.ajax({
                    type: "POST",
                    url: "{{ route('getrequestloan.reject') }}",
                    data: {
                        id: id,
                        _token: "{{ csrf_token() }}" // Add the CSRF token here
                    },
                    dataType: 'json',
                    success: function(res) {
                        var oTable = $('#loan-table').dataTable();
                        oTable.fnDraw(false);
                    }
                });
            }
        });
    });
</script>

@endpush