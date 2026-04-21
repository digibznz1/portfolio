<?php

namespace App\Http\Controllers\Dashboard\Admin\Institutions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\Institutions\Organization\OrganizationRequest;
use App\Http\Requests\Dashboard\Admin\Institutions\Organization\StatusRequest;
use App\Http\Requests\Dashboard\Admin\Institutions\Organization\DeleteRequest;
use App\Models\Organization;
use App\Models\OrganizationType;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;

class OrganizationController extends Controller
{
    public function index(): View
    {
        abort_if(!permissionAdmin('read-organizations'), 403);

        $datatables = datatableServices()
                        ->header([
                            'admin.global.name',
                            'admin.global.email',
                            'admin.global.image',
                            'admin.models.organization_types',
                            'admin.global.status'
                        ])
                        ->checkbox(['status' => 'dashboard.admin.institutions.organizations.status'])
                        ->route('dashboard.admin.institutions.organizations.data')
                        ->columns(['name', 'email', 'image', 'organization_type', 'status'])
                        ->run();

        $breadcrumb = [['trans' => 'admin.models.institutions'],['trans' => 'admin.models.organizations']];

        return view('dashboard.admin.institutions.organizations.index', compact('datatables', 'breadcrumb'));

    }//end of index

    public function data(): object
    {
        $permissions = [
            'status' => permissionAdmin('status-admins'),
            'update' => permissionAdmin('update-admins'),
            'delete' => permissionAdmin('delete-admins'),
        ];

        $organization = Organization::OrganizationTypeJoin();

        if (request('status') == '0' || request('status') == '1') $organization->where('status', request('status'));

        return dataTables()->of($organization)
                ->addColumn('record_select', 'dashboard.admin.dataTables.record_select')
                ->editColumn('image', 'dashboard.admin.dataTables.image')
                ->addColumn('actions', fn(Organization $organization) => datatableAction($organization, $permissions)->buttons()->build())
                ->addColumn('status', fn (Organization $organization) => !$organization->default ? view('dashboard.admin.dataTables.checkbox', ['models' => $organization, 'permissions' => $permissions, 'type' => 'status']) : '')
                ->addColumn('organization_type', fn(Organization $organization) => $organization->organization_type_name)
				->rawColumns(['record_select', 'actions', 'status', 'image', 'organization_type'])
                ->addIndexColumn()
                ->toJson();

    }//end of data

    public function create(): View
    {
        abort_if(!permissionAdmin('create-organizations'), 403);

        $breadcrumb = [
            ['trans' => 'admin.models.institutions'],
            [
                'route' => 'dashboard.admin.institutions.organizations.index',
                'trans' => 'admin.models.organizations',
            ],
            [
                'route' => '#',
                'trans' => 'admin.global.create',
            ]
        ];

		$organizationType = OrganizationType::pluck('name', 'id');

        return view('dashboard.admin.institutions.organizations.create', compact('breadcrumb', 'organizationType'));
        
    }//end of create

    //RedirectResponse
    public function store(OrganizationRequest $request): RedirectResponse
    {
        $validated = $request->safe()->except(['image']);

        if(request()->file('image')) {

            $validated['image'] = request()->file('image')->store('organizations', 'public');

        }

        Organization::create($validated);

        session()->flash('success', __('admin.messages.added_successfully'));
        return to_route('dashboard.admin.institutions.organizations.index');

    }//end of store

    public function edit(Organization $organization): View
    {
        abort_if(!permissionAdmin('update-organizations'), 403);

        $breadcrumb = [
            ['trans' => 'admin.models.institutions'],
            [
                'route' => 'dashboard.admin.institutions.organizations.index',
                'trans' => 'admin.models.organizations',
            ],
            [
                'route' => '#',
                'trans' => 'admin.global.edit',
            ]
        ];

		$organizationType = OrganizationType::pluck('name', 'id');
        
        return view('dashboard.admin.institutions.organizations.edit', compact('organization', 'breadcrumb', 'organizationType'));

    }//end of edit

    public function update(OrganizationRequest $request, Organization $organization): RedirectResponse
    {
        $validated = $request->safe()->except(['image', 'password']);

        if(request()->hasFile('image')) {

            $organization->image != 'default.png' ? Storage::disk('public')->delete($organization->image) : '';

            $validated['image'] = request()->file('image')->store('admins', 'public');

        }//end of has image request

        $organization->update($validated);
        
        session()->flash('success', __('admin.messages.updated_successfully'));
        return to_route('dashboard.admin.institutions.organizations.index');
        
    }//end of update

    public function destroy(Organization $organization): Application | Response | ResponseFactory
    {
        $organization->image != 'default.png' ? Storage::disk('public')->delete($organization->image) : '';
        $organization->delete();

        session()->flash('success', __('admin.messages.deleted_successfully'));
        return response(__('admin.messages.deleted_successfully'));

    }//end of delete

    public function bulkDelete(DeleteRequest $request): Application | Response | ResponseFactory
    {
        $images = Organization::find(request()->ids ?? [])->pluck('image')->toArray();
        count($images) > 0 ? Storage::disk('public')->delete($images) : '';
        Organization::destroy(request()->ids ?? []);

        session()->flash('success', __('admin.messages.deleted_successfully'));
        return response(__('admin.messages.deleted_successfully'));

    }//end of bulkDelete

    public function status(StatusRequest $request): Application | Response | ResponseFactory
    {
        $organization = Organization::find($request->id);
        $organization->update(['status' => !$organization->status]);

        session()->flash('success', __('admin.messages.updated_successfully'));
        return response(__('admin.messages.updated_successfully'));
        
    }//end of status

}//end of controller