<x-dashboard.admin.layout.app>

	<x-slot name="title">{{ trans('admin.models.admins') . ' - ' . trans('admin.models.managements') }}</x-slot>	
	
	<h1 class="text-lg font-semibold mb-2">{{ trans('admin.models.roles') }}</h1>

	<x-dashboard.admin.layout.includes.breadcrumb :breadcrumb='$breadcrumb' />
	
	<div class="flex flex-wrap items-center lg:items-end justify-between pt-3.5">
		
		<div class="flex items-center gap-3">
			
			<x-dashboard.admin.button.add permission="create-role"/>

			<x-dashboard.admin.button.bulk-delete permission="delete-role"/>

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

			</div>{{-- flex-wrap --}}
	
			<div class="kt-card-content">
				
				<div class="grid">
					
					<div class="kt-scrollable-x-auto">

						<table class="kt-table table-auto kt-table-border datatable" data-kt-datatable-table="true" id="data-table">
					
							<x-dashboard.admin.data-table.header :columns='$datatables["header"]' />
					
						</table>
					
					</div>

				</div>{{-- grid --}}

			</div>{{-- card-content --}}

		</div>{{-- card --}}

	</div>{{-- grid --}}

	<x-slot name="scripts">
		<x-dashboard.admin.data-table.script :datatables='$datatables' />
	</x-slot>

</x-dashboard.admin.layout.app>