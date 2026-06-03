<?php

namespace App\Http\Controllers\Dashboard\Admin\Websites;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\Websites\Services\ServiceRequest;
use App\Http\Requests\Dashboard\Admin\Websites\Services\DeleteRequest;
use App\Http\Requests\Dashboard\Admin\Websites\Services\StatusRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index(): View
    {
        abort_if(!permissionAdmin('read-services'), 403);

        $datatables = datatableServices()
                        ->header([
                            'admin.global.icon',
                            'admin.global.name',
                            'admin.global.description',
                            'admin.global.status'
                        ])
                        ->checkbox(['status' => 'dashboard.admin.websites.services.status'])
                        ->route('dashboard.admin.websites.services.data')
                        ->columns(['icon', 'name', 'description', 'status'])
                        ->sortable('dashboard.admin.websites.services.sortable.store')
                        ->run();

        $breadcrumb = [
            ['trans' => 'admin.models.websites'],
            ['trans' => 'admin.models.services']
        ];

        return view('dashboard.admin.websites.services.index', compact('breadcrumb', 'datatables'));

    }//end of index

    public function data(): object
    {
        $permissions = [
            'status' => permissionAdmin('status-services'),
            'update' => permissionAdmin('update-services'),
            'delete' => permissionAdmin('delete-services'),
        ];

        $service = Service::query();

        return dataTables()->of($service)
            ->addColumn('record_select', 'dashboard.admin.dataTables.record_select')
            ->editColumn('name', fn (Service $service) => $service?->name)
            ->editColumn('icon', fn (Service $service) => '<span class="material-symbols-outlined text-1xl">' . e($service->icon) . '</span>')
            ->editColumn('description', fn (Service $service) => str()->limit($service?->description, 70))
            ->addColumn('actions', fn(Service $service) => datatableAction($service, $permissions)->baseRoute('dashboard.admin.websites.services')->buttons()->build())
            ->addColumn('status', fn (Service $service) => view('dashboard.admin.dataTables.checkbox', ['models' => $service, 'permissions' => $permissions, 'type' => 'status']))
            ->rawColumns(['record_select', 'actions', 'status', 'icon'])
            ->addIndexColumn()
            ->toJson();

    }//end of data

    public function create(): View
    {
        abort_if(!permissionAdmin('create-services'), 403);

        $breadcrumb = [
            [
                'route' => '#',
                'trans' => 'admin.models.websites',
            ],
            [
                'route' => 'dashboard.admin.websites.services.index',
                'trans' => 'admin.models.services',
            ],
            [
                'route' => '#',
                'trans' => 'admin.global.create',
            ]
        ];

        return view('dashboard.admin.websites.services.create', compact('breadcrumb'));

    }//end of create

    public function store(ServiceRequest $request): RedirectResponse
    {
        Service::create($request->validated());

        session()->flash('success', __('admin.messages.added_successfully'));
        return to_route('dashboard.admin.websites.services.index');
        
    }//end of update

    public function edit(Service $service): View
    {
        abort_if(!permissionAdmin('update-services'), 403);

        $breadcrumb = [
            [
                'route' => '#',
                'trans' => 'admin.models.websites',
            ],
            [
                'route' => 'dashboard.admin.websites.services.index',
                'trans' => 'admin.models.services',
            ],
            [
                'route' => '#',
                'trans' => 'admin.global.edit',
            ]
        ];

        return view('dashboard.admin.websites.services.edit', compact('service', 'breadcrumb'));

    }//end of edit

    public function update(ServiceRequest $request, Service $service): RedirectResponse
    {
        $service->update($request->validated());

        session()->flash('success', __('admin.messages.updated_successfully'));
        return to_route('dashboard.admin.websites.services.index');
        
    }//end of update

    public function destroy(Service $Service): Application | Response | ResponseFactory
    {
        $Service->delete();

        session()->flash('success', __('admin.messages.deleted_successfully'));
        return response(__('admin.messages.deleted_successfully'));

    }//end of delete

    public function bulkDelete(DeleteRequest $request): Application | Response | ResponseFactory
    {
        Service::destroy(request()->ids ?? []);

        session()->flash('success', __('admin.messages.deleted_successfully'));
        return response(__('admin.messages.deleted_successfully'));

    }//end of bulkDelete

    public function status(StatusRequest $request): Application | Response | ResponseFactory
    {
        $service = Service::find($request->id);
        $service?->update(['status' => !$service->status]);

        session()->flash('success', __('admin.messages.updated_successfully'));
        return response(__('admin.messages.updated_successfully'));
        
    }//end of status

    public function storeSortable(): bool
    {        
        foreach (request('order') as $index=>$id) {
            Service::where('id', $id)->update(['index' => $index]);
        }

        return true;
        
    }//end of storeSortable

}//end of controller