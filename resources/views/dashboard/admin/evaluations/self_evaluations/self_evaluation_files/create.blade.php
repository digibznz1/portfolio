<x-dashboard.admin.layout.app>
	
	<x-slot name="title">
		{{ trans('admin.global.create') . ' - ' . trans('admin.models.evaluations') . ' - ' . trans('admin.evaluations.self_evaluations.model') }}
	</x-slot>

	<h1 class="text-lg font-semibold mb-2">{{ trans('admin.evaluations.self_evaluations.model') }}</h1>

	<x-dashboard.admin.layout.includes.breadcrumb :breadcrumb='$breadcrumb' />
		
	<div class="grid gap-5 lg:gap-7.5">
	
		<div class="kt-card kt-card-grid min-w-full kt-card kt-card-accent mb-5">

			<form method="post" action="{{ route('dashboard.admin.evaluations.self_evaluations.self_evaluation_files.store', $selfEvaluation->id) }}" enctype="multipart/form-data">
				@csrf
				@method('post')

				<x-input.text name="file" type="file" label="types.file"/>
				
				<x-input.textarea name="description" label="global.description" rows="5"/>

				<x-input.checkbox />
				
				<x-dashboard.admin.button.save />

			</form>

		</div>

	</div>

</x-dashboard.admin.layout.app>