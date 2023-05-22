@extends('layouts.app')
@section('title', 'Peminjaman Buku - Buku')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Table Buku</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><a href="{{ route('books.create') }}">Klik disini</a> untuk membuat data buku baru</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="book-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Kode Buku</th>
                            <th>Judul</th>
                            <th>Stok</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Kode Buku</th>
                            <th>Judul</th>
                            <th>Stok</th>
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
        $('#book-table').DataTable({
            serverSide: true,
            ajax: "{{ route('book.data') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'kode',
                    name: 'kode'
                },
                {
                    data: 'judul',
                    name: 'judul'
                },
                {
                    data: 'stok',
                    name: 'stok'
                },
                {
                    data: 'id',
                    name: 'id',
                    render: function(data) {
                        // <a class="btn btn-info btn-circle btn-lg" href=""><i class="fas fa-info-circle"></i></a>
                        return '<a class="btn btn-info btn-circle btn-lg" href="/admin/books/show/' + data + '"><i class="fas fa-info-circle"></i></a><a href="/admin/books/edit/' + data + '" class="btn btn-warning btn-circle btn-lg"><i class="fas fa-exclamation-triangle"></i></a><a href="javascript:void(0)" data-id="'+data+'" data-toggle="tooltip" data-original-title="Delete" class="delete btn btn-danger btn-circle btn-lg"><i class="fas fa-trash"></i></a>';
                    }
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
                        var oTable = $('#book-table').dataTable();
                        oTable.fnDraw(false);
                    }
                });
            }
        });
    });
</script>

@endpush