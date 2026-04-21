<script>

    //$(function() {

        datatable = @json($datatables);
        myColumns = [];

        myColumns.push({data: 'record_select', name: 'record_select', searchable: false, sortable: false, width: '5%'});
        $.each(datatable.columns, (key, value) => myColumns.push({data: key, name: value, sortable: true, width: key == 'email' ? '20%' : ""}));
        myColumns.push({data: 'created_at', name: 'created_at', searchable: false});
        myColumns.push({data: 'actions', name: 'actions', searchable: false, sortable: false, width: '10%'});
        
        @php($lang = in_array(app()->getLocale(), ['ar', 'en']) ? app()->getLocale() : 'en')

        var Table = $('#data-table').DataTable({
            dom: '<"flex items-center justify-between"f l>rt<"flex items-center justify-between py-4"p i>',            pageLength: 4,
            sScrollX: "100%",
            scrollCollapse: true,
            serverSide: true,
            processing: true,
            //language: {url: "{{ asset('admin_assets/js/datatables/lanPg/' . $lang . '.json') }}"},
            ajax: {
                url: datatable.route,
                data: function (d) {
                    d.status = $('#select-status').val();
                    //d.standard = $('#select-standards').val();
                    d.organization_type = $('#select-organization-type').val();
                }
            },
            columns: myColumns,
            createdRow: (row, data, dataIndex) => {$(row).attr('data-id', data.id)},
            drawCallback: function (settings) {
                $('.record__select').prop('checked', false);
                $('#record__select-all').prop('checked', false);
                $('#record-ids').val();
                $('#bulk-delete').attr('disabled', true);
            },
            rowCallback : function(row, data, index) {
                $(row).css('cursor', 'pointer');
            }
        });

        $('#data-table-search').keyup(function () {
            Table.search(this.value).draw();
        });

        $('#select-status').on('change', function () {
            Table.draw();
        });

        $('#data-table-length').on('change', function () { 
            Table.page.len($(this).val()).draw(); 
        });

        if (datatable.checkbox) {

            $(document).on('change', '.checkbox', function (e) {
                e.preventDefault();

                let type   = $(this).data('type');
                let url    = datatable.checkbox[type];
                let method = 'post';
                let id     = $(this).data('id');
                
                $.ajax({
                    url: url,
                    data: {id: id},
                    method: method,
                    success: function (response) {

                        $('.datatable').DataTable().ajax.reload();

                        new Noty({
                            layout: 'topRight',
                            type: 'success',
                            text: response,
                            killer: true,
                            timeout: 2000,
                        }).show();

                    },error: function (response) {

                            data = response.responseJSON.message;

                            swal({
                                title: data + '😥',
                                type: 'error',
                                icon: 'error',
                                buttons: false,
                                timer: 15000
                            }); //end of swal

                        }, //end of error - success

                });//end of ajax call

            });//end of delete

        }//end of if

        route = @json($datatables->sortable);

        if(route) {

            $("#data-table tbody").sortable({
                items: 'tr',
                cursor: 'move',
                update: function(event, ui) {

                    var sortedIDs = $(this).sortable('toArray', {attribute: 'data-id'});

                    $.post(route, {order: sortedIDs}, (response) => {
                        new Noty({
                            layout: 'topRight',
                            type: 'success',
                            text: response,
                            killer: true,
                            timeout: 2000,
                        }).show();
                    });
                }
            }).disableSelection();

        }//end of check sortable

        $(document).on('change', '.record__select', function () {
            $(this).closest('tr').toggleClass('bg-hover');
        });

        //select all functionality
        $(document).on('change', '.record__select', function () {
            getSelectedRecords();
        });

        // used to select all records
        $(document).on('change', '#record__select-all', function () {

            $('.record__select').prop('checked', this.checked);
            getSelectedRecords();
        });

        function getSelectedRecords() {
            var recordIds = [];

            $.each($(".record__select:checked"), function () {
                recordIds.push($(this).val());
            });

            $('#record-ids').val(JSON.stringify(recordIds));

            recordIds.length > 0
                ? $('#bulk-delete').attr('disabled', false)
                : $('#bulk-delete').attr('disabled', true)

        }

        //delete
        $(document).on('click', '.delete, #bulk-delete', function (e) {

            var that = $(this)

            e.preventDefault();

            var n = new Noty({
                text: "@lang('admin.messages.confirm_delete')",
                type: "info",
                killer: true,
                buttons: [
                    Noty.button("@lang('admin.global.yes')", 'kt-btn kt-btn-destructive mx-2', function () {
                        let url = that.closest('form').attr('action');
                        let data = new FormData(that.closest('form').get(0));

                        let loadingText = '<i class="fa fa-circle-o-notch fa-spin"></i>';
                        let originalText = that.html();
                        that.html(loadingText);

                        n.close();

                        $.ajax({
                            url: url,
                            data: data,
                            method: 'post',
                            processData: false,
                            contentType: false,
                            cache: false,
                            success: function (response) {

                                $("#record__select-all").prop("checked", false);

                                $('.datatable').DataTable().ajax.reload();

                                new Noty({
                                    layout: 'topRight',
                                    type: 'alert',
                                    text: response,
                                    killer: true,
                                    timeout: 2000,
                                }).show();

                                that.html(originalText);
                            },
                            error: function (response) {
                                data = response.responseJSON.message;
                                new Noty({
                                    layout: 'topRight',
                                    type: 'error',
                                    text: data + '😥',
                                    killer: true,
                                    timeout: 4000,
                                }).show();
                                that.html(originalText);
                            }

                        });//end of ajax call

                    }),

                    Noty.button("@lang('admin.global.no')", 'kt-btn kt-btn-mono mx-2', function () {
                        n.close();
                    })
                ]
            });

            n.show();

        });//end of delete

    //});//$(function()

</script>
<x-slot name="styles">

    <style>
    
        .dt-info {
            margin: auto 12px;
        }

        .dt-search,
        .dt-length {
            display: none !important;
        }

        .table.dataTable thead > tr > th.dt-orderable-asc .dt-column-order, table.dataTable thead > tr > th.dt-orderable-desc .dt-column-order, table.dataTable thead > tr > th.dt-ordering-asc .dt-column-order, table.dataTable thead > tr > th.dt-ordering-desc .dt-column-order, table.dataTable thead > tr > td.dt-orderable-asc .dt-column-order, table.dataTable thead > tr > td.dt-orderable-desc .dt-column-order, table.dataTable thead > tr > td.dt-ordering-asc .dt-column-order, table.dataTable thead > tr > td.dt-ordering-desc .dt-column-order {
            display: none;
        }
            
    </style>

</x-slot>