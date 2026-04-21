<x-dashboard.admin.layout.app>
	
	<x-slot name="title">
		{{ trans('admin.global.create') . ' - ' . trans('admin.models.evaluations') . ' - ' . trans('admin.evaluations.self_evaluations.model') }}
	</x-slot>

	<h1 class="text-lg font-semibold mb-2">{{ trans('admin.evaluations.self_evaluations.model') }}</h1>

	<x-dashboard.admin.layout.includes.breadcrumb :breadcrumb='$breadcrumb' />
		
	<div class="grid gap-5 lg:gap-7.5">
	
		<div class="kt-card kt-card-grid min-w-full kt-card kt-card-accent mb-5">

			<form method="post" action="{{ route('dashboard.admin.evaluations.self_evaluations.store') }}" enctype="multipart/form-data">
				@csrf
				@method('post')
				
				<div class="grid grid-cols-3 gap-4">
					<div class="col-span-2">
						<x-input.text name="name" label="evaluations.self_evaluations.name"/>
					</div>

					<div class="col-span-1">
						<x-input.text type="number" name="degree" label="evaluations.self_evaluations.degree"/>
					</div>
				</div>

				<div class="flex items-center grid grid-cols-3 md:grid-cols-3 gap-3 mt-4">

					<x-input.option name="standard_id" id="standard" :lists="$standards" label="models.standards"/>

					<x-input.option name="category_id" id="field" :lists="[]" label="models.fields"/>

					<x-input.option name="organization_type_id" :lists="$organizationTypes" label="models.organization_type"/>

				</div>

				<div class="col-span-1">
					<x-input.option name="alert_type" id="type" :lists="$alerTypes" label="evaluations.self_evaluations.alert_type" />
				</div>

				{{--<x-input.textarea name="description" label="global.description" rows="5"/>--}}

				<div id="input_url" class="input-type hidden">
					<x-input.text name="alert_value" label="types.url"/>
				</div>

				<div id="input_textarea" class="input-type hidden">
					<x-input.textarea name="alert_value" label="types.text" rows="5"/>
				</div>

				<div id="input_file" class="input-type hidden">
					<x-input.text name="alert_value" type="file" label="types.file"/>
				</div>

				<x-input.textarea name="explain" label="evaluations.self_evaluations.explain" rows="5"/>

				<x-input.checkbox />
				
				<x-dashboard.admin.button.save />

			</form>

		</div>

	</div>

	<x-slot name="scripts">

		<script>
			let fields = @json($fields);
			let oldStandard = "{{ old('standard_id') }}";
    		let oldField    = "{{ old('category_id') }}";

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

				let oldType = "{{ old('alert_type') }}";
				if (oldType) {
					$('#type').val(oldType);
					toggleInputs(oldType);
				}

			});
		</script>

	</x-slot>

</x-dashboard.admin.layout.app>