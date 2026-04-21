<x-dashboard.admin.layout.app>

	<x-slot name="title">
		{{ trans('admin.global.create') . ' - ' . trans('admin.models.managements') . ' - ' . trans('admin.models.admins') }}
	</x-slot>	
	
	<h1 class="text-lg font-semibold mb-2">{{ trans('admin.models.admins') }}</h1>

	<x-dashboard.admin.layout.includes.breadcrumb :breadcrumb='$breadcrumb' />
	
	<div class="grid gap-5 lg:gap-7.5">
	
		<div class="kt-card kt-card-grid min-w-full kt-card kt-card-accent mb-5">

			<form method="post" action="{{ route('dashboard.admin.managements.roles.store') }}" enctype="multipart/form-data">
				@csrf
				@method('post')
				
				<x-input.text name="name" label="auth.name"/>

				<h3 class="font-bold text-lg my-3">صلاحيات المستخدم</h3>

				<div class="space-y-3 max-h-96 overflow-y-auto p-3 rounded-md">

					@foreach($permissions as $model => $ops)

						<div class="flex flex-col md:flex-row justify-between items-start md:items-center pb-3 last:border-none">

							<div class="font-semibold text-gray-800 mb-2 md:mb-0 w-full md:w-1/3">
								{{ $models[$model] }}
							</div>

							<div class="flex flex-wrap gap-3 md:gap-4 w-full md:w-2/3">

								@foreach($ops as $key => $label)

									<label class="flex items-center gap-x-2 px-3 py-1 rounded-lg cursor-pointer">

										<input type="checkbox"
											name="permissions[]"
											value="{{ $key }}"
											class="kt-switch kt-switch-lg "
											{{ in_array($key, old('permissions', [])) ? 'checked' : '' }}>

										<span class="text-sm">{{ $label }}</span>

									</label>

								@endforeach

							</div>

						</div>

					@endforeach

				</div>

				<x-dashboard.admin.button.save />

			</form>

		</div>

	</div>

</x-dashboard.admin.layout.app>