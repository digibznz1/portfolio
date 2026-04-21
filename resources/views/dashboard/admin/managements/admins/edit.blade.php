<x-dashboard.admin.layout.app>

	<x-slot name="title">{{ trans('admin.models.admins') . ' - ' . trans('admin.models.managements') }}</x-slot>	
	
	<h1 class="text-lg font-semibold mb-2">{{ trans('admin.models.admins') }}</h1>

	<x-dashboard.admin.layout.includes.breadcrumb :breadcrumb='$breadcrumb' />
			
	<div class="grid gap-5 lg:gap-7.5">
	
		<div class="kt-card kt-card-grid min-w-full kt-card kt-card-accent mb-5">

			<form method="post" action="{{ route('dashboard.admin.managements.admins.update', $admin->id) }}" enctype="multipart/form-data">
				@csrf
				@method('put')

				<div class="p-4 border rounded-xl bg-gray-50 flex justify-center items-center  mt-5">

					<div class="w-full max-w-[220px] flex justify-center">
						<x-input.image :value='$admin->image_path'/>
					</div>

				</div>
				
				<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

					<x-input.text name="name" label="auth.name" :value='$admin->name'/>

					<x-input.text name="email" label="auth.email" :value='$admin->email'/>
					
					<x-input.text name="password" type="password" label="auth.password"/>

					<x-input.option name="role_id" label="admin.models.roles" :lists="$roles" :value="$admin->role_id"/>

					<x-input.checkbox :value='$admin->status'/>

				</div>

				<x-dashboard.admin.button.save />

			</form>

		</div>

	</div>

</x-dashboard.admin.layout.app>