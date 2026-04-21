<x-dashboard.admin.layout.app>
	
	<x-slot name="title">
		{{ trans('admin.global.create') . ' - ' . trans('admin.models.evaluations') . ' - ' . trans('admin.evaluations.initial_evaluations.model') }}
	</x-slot>

	<h1 class="text-lg font-semibold mb-2">{{ trans('admin.evaluations.initial_evaluations.model') }}</h1>

	<x-dashboard.admin.layout.includes.breadcrumb :breadcrumb='$breadcrumb' />
		
	<div class="grid gap-5 lg:gap-7.5">
	
		<div class="kt-card kt-card-grid min-w-full kt-card kt-card-accent mb-5">

			<form method="post" action="{{ route('dashboard.admin.evaluations.initial_evaluations.store') }}">
				@csrf
				@method('post')

				<div class="flex items-end gap-4">
    
					<div class="flex-1">
						<x-input.text name="question" label="evaluations.initial_evaluations.question" />
					</div>

					<div class="flex items-center gap-4 pb-2">
						
						<div class="flex items-center gap-1">
							<input type="radio" class="kt-radio" id="yes" name="answer" {{ old('answer', '1') == '1' ? 'checked' : '' }} value="1" />
							<label class="kt-label" for="yes">@lang('admin.global.1')</label>
						</div>

						<div class="flex items-center gap-1">
							<input type="radio" class="kt-radio" id="no" name="answer" {{ old('answer') == '0' ? 'checked' : '' }} value="0" />
							<label class="kt-label" for="no">@lang('admin.global.0')</label>
						</div>

					</div>

				</div>
				
				<div class="flex items-center grid grid-cols-3 md:grid-cols-3 gap-3 mt-4">

					<x-input.option name="standard_id" id="standard" :lists="$standards" label="models.standards"/>

					<x-input.option name="category_id" id="field" :lists="[]" label="models.fields"/>

					<x-input.option name="organization_type_id" id="organization-type" :lists="$organizationTypes" label="models.organization_type"/>

				</div>

				<x-input.option name="self_evaluations[]" id="self-evaluations" :value="old('self_evaluations')" :lists="[]" :multiple="true" label="evaluations.self_evaluations.model"/>

				<x-input.textarea name="description" label="global.description" rows="5"/>

				<x-input.checkbox />
				
				<x-dashboard.admin.button.save />

			</form>

		</div>

	</div>

	<x-slot name="scripts">

		<script>

			let fields       = @json($fields);
			let oldStandard  = "{{ old('standard_id') }}";
			let oldField     = "{{ old('category_id') }}";
			let oldOrgType   = "{{ old('organization_type_id') }}";
			let oldSelf      = @json(old('self_evaluations', []));

			function loadFields(standardId, selectedField = null) {

				let filtered = fields.filter(f => f.parent_id == standardId);

				let $field = $('#field');
				$field.empty();

				$field.append(`<option value="">-- اختر --</option>`);

				let valueToSelect = selectedField ? selectedField : oldField;

				filtered.forEach(item => {

					let selected = (item.id == valueToSelect) ? 'selected' : '';

					$field.append(`<option value="${item.id}" ${selected}>${item.name}</option>`);
				});
			}

			function loadSelfEvaluations() {

				$.ajax({
					url: "{{ route('dashboard.admin.evaluations.initial_evaluations.filter') }}",
					data: {
						standard_id: $('#standard').val(),
						field_id: $('#field').val(),
						organization_type_id: $('#organization-type').val(),
					},
					success: function (data) {

						let select = $('#self-evaluations');
						select.empty();

						$.each(data, function (id, name) {

							let selected = oldSelf.includes(parseInt(id)) ? 'selected' : '';

							select.append(`<option value="${id}" ${selected}>${name}</option>`);
						});

						select.val(oldSelf).trigger('change');
					}
				});
			}

			$('#standard').on('change', function () {
				let standardId = $(this).val();
				loadFields(standardId);
				loadSelfEvaluations();
			});

			$('#field, #organization-type').on('change', function () {
				loadSelfEvaluations();
			});

			if (oldStandard) {
				$('#standard').val(oldStandard);
				loadFields(oldStandard, oldField);
			}

			if (oldOrgType) {
				$('#organization-type').val(oldOrgType).trigger('change');
			}

			if (oldStandard || oldField || oldOrgType) {
				loadSelfEvaluations();
			}

		</script>

	</x-slot>

</x-dashboard.admin.layout.app>