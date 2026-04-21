<x-dashboard.admin.layout.app>
	
	<x-slot name="title">
		{{ trans('admin.global.edit') . ' - ' . trans('admin.models.categories') . ' - ' . trans('admin.models.standards') }}
	</x-slot>

	<h1 class="text-lg font-semibold mb-2">{{ trans('admin.models.standards') }}</h1>

	<x-dashboard.admin.layout.includes.breadcrumb :breadcrumb='$breadcrumb' />
		
	<div class="grid gap-5 lg:gap-7.5">
	
		<div class="kt-card kt-card-grid min-w-full kt-card kt-card-accent mb-5">

			<form method="post" action="{{ route('dashboard.admin.categories.standards.update', $standard->id) }}">
				@csrf
				@method('put')
				
				<x-input.text name="name" label="global.name" :value='$standard->name'/>

				<x-input.checkbox :value='$standard->starus'/>
				
				<x-dashboard.admin.button.save />

			</form>

		</div>

	</div>

</x-dashboard.admin.layout.app>