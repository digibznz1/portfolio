<x-dashboard.admin.layout.auth.app>

	<div class="flex items-center justify-center grow bg-center bg-no-repeat page-bg">
		<div class="kt-card max-w-[370px] w-full">

			<form action="{{ route('dashboard.organization.auth.login.store') }}" class="kt-card-content flex flex-col gap-5 p-10" id="sign_in_form" method="post">

				@csrf
				
				<div class="text-center mb-2.5">
					<h3 class="text-lg font-medium text-mono leading-none mb-2.5">
						{{ trans('admin.auth.sign_in') }}
					</h3>
				</div>

				<div class="flex flex-col gap-1">
					<label for="email" class="kt-form-label font-normal text-mono">
						{{ trans('admin.auth.email') }}
					</label>
					<input class="kt-input" id="email" autocomplete="email" aria-invalid="{{ $errors->has('email') ? 'true' : 'false' }}" name="email" placeholder="email@email.com" value="{{ old('email', 'organization@app.com') }}"/>
					@error('email')
						<div class="text-red-500 text-xs">{{ $message }}</div>
					@enderror
				</div>

				<div class="flex flex-col gap-1">
					<div class="flex items-center justify-between gap-1">
						<label for="password" class="kt-form-label font-normal text-mono">
							{{ trans('admin.auth.password') }}
						</label>
					</div>
					<div class="kt-input" data-kt-toggle-password="true" aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}">
						<input name="password" id="password" autocomplete="current-password" placeholder="Enter Password" aria-invalid="{{ $errors->has('password') ? 'true' : 'false' }}" type="password" value="{{ old('password', 'password') }}"/>
						
						<button class="kt-btn kt-btn-sm kt-btn-ghost kt-btn-icon bg-transparent! -me-1.5" data-kt-toggle-password-trigger="true" type="button">
							<span class="kt-toggle-password-active:hidden">
								<i class="ki-filled ki-eye text-muted-foreground"></i>
							</span>
							<span class="hidden kt-toggle-password-active:block">
								<i class="ki-filled ki-eye-slash text-muted-foreground"></i>
							</span>
						</button>
					</div>
					@error('password')
						<div class="text-red-500 text-xs">{{ $message }}</div>
					@enderror
				</div>

				<label class="kt-label" for="remember">
					<input id="remember" class="kt-checkbox kt-checkbox-sm" name="remember" type="checkbox" value="1" {{ old('remember') ? 'checked' : '' }}/>
					<span class="kt-checkbox-label">
						{{ trans('admin.auth.remember_me') }}
					</span>
				</label>
				
				<button class="kt-btn kt-btn-primary flex justify-center grow">
					{{ trans('admin.auth.sign_in') }}
				</button>

			</form>
		</div>
	</div>

</x-dashboard.admin.layout.auth.app>