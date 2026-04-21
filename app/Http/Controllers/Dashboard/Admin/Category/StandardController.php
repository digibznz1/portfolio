<?php

namespace App\Http\Controllers\Dashboard\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\Category\Standard\StandardRequest;
use App\Http\Requests\Dashboard\Admin\Category\Standard\StatusRequest;
use App\Http\Requests\Dashboard\Admin\Category\Standard\DeleteRequest;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;

class StandardController extends Controller
{
    public function index(): View
    {
        abort_if(!permissionAdmin('read-standards'), 403);

        $datatables = datatableServices()
                        ->header([
                            'admin.global.name',
                            'admin.global.status'
                        ])
                        ->checkbox(['status' => 'dashboard.admin.categories.standards.status'])
                        ->route('dashboard.admin.categories.standards.data')
						->sortable('dashboard.admin.categories.standards.sortable.store')
                        ->columns(['name', 'status'])
                        ->run();

        $breadcrumb = [['trans' => 'admin.models.categories'],['trans' => 'admin.models.standards']];

        return view('dashboard.admin.categories.standards.index', compact('datatables', 'breadcrumb'));

    }//end of index

    public function data(): object
    {
        $permissions = [
            'status' => permissionAdmin('status-standards'),
            'update' => permissionAdmin('update-standards'),
            'delete' => permissionAdmin('delete-standards'),
        ];

        $standards = Category::query()->standards();

        if (request('status') == '0' || request('status') == '1') $standards->where('status', request('status'));

        return dataTables()->of($standards)
                ->addColumn('record_select', 'dashboard.admin.dataTables.record_select')
                ->addColumn('actions', fn(Category $standards) => datatableAction($standards, $permissions)->buttons()->build())
                ->addColumn('status', fn (Category $standards) => view('dashboard.admin.dataTables.checkbox', ['models' => $standards, 'permissions' => $permissions, 'type' => 'status']))
                ->rawColumns(['record_select', 'actions', 'status'])
                ->addIndexColumn()
                ->toJson();

    }//end of data

    public function create(): View
    {
        abort_if(!permissionAdmin('create-standards'), 403);

        $breadcrumb = [
            ['trans' => 'admin.models.categories'],
            [
                'route' => 'dashboard.admin.categories.standards.index',
                'trans' => 'admin.models.standards',
            ],
            [
                'route' => '#',
                'trans' => 'admin.global.create',
            ]
        ];
		
        return view('dashboard.admin.categories.standards.create', compact('breadcrumb'));
        
    }//end of create

    //RedirectResponse
    public function store(StandardRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        Category::create($validated);

        session()->flash('success', __('admin.messages.added_successfully'));
        return to_route('dashboard.admin.categories.standards.index');

    }//end of store

    public function edit(Category $standard): View
    {	
        abort_if(!permissionAdmin('update-standards'), 403);

        $breadcrumb = [
            ['trans' => 'admin.models.categories'],
            [
                'route' => 'dashboard.admin.categories.standards.index',
                'trans' => 'admin.models.standards',
            ],
            [
                'route' => '#',
                'trans' => 'admin.global.edit',
            ]
        ];
        
        return view('dashboard.admin.categories.standards.edit', compact('standard', 'breadcrumb'));

    }//end of edit

    public function update(StandardRequest $request, Category $standards): RedirectResponse
    {
        $standards->update($request->validated());
        
        session()->flash('success', __('admin.messages.updated_successfully'));
        return to_route('dashboard.admin.categories.standards.index');
        
    }//end of update

    public function destroy(Category $standard): Application | Response | ResponseFactory
    {
        $standard->delete();

        session()->flash('success', __('admin.messages.deleted_successfully'));
        return response(__('admin.messages.deleted_successfully'));

    }//end of delete

    public function bulkDelete(DeleteRequest $request): Application | Response | ResponseFactory
    {
        Category::destroy(request()->ids ?? []);

        session()->flash('success', __('admin.messages.deleted_successfully'));
        return response(__('admin.messages.deleted_successfully'));

    }//end of bulkDelete

    public function status(StatusRequest $request): Application | Response | ResponseFactory
    {
        $standards = Category::find($request->id);
        $standards->update(['status' => !$standards->status]);

        session()->flash('success', __('admin.messages.updated_successfully'));
        return response(__('admin.messages.updated_successfully'));
        
    }//end of status

	public function storeSortable()
    {        
        foreach (request('order') as $index=>$id) {
            Category::where('id', $id)->update(['index' => $index]);
        }
		
        session()->flash('success', __('admin.messages.updated_successfully'));
		return response(__('admin.messages.updated_successfully'));

    }//end of storeSortable

}//end of controller