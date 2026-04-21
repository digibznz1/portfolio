<x-dashboard.organization.layout.app>

	<x-slot name="title">{{ trans('admin.global.dashboard') }}</x-slot>

	{{--welcome Organization--}}

	<livewire:dashboard.organization.initial-evaluation.questions />

</x-dashboard.organization.layout.app>