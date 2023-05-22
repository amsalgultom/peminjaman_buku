@extends('layouts.app')
@section('title', 'Peminjaman Buku - Anggota')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Table Anggota</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"><a href="{{ route('members.create') }}">Klik disini</a> untuk membuat data anggota baru</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="members-table" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
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
        $('#members-table').DataTable({
            serverSide: true,
            ajax: "{{ route('members.data') }}",
            columns: [{
                    data: 'id',
                    name: 'id'
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'id',
                    name: 'id',
                    render: function(data) {
                        // <a class="btn btn-info btn-circle btn-lg" href=""><i class="fas fa-info-circle"></i></a>
                        return '<a class="btn btn-info btn-circle btn-lg" href="/admin/members/show/' + data + '"><i class="fas fa-info-circle"></i></a><a href="/admin/members/edit/' + data + '" class="btn btn-warning btn-circle btn-lg"><i class="fas fa-exclamation-triangle"></i></a><a href="javascript:void(0)" data-id="'+data+'" data-toggle="tooltip" data-original-title="Delete" class="delete btn btn-danger btn-circle btn-lg"><i class="fas fa-trash"></i></a>';
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
                    url: "{{ url('admin/members/delete/') }}",
                    data: {
                        id: id,
                        _token: "{{ csrf_token() }}" // Add the CSRF token here
                    },
                    dataType: 'json',
                    success: function(res) {
                        var oTable = $('#members-table').dataTable();
                        oTable.fnDraw(false);
                    }
                });
            }
        });
    });
</script>

@endpush