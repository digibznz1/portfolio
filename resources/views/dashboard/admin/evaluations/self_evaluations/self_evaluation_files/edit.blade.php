<x-dashboard.admin.layout.app>
	
	<x-slot name="title">
		{{ trans('admin.global.create') . ' - ' . trans('admin.models.evaluations') . ' - ' . trans('admin.evaluations.self_evaluations.model') }}
	</x-slot>

	<h1 class="text-lg font-semibold mb-2">{{ trans('admin.evaluations.self_evaluations.model') }}</h1>

	<x-dashboard.admin.layout.includes.breadcrumb :breadcrumb='$breadcrumb' />
		
	<div class="grid gap-5 lg:gap-7.5">
	
		<div class="kt-card kt-card-grid min-w-full kt-card kt-card-accent mb-5">

			<form method="post" action="{{ route('dashboard.admin.evaluations.self_evaluations.self_evaluation_files.update', [$selfEvaluation->id, $selfEvaluationFile->id]) }}" enctype="multipart/form-data">
				@csrf
				@method('put')

				<div class="input-type">

					<div class="flex items-center gap-3">

						<div class="flex-1">
							<x-input.text name="file" type="file" label="types.file" />
						</div>

						@if(!empty($selfEvaluationFile->file))
							<a href="{{ asset('storage/' . $selfEvaluationFile->file) }}"  target="_blank" class="mt-6 text-blue-600 hover:text-blue-800">

								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-output-icon lucide-file-output"><path d="M4.226 20.925A2 2 0 0 0 6 22h12a2 2 0 0 0 2-2V8a2.4 2.4 0 0 0-.706-1.706l-3.588-3.588A2.4 2.4 0 0 0 14 2H6a2 2 0 0 0-2 2v3.127" data--h-bstatus="0OBSERVED"/><path d="M14 2v5a1 1 0 0 0 1 1h5" data--h-bstatus="0OBSERVED"/><path d="m5 11-3 3" data--h-bstatus="0OBSERVED"/><path d="m5 17-3-3h10" data--h-bstatus="0OBSERVED"/></svg>

							</a>
						@endif

					</div>

				</div>
				
				<x-input.textarea name="description" label="global.description" rows="5" :value="$selfEvaluationFile->description"/>

				<x-input.checkbox :value="$selfEvaluationFile->status"/>
				
				<x-dashboard.admin.button.save />

			</form>

		</div>

	</div>

</x-dashboard.admin.layout.app>