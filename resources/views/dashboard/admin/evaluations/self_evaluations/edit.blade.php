<x-dashboard.admin.layout.app>
	
	<x-slot name="title">
		{{ trans('admin.global.edit') . ' - ' . trans('admin.models.evaluations') . ' - ' . trans('admin.evaluations.self_evaluations.model') }}
	</x-slot>

	<h1 class="text-lg font-semibold mb-2">{{ trans('admin.evaluations.self_evaluations.model') }}</h1>

	<x-dashboard.admin.layout.includes.breadcrumb :breadcrumb='$breadcrumb' />
		
	<div class="grid gap-5 lg:gap-7.5">
	
		<div class="kt-card kt-card-grid min-w-full kt-card kt-card-accent mb-5">

			<form method="post" action="{{ route('dashboard.admin.evaluations.self_evaluations.update', $selfEvaluation->id) }}" enctype="multipart/form-data">
				@csrf
				@method('put')

				<div class="grid grid-cols-3 gap-4">
					<div class="col-span-2">
						<x-input.text name="name" label="evaluations.self_evaluations.name" :value='$selfEvaluation->name'/>
					</div>

					<div class="col-span-1">
						<x-input.text type='number' name="degree" label="evaluations.self_evaluations.degree" :value='$selfEvaluation->degree'/>
					</div>
				</div>

				<div class="flex items-center grid grid-cols-3 md:grid-cols-3 gap-3 mt-4">

					<x-input.option name="standard_id" id="standard" :lists="$standards" label="models.standards" :value="$selfEvaluation->category?->parent?->id"/>

					<x-input.option name="category_id" id="field" :lists="[]" label="models.fields" :value="$selfEvaluation->category_id"/>

					<x-input.option name="organization_type_id" :lists="$organizationTypes" label="models.organization_type" :value="$selfEvaluation->organization_type_id"/>

				</div>

				<div class="col-span-1">
					<x-input.option name="alert_type" id="type" :lists="$alerTypes" label="evaluations.self_evaluations.alert_type" :value="$selfEvaluation->alert_type"/>
				</div>

				<div id="input_url" class="input-type hidden">
					<x-input.text name="alert_value" label="types.url" :value="$selfEvaluation->alert_value"/>
				</div>

				<div id="input_textarea" class="input-type hidden">
					<x-input.textarea name="alert_value" label="types.text" rows="5" :value="$selfEvaluation->alert_value"/>
				</div>

				<div id="input_file" class="input-type hidden">

					<div class="flex items-center gap-3">

						<div class="flex-1">
							<x-input.text name="alert_value" type="file" label="types.file" />
						</div>

						@if(!empty($selfEvaluation->alert_value))
							<a href="{{ asset('storage/' . $selfEvaluation->alert_value) }}"  target="_blank" class="mt-6 text-blue-600 hover:text-blue-800">

								<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-output-icon lucide-file-output"><path d="M4.226 20.925A2 2 0 0 0 6 22h12a2 2 0 0 0 2-2V8a2.4 2.4 0 0 0-.706-1.706l-3.588-3.588A2.4 2.4 0 0 0 14 2H6a2 2 0 0 0-2 2v3.127" data--h-bstatus="0OBSERVED"/><path d="M14 2v5a1 1 0 0 0 1 1h5" data--h-bstatus="0OBSERVED"/><path d="m5 11-3 3" data--h-bstatus="0OBSERVED"/><path d="m5 17-3-3h10" data--h-bstatus="0OBSERVED"/></svg>

							</a>
						@endif

					</div>

				</div>

				<x-input.textarea name="explain" label="evaluations.self_evaluations.explain" :value='$selfEvaluation->explain' rows="5"/>

				<x-input.checkbox :value='$selfEvaluation->status'/>
				
				<x-dashboard.admin.button.save />

			</form>

		</div>

	</div>

	<x-slot name="scripts">

		<script>
			let fields = @json($fields);
			let oldStandard = "{{ old('standard_id', $selfEvaluation->category?->parent?->id) }}";
    		let oldField    = "{{ old('category_id', $selfEvaluation->category_id) }}";

			$(document).ready(function () {

				function loadFields(standardId, selectedField = null) {

					let filtered = fields.filter(f => f.parent_id == standardId);

					let $field = $('#field');
					$field.empty();

					$field.append(`<option value="">-- اختر --</option>`);

					filtered.forEach(item => {

						let selected = (item.id == selectedField) ? 'selected' : '';

						$field.append(`<option value="${item.id}" ${selected}>${item.name}</option>`);
					});
				}

				$('#standard').on('change', function () {
					let standardId = $(this).val();
					loadFields(standardId);
				});

				if (oldStandard) {
					$('#standard').val(oldStandard);
					loadFields(oldStandard, oldField);
				}

				function toggleInputs(type) {
					$('.input-type').addClass('hidden');
					$('.input-type').find('input, textarea').prop('disabled', true);

					if (type === 'url') {
						$('#input_url').removeClass('hidden').find('input').prop('disabled', false);;
					} else if (type === 'text') {
						$('#input_textarea').removeClass('hidden').find('textarea').prop('disabled', false);;
					} else if (type === 'file') {
						$('#input_file').removeClass('hidden').find('input').prop('disabled', false);;
					}
				}

				$('#type').on('change', function () {
					let type = $(this).val();
					toggleInputs(type);
				});

				let oldType = "{{ old('alert_type', $selfEvaluation->alert_type) }}";
				if (oldType) {
					$('#type').val(oldType);
					toggleInputs(oldType);
				}

			});
		</script>

	</x-slot>

</x-dashboard.admin.layout.app>