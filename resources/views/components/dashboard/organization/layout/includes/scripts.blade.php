<script src="{{ asset('admin_assets/js/core.bundle.js') }}"></script>
<script src="{{ asset('admin_assets/vendors/ktui/ktui.min.js') }}"></script>
<script src="{{ asset('admin_assets/vendors/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ asset('admin_assets/js/widgets/general.js') }}"></script>
<script src="{{ asset('admin_assets/js/layouts/demo1.js') }}"></script>

<script>
	$(function () {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

    });//end of ready
</script>