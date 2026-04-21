<x-dashboard.admin.layout.app>
	
	<x-slot name="title">
		{{ trans('admin.global.create') . ' - ' . trans('admin.models.categories') . ' - ' . trans('admin.models.standards') }}
	</x-slot>

	<h1 class="text-lg font-semibold mb-2">{{ trans('admin.models.standards') }}</h1>

	<x-dashboard.admin.layout.includes.breadcrumb :breadcrumb='$breadcrumb' />
		
	<div class="grid gap-5 lg:gap-7.5">
	
		<div class="kt-card kt-card-grid min-w-full kt-card kt-card-accent mb-5">

			<form method="post" action="{{ route('dashboard.admin.categories.fields.store') }}">
				@csrf
				@method('post')
				
				<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

					<x-input.text name="name" label="global.name"/>

					<x-input.option name="parent_id" label="models.fields" :lists="$standards"/>

				</div>

				<x-input.checkbox />
				
				<x-dashboard.admin.button.save />

			</form>

		</div>

	</div>

</x-dashboard.admin.layout.app>