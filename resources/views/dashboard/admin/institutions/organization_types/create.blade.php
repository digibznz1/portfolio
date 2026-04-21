<x-dashboard.admin.layout.app>
	
	<x-slot name="title">
		{{ trans('admin.global.create') . ' - ' . trans('admin.models.institutions') . ' - ' . trans('admin.models.organization_types') }}
	</x-slot>

	<h1 class="text-lg font-semibold mb-2">{{ trans('admin.models.organization_types') }}</h1>

	<x-dashboard.admin.layout.includes.breadcrumb :breadcrumb='$breadcrumb' />
		
	<div class="grid gap-5 lg:gap-7.5">
	
		<div class="kt-card kt-card-grid min-w-full kt-card kt-card-accent mb-5">

			<form method="post" action="{{ route('dashboard.admin.institutions.organization_types.store') }}">
				@csrf
				@method('post')
				
				<x-input.text name="name" label="global.name"/>

				<x-input.checkbox />
				
				<x-dashboard.admin.button.save />

			</form>

		</div>

	</div>

</x-dashboard.admin.layout.app>