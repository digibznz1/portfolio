<x-dashboard.organization.layout.app>

	<x-slot name="title">{{ trans('admin.models.organizations') . ' - ' . trans('admin.auth.profile') }}</x-slot>	
	
	<h1 class="text-lg font-semibold mb-2">{{ trans('admin.auth.profile') }}</h1>

	<x-dashboard.organization.layout.includes.breadcrumb :breadcrumb='$breadcrumb' />
		
	<div class="grid gap-5 lg:gap-7.5">
	
		<div class="kt-card kt-card-grid min-w-full kt-card kt-card-accent mb-5">

			<form method="post" action="{{ route('dashboard.organization.auth.accounts.profile.update', $organization->id) }}" enctype="multipart/form-data">
				@csrf
				@method('put')
				
				<div class="p-4 border rounded-xl bg-gray-50 flex justify-center items-center mt-5">

					<div class="w-full max-w-[220px] flex justify-center">
						<x-input.image :value="$organization->image_path"/>
					</div>

				</div>
				
				<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

					<x-input.text name="name" label="auth.name" :value="$organization->name"/>

					<x-input.text name="email" label="auth.email" :value="$organization->email"/>
					
				</div>

				<x-input.textarea name="description" label="global.description" rows="5" value="{{ $organization->description }}"/>

				<x-dashboard.admin.button.save />

			</form>

		</div>

	</div>

</x-dashboard.organization.layout.app>