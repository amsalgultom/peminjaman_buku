@extends('layouts.app')
@section('title', 'Peminjaman Buku - Peminjaman')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Table Peminjaman</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><a href="{{ route('loans.create') }}">Klik disini</a> untuk membuat peminjaman buku baru</h6>
        </div>
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
            ajax: "{{ route('loans.data',Auth::user()->id) }}",
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
                }
            ]
        });
        $('body').on('click', '.delete', function() {
            if (confirm("Hapus data buku ini?") == true) {
                var id = $(this).data('id');
                console.log(id)
                // ajax
                $.ajax({
                    type: "POST",
                    url: "{{ url('admin/book/delete/') }}",
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