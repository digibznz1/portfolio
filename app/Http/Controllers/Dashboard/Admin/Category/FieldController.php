<?php

namespace App\Http\Controllers\Dashboard\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\Category\Field\FieldRequest;
use App\Http\Requests\Dashboard\Admin\Category\Field\StatusRequest;
use App\Http\Requests\Dashboard\Admin\Category\Field\DeleteRequest;
use App\Models\Category;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;

class FieldController extends Controller
{
    public function index(): View
    {
        abort_if(!permissionAdmin('read-fields'), 403);

        $datatables = datatableServices()
                        ->header([
                            'admin.global.name',
                            'admin.models.standards',
                            'admin.global.status'
                        ])
                        ->checkbox(['status' => 'dashboard.admin.categories.fields.status'])
                        ->route('dashboard.admin.categories.fields.data')
						->sortable('dashboard.admin.categories.fields.sortable.store')
                        ->columns(['name', 'standards', 'status'])
                        ->run();

        $breadcrumb = [['trans' => 'admin.models.categories'],['trans' => 'admin.models.fields']];

        $standards = Category::standards()->pluck('name', 'id');

        return view('dashboard.admin.categories.fields.index', compact('datatables', 'standards', 'breadcrumb'));

    }//end of index

    public function data(): object
    {
        $permissions = [
            'status' => permissionAdmin('status-fields'),
            'update' => permissionAdmin('update-fields'),
            'delete' => permissionAdmin('delete-fields'),
        ];

        $fields = Category::query()->fields();

        if (request('status') == '0' || request('status') == '1') $fields->where('status', request('status'));

        if (request('standard')) $fields->where('parent_id', request('standard'));

        return dataTables()->of($fields)
                ->addColumn('record_select', 'dashboard.admin.dataTables.record_select')
                ->addColumn('actions', fn(Category $fields) => datatableAction($fields, $permissions)->buttons()->build())
                ->addColumn('standards', fn(Category $fields) =>$fields->parent?->name)
                ->addColumn('status', fn (Category $fields) => view('dashboard.admin.dataTables.checkbox', ['models' => $fields, 'permissions' => $permissions, 'type' => 'status']))
                ->rawColumns(['record_select', 'actions', 'standards', 'status'])
                ->addIndexColumn()
                ->toJson();

    }//end of data

    public function create(): View
    {
        abort_if(!permissionAdmin('create-fields'), 403);

        $breadcrumb = [
            ['trans' => 'admin.models.categories'],
            [
                'route' => 'dashboard.admin.categories.fields.index',
                'trans' => 'admin.models.fields',
            ],
            [
                'route' => '#',
                'trans' => 'admin.global.create',
            ]
        ];

		$standards = Category::standards()->pluck('name', 'id');

        return view('dashboard.admin.categories.fields.create', compact('breadcrumb', 'standards'));
        
    }//end of create

    //RedirectResponse
    public function store(FieldRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        Category::create($validated);

        session()->flash('success', __('admin.messages.added_successfully'));
        return to_route('dashboard.admin.categories.fields.index');

    }//end of store

    public function edit(Category $field): View
    {
        abort_if(!permissionAdmin('update-fields'), 403);

        $breadcrumb = [
            ['trans' => 'admin.models.categories'],
            [
                'route' => 'dashboard.admin.categories.fields.index',
                'trans' => 'admin.models.categories',
            ],
            [
                'route' => '#',
                'trans' => 'admin.global.edit',
            ]
        ];

		$standards = Category::standards()->pluck('name', 'id');
        
        return view('dashboard.admin.categories.fields.edit', compact('field', 'standards', 'breadcrumb'));

    }//end of edit

    public function update(FieldRequest $request, Category $field): RedirectResponse
    {
        $field->update($request->validated());
        
        session()->flash('success', __('admin.messages.updated_successfully'));
        return to_route('dashboard.admin.categories.fields.index');
        
    }//end of update

    public function destroy(Category $field): Application | Response | ResponseFactory
    {
        $field->delete();

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
        $fields = Category::find($request->id);
        $fields->update(['status' => !$fields->status]);

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