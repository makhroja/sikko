<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(function() {

        let table = $('#dataTable').DataTable({
            processing: true,
            serverSide: true,
            scrollY: true,
            scrollX: true,
            select: true,
            select: 'single',
            ajax: "{{ route('faktur.index') }}",
            columnDefs: [{
                targets: "_all",
                orderable: false
            }, {
                width: "2%",
                targets: [0]
            }, {
                //buat wrap text
                render: function(data, type, full, meta) {
                    return "<div class='text-wrap width-250'>" + data + "</div>";
                },
                targets: [1]
            }, ],
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'total_bayar',
                    name: 'total_bayar'
                },
                {
                    data: 'metode_pembayaran',
                    name: 'metode_pembayaran'
                },
                {
                    data: 'bukti',
                    name: 'bukti'
                },
                {
                    data: 'tgl_bayar',
                    name: 'tgl_bayar'
                },
                {
                    data: 'status',
                    name: 'status'
                },
                {
                    data: 'actions',
                    name: 'actions',
                    orderable: false,
                    searchable: false
                },
            ],
        });

        // for create
        $('.create').on('click', function() {
            $('#ajaxModel').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
        })

        // for edit
        table.on('click', '.edit', function() {
            let id = $(this).data("id");
            let url = "{{ url('pemilik/faktur', '') }}/" + id + "/edit";

            window.open(url, '_self');
        });

        // for read
        table.on('click', '.show', function() {
            let id = $(this).data("id");
            let url = "{{ url('pemilik/faktur', '') }}/" + id + "/show";

            window.open(url, '_self');
        });

        // for delete
        table.on('click', '.delete', function() {
            let name = $(this).data("name");
            let id = $(this).data("id");

            alertify.confirm("Peringatan", "Anda yakin akan menghapus <b>" + name +
                '</b>',
                function() {
                    $.ajax({
                        url: "{{ route('faktur.index') }}/" + id,
                        type: 'DELETE',
                        dataType: "JSON",
                        data: {
                            "id": id,
                        },
                        success: function(data) {
                            table.draw();
                            alertify.alert().set({
                                'title': 'Success',
                                'message': data.success
                            }).show();
                        },
                        error: function(data) {
                            table.draw();
                            alertify.alert().set({
                                'title': 'Error',
                                'message': data.responseJSON.message
                            }).show();
                        }
                    });
                },
                function() {
                    alertify.error('Cancel')
                });
        });

        table.on('click', '.show-bukti', function() {
            var buktiImage = $(this).data('bukti-image');
            $('#buktiImage').attr('src', buktiImage);
            $('#buktiModal').modal('show');
        });

        /*
         *End Document Ready
         */
    });

    function showBukti(buktiImage) {
        $('#buktiImage').attr('src', buktiImage);
        $('#buktiModal').modal('show');
    }
</script>
