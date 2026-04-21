<x-dashboard.admin.layout.app>

	<x-slot name="title">{{ trans('admin.auth.profile') . ' - ' . trans('admin.auth.edit_password') }}</x-slot>	
	
	<h1 class="text-lg font-semibold mb-2">{{ trans('admin.auth.edit_password') }}</h1>

	<x-dashboard.organization.layout.includes.breadcrumb :breadcrumb='$breadcrumb' />
		
	<div class="grid gap-5 lg:gap-7.5">
	
		<div class="kt-card kt-card-grid min-w-full kt-card kt-card-accent mb-5">

			<form method="post" action="{{ route('dashboard.admin.auth.accounts.password.update') }}" enctype="multipart/form-data">
				@csrf
				@method('post')
				
				<div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">

					<x-input.text required="true" name="current_password" label="auth.current_password" type="password"/>

					<x-input.text required="true" name="new_password" label="auth.new_password" type="password"/>

					<x-input.text required="true" name="password_confirmation" label="auth.password_confirmation" type="password"/>
					
				</div>

				<x-dashboard.admin.button.save />

			</form>

		</div>

	</div>

</x-dashboard.admin.layout.app>