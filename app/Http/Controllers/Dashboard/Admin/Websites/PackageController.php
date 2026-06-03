<?php

namespace App\Http\Controllers\Dashboard\Admin\Websites;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\Websites\Packages\PackageRequest;
use App\Http\Requests\Dashboard\Admin\Websites\Packages\DeleteRequest;
use App\Http\Requests\Dashboard\Admin\Websites\Packages\StatusRequest;
use App\Models\Package;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;

class PackageController extends Controller
{
    public function index(): View
    {
        abort_if(!permissionAdmin('read-packages'), 403);

        $datatables = datatableServices()
            ->header([
                'admin.global.name',
                'admin.global.description',
                'admin.global.price',
                'admin.global.status',
            ])
            ->checkbox(['status' => 'dashboard.admin.websites.packages.status'])
            ->route('dashboard.admin.websites.packages.data')
            ->columns(['name', 'subtitle', 'price', 'status'])
            ->sortable('dashboard.admin.websites.packages.sortable.store')
            ->run();

        $breadcrumb = [
            ['trans' => 'admin.models.websites'],
            ['trans' => 'admin.models.packages'],
        ];

        return view('dashboard.admin.websites.packages.index', compact('breadcrumb', 'datatables'));

    }//end of index

    public function data(): object
    {
        $permissions = [
            'status' => permissionAdmin('status-packages'),
            'update' => permissionAdmin('update-packages'),
            'delete' => permissionAdmin('delete-packages'),
        ];

        $package = Package::query();

        return dataTables()->of($package)
            ->addColumn('record_select', 'dashboard.admin.dataTables.record_select')
            ->editColumn('name',     fn(Package $p) => '<div><p class="font-medium">' . e($p->name) . '</p><p class="text-xs text-gray-400">' . e($p->subtitle) . '</p></div>')
            ->editColumn('subtitle', fn(Package $p) => e($p->subtitle))
            ->editColumn('price',    fn(Package $p) => $p->price ? '<span class="font-bold text-primary">' . e($p->price) . '</span> <span class="text-xs text-gray-400">' . e($p->price_unit) . '</span>' : '<span class="text-xs text-gray-400">Custom</span>')
            ->addColumn('status', fn(Package $p) => view('dashboard.admin.dataTables.checkbox', ['models' => $p, 'permissions' => $permissions, 'type' => 'status']))
            ->addColumn('actions', fn(Package $p) => datatableAction($p, $permissions)->baseRoute('dashboard.admin.websites.packages')->buttons()->build())
            ->rawColumns(['record_select', 'actions', 'status', 'name', 'price'])
            ->addIndexColumn()
            ->toJson();

    }//end of data

    public function create(): View
    {
        abort_if(!permissionAdmin('create-packages'), 403);

        $breadcrumb = [
            ['trans' => 'admin.models.websites'],
            ['trans' => 'admin.models.packages', 'route' => 'dashboard.admin.websites.packages.index'],
            ['trans' => 'admin.global.create'],
        ];

        return view('dashboard.admin.websites.packages.create', compact('breadcrumb'));

    }//end of create

    public function store(PackageRequest $request): RedirectResponse
    {
        Package::create($request->validated());

        session()->flash('success', __('admin.messages.added_successfully'));
        return to_route('dashboard.admin.websites.packages.index');

    }//end of store

    public function edit(Package $package): View
    {
        abort_if(!permissionAdmin('update-packages'), 403);

        $breadcrumb = [
            ['trans' => 'admin.models.websites'],
            ['trans' => 'admin.models.packages', 'route' => 'dashboard.admin.websites.packages.index'],
            ['trans' => 'admin.global.edit'],
        ];

        return view('dashboard.admin.websites.packages.edit', compact('package', 'breadcrumb'));

    }//end of edit

    public function update(PackageRequest $request, Package $package): RedirectResponse
    {
        $package->update($request->validated());

        session()->flash('success', __('admin.messages.updated_successfully'));
        return to_route('dashboard.admin.websites.packages.index');

    }//end of update

    public function destroy(Package $package): Application|Response|ResponseFactory
    {
        $package->delete();

        session()->flash('success', __('admin.messages.deleted_successfully'));
        return response(__('admin.messages.deleted_successfully'));

    }//end of destroy

    public function bulkDelete(DeleteRequest $request): Application|Response|ResponseFactory
    {
        Package::destroy(request()->ids ?? []);

        session()->flash('success', __('admin.messages.deleted_successfully'));
        return response(__('admin.messages.deleted_successfully'));

    }//end of bulkDelete

    public function status(StatusRequest $request): Application|Response|ResponseFactory
    {
        $package = Package::find($request->id);
        $package->update(['status' => !$package->status]);

        session()->flash('success', __('admin.messages.updated_successfully'));
        return response(__('admin.messages.updated_successfully'));

    }//end of status

    public function storeSortable(): bool
    {
        foreach (request('order') as $index => $id) {
            Package::where('id', $id)->update(['index' => $index]);
        }

        return true;

    }//end of storeSortable

}//end of controller
