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
            ajax: "{{ route('penghuni.tagihan') }}",
            columnDefs: [{
                targets: "_all",
                orderable: false
            }, {
                width: "2%",
                targets: [0,7]
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
                    data: 'no_tagihan',
                    name: 'no_tagihan'
                },
                {
                    data: 'tgl_tagihan',
                    name: 'tgl_tagihan'
                },
                {
                    data: 'bulan',
                    name: 'bulan'
                },
                {
                    data: 'tahun',
                    name: 'tahun'
                },
                {
                    data: 'total_tagihan',
                    name: 'total_tagihan'
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

        // for edit
        table.on('click', '.bayar-tagihan', function() {
            let id = $(this).data("id");
            let total_tagihan = $(this).data("total_tagihan");
            $('#tagihan_id').val(id);
            $('#total_bayar').val(total_tagihan);
            $('#ajaxModel').modal({
                backdrop: 'static',
                keyboard: false,
                show: true
            });
        });

        /*
         *End Document Ready
         */
    });
</script>
