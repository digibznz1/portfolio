<?php

namespace App\Http\Controllers\Dashboard\Admin\Institutions;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\Institutions\OrganizationType\OrganizationTypeRequest;
use App\Http\Requests\Dashboard\Admin\Institutions\OrganizationType\StatusRequest;
use App\Http\Requests\Dashboard\Admin\Institutions\OrganizationType\DeleteRequest;
use App\Models\OrganizationType;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;

class OrganizationTypeController extends Controller
{
    public function index(): View
    {
        abort_if(!permissionAdmin('read-organization_types'), 403);

        $datatables = datatableServices()
                        ->header([
                            'admin.global.name',
                            'admin.global.status'
                        ])
                        ->checkbox(['status' => 'dashboard.admin.institutions.organization_types.status'])
                        ->route('dashboard.admin.institutions.organization_types.data')
                        ->columns(['name', 'status'])
                        ->run();

        $breadcrumb = [['trans' => 'admin.models.institutions'],['trans' => 'admin.models.organization_types']];

        return view('dashboard.admin.institutions.organization_types.index', compact('datatables', 'breadcrumb'));

    }//end of index

    public function data(): object
    {
        $permissions = [
            'status' => permissionAdmin('status-admins'),
            'update' => permissionAdmin('update-admins'),
            'delete' => permissionAdmin('delete-admins'),
        ];

        $organizationType = OrganizationType::query();

        if (request('status') == '0' || request('status') == '1') $organizationType->where('status', request('status'));

        return dataTables()->of($organizationType)
                ->addColumn('record_select', 'dashboard.admin.dataTables.record_select')
                ->addColumn('actions', fn(OrganizationType $organizationType) => datatableAction($organizationType, $permissions)->buttons()->build())
                ->addColumn('status', fn (OrganizationType $organizationType) => !$organizationType->default ? view('dashboard.admin.dataTables.checkbox', ['models' => $organizationType, 'permissions' => $permissions, 'type' => 'status']) : '')
                ->rawColumns(['record_select', 'actions', 'status'])
                ->addIndexColumn()
                ->toJson();

    }//end of data

    public function create(): View
    {
        abort_if(!permissionAdmin('create-organization_types'), 403);

        $breadcrumb = [
            ['trans' => 'admin.models.institutions'],
            [
                'route' => 'dashboard.admin.institutions.organization_types.index',
                'trans' => 'admin.models.admins',
            ],
            [
                'route' => '#',
                'trans' => 'admin.global.create',
            ]
        ];

        return view('dashboard.admin.institutions.organization_types.create', compact('breadcrumb'));
        
    }//end of create

    //RedirectResponse
    public function store(OrganizationTypeRequest $request): RedirectResponse
    {
        OrganizationType::create($request->validated());

        session()->flash('success', __('admin.messages.added_successfully'));
        return to_route('dashboard.admin.institutions.organization_types.index');

    }//end of store

    public function edit(OrganizationType $organizationType): View
    {
        abort_if(!permissionAdmin('update-organization_types'), 403);

        $breadcrumb = [
            ['trans' => 'admin.models.institutions'],
            [
                'route' => 'dashboard.admin.institutions.organization_types.index',
                'trans' => 'admin.models.admins',
            ],
            [
                'route' => '#',
                'trans' => 'admin.global.edit',
            ]
        ];
        
        return view('dashboard.admin.institutions.organization_types.edit', compact('organizationType', 'breadcrumb'));

    }//end of edit

    public function update(OrganizationTypeRequest $request, OrganizationType $organizationType): RedirectResponse
    {
        $organizationType->update($request->validated());
        
        session()->flash('success', __('admin.messages.updated_successfully'));
        return to_route('dashboard.admin.institutions.organization_types.index');
        
    }//end of update

    public function destroy(OrganizationType $organizationType): Application | Response | ResponseFactory
    {
        $organizationType->delete();

        session()->flash('success', __('admin.messages.deleted_successfully'));
        return response(__('admin.messages.deleted_successfully'));

    }//end of delete

    public function bulkDelete(DeleteRequest $request): Application | Response | ResponseFactory
    {
        OrganizationType::destroy(request()->ids ?? []);

        session()->flash('success', __('admin.messages.deleted_successfully'));
        return response(__('admin.messages.deleted_successfully'));

    }//end of bulkDelete

    public function status(StatusRequest $request): Application | Response | ResponseFactory
    {
        $organizationType = OrganizationType::find($request->id);
        $organizationType->update(['status' => !$organizationType->status]);

        session()->flash('success', __('admin.messages.updated_successfully'));
        return response(__('admin.messages.updated_successfully'));
        
    }//end of status

}//end of controller