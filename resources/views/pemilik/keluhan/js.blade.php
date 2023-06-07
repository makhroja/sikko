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
            ajax: "{{ route('keluhan.index') }}",
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
                targets: [1,6]
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
                    data: 'kamar',
                    name: 'kamar'
                },
                {
                    data: 'tgl_keluhan',
                    name: 'tgl_keluhan'
                },
                {
                    data: 'keluhan',
                    name: 'keluhan'
                },
                {
                    data: 'tgl_tanggapan',
                    name: 'tgl_tanggapan'
                },
                {
                    data: 'solusi',
                    name: 'solusi'
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
            let url = "{{ url('pemilik/keluhan', '') }}/" + id + "/edit";

            window.open(url, '_self');
        });

        // for read
        table.on('click', '.show', function() {
            let id = $(this).data("id");
            let url = "{{ url('pemilik/keluhan', '') }}/" + id + "/show";

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
                        url: "{{ route('keluhan.index') }}/" + id,
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

        /*
         *End Document Ready
         */
    });
</script>
