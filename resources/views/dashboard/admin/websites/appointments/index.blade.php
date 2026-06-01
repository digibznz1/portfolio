<x-dashboard.admin.layout.app>

    <x-slot name="title">{{ trans('admin.models.websites') . ' - ' . trans('admin.models.appointments') }}</x-slot>

    <h1 class="text-lg font-semibold mb-2">{{ trans('admin.models.appointments') }}</h1>

    <x-dashboard.admin.layout.includes.breadcrumb :breadcrumb='$breadcrumb' />

    <div class="flex flex-wrap items-center lg:items-end justify-between pt-3.5">
        <div class="flex items-center gap-3">
            <x-dashboard.admin.button.bulk-delete permission="delete-appointments"/>
        </div>
    </div>

    <div class="grid gap-5 lg:gap-7.5">

        <div class="kt-card-grid min-w-full my-5">

            <div class="flex-wrap gap-2 mb-2.5">
                <div class="flex flex-wrap gap-2 lg:gap-5">
                    <div class="flex">
                        <x-dashboard.admin.data-table.search />
                    </div>
                    <x-dashboard.admin.data-table.filter />
                </div>
            </div>

            <div class="kt-card-content">
                <div class="grid">
                    <div class="kt-scrollable-x-auto">
                        <table class="datatable" id="data-table">
                            <x-dashboard.admin.data-table.header :columns='$datatables["header"]' />
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>

    <x-slot name="scripts">

        <x-dashboard.admin.data-table.script :datatables='$datatables' />

        <script>
            $(document).on('change', '.appointment-status', function () {
                $.post('{{ route('dashboard.admin.websites.contacts.appointments.status') }}', {
                    id:     $(this).data('id'),
                    status: $(this).val(),
                }, function (response) {
                    new Noty({ layout: 'topRight', type: 'success', text: response, killer: true, timeout: 2000 }).show();
                });
            });
        </script>

    </x-slot>

</x-dashboard.admin.layout.app>
