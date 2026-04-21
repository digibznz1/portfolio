<?php

namespace App\Http\Controllers\Dashboard\Admin\Evaluation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\Evaluation\InitialEvaluation\InitialEvaluationRequest;
use App\Http\Requests\Dashboard\Admin\Evaluation\InitialEvaluation\StatusRequest;
use App\Http\Requests\Dashboard\Admin\Evaluation\InitialEvaluation\DeleteRequest;
use App\Models\Category;
use App\Models\InitialEvaluation;
use App\Models\OrganizationType;
use App\Models\SelfEvaluation;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;

class InitialEvaluationController extends Controller
{
    public function index(): View
    {
        abort_if(!permissionAdmin('read-initial_evaluations'), 403);

        $datatables = datatableServices()
                        ->header([
                            'admin.evaluations.initial_evaluations.question',
                            'admin.evaluations.initial_evaluations.answer',
                            'admin.global.description',
                            'admin.global.status'
                        ])
                        ->checkbox(['status' => 'dashboard.admin.evaluations.initial_evaluations.status'])
                        ->route('dashboard.admin.evaluations.initial_evaluations.data')
						->sortable('dashboard.admin.evaluations.initial_evaluations.sortable.store')
                        ->columns(['question', 'answer', 'description', 'status'])
                        ->run();

        $breadcrumb = [['trans' => 'admin.models.evaluations'],['trans' => 'admin.evaluations.initial_evaluations.model']];

        return view('dashboard.admin.evaluations.initial_evaluations.index', compact('datatables', 'breadcrumb'));

    }//end of index

    public function data(): object
    {
        $permissions = [
            'status' => permissionAdmin('status-initial_evaluations'),
            'update' => permissionAdmin('update-initial_evaluations'),
            'delete' => permissionAdmin('delete-initial_evaluations'),
        ];

        $initialEvaluation = InitialEvaluation::query();

        if (request('status') == '0' || request('status') == '1') $initialEvaluation->where('status', request('status'));

        return dataTables()->of($initialEvaluation)
                ->addColumn('record_select', 'dashboard.admin.dataTables.record_select')
                ->addColumn('actions', fn(InitialEvaluation $initialEvaluation) => datatableAction($initialEvaluation, $permissions)->buttons()->build())
                ->addColumn('status', fn (InitialEvaluation $initialEvaluation) => view('dashboard.admin.dataTables.checkbox', ['models' => $initialEvaluation, 'permissions' => $permissions, 'type' => 'status']))
                ->addColumn('answer', fn (InitialEvaluation $initialEvaluation) => trans('admin.global.' . $initialEvaluation->answer))
                ->editColumn('description', fn (InitialEvaluation $initialEvaluation) => str()->limit($initialEvaluation->description, 70))
                ->rawColumns(['record_select', 'actions', 'description', 'status'])
                ->addIndexColumn()
                ->toJson();

    }//end of data

    public function create(): View
    {
        abort_if(!permissionAdmin('create-initial_evaluations'), 403);

        $breadcrumb = [
            ['trans' => 'admin.models.evaluations'],
            [
                'route' => 'dashboard.admin.evaluations.initial_evaluations.index',
                'trans' => 'admin.evaluations.initial_evaluations.model',
            ],
            [
                'route' => '#',
                'trans' => 'admin.global.create',
            ]
        ];

        $selfEvaluations   = SelfEvaluation::pluck('name', 'id');
        $organizationTypes = OrganizationType::pluck('name', 'id');
        $standards         = Category::standards()->pluck('name', 'id');
        $fields            = Category::fields()->get(['id', 'name', 'parent_id']);

        return view('dashboard.admin.evaluations.initial_evaluations.create', compact('breadcrumb', 'selfEvaluations', 'standards', 'fields', 'organizationTypes'));
        
    }//end of create

    //RedirectResponse
    public function store(InitialEvaluationRequest $request): RedirectResponse
    {
        $validated = $request->safe()->except(['self_evaluations', 'standard_id']);

        $initialEvaluation = InitialEvaluation::create($validated);
        $initialEvaluation->selfEvaluations()->sync($request->self_evaluations);

        session()->flash('success', __('admin.messages.added_successfully'));
        return to_route('dashboard.admin.evaluations.initial_evaluations.index');

    }//end of store

    public function edit(InitialEvaluation $initialEvaluation): View
    {
        abort_if(!permissionAdmin('update-initial_evaluations'), 403);

        $breadcrumb = [
            ['trans' => 'admin.models.evaluations'],
            [
                'route' => 'dashboard.admin.evaluations.initial_evaluations.index',
                'trans' => 'admin.evaluations.initial_evaluations.model',
            ],
            [
                'route' => '#',
                'trans' => 'admin.global.edit',
            ]
        ];

        $selfEvaluations   = SelfEvaluation::pluck('name', 'id');
        $organizationTypes = OrganizationType::pluck('name', 'id');
        $standards         = Category::standards()->pluck('name', 'id');
        $fields            = Category::fields()->get(['id', 'name', 'parent_id']);
        
        return view('dashboard.admin.evaluations.initial_evaluations.edit', compact('initialEvaluation', 'selfEvaluations', 'standards', 'fields', 'organizationTypes', 'breadcrumb'));

    }//end of edit

    public function update(InitialEvaluationRequest $request, InitialEvaluation $initialEvaluation): RedirectResponse
    {
        $validated = $request->safe()->except(['self_evaluations', 'standard_id']);

        $initialEvaluation->update($validated);
        $initialEvaluation->selfEvaluations()->sync($request->self_evaluations);
        
        session()->flash('success', __('admin.messages.updated_successfully'));
        return to_route('dashboard.admin.evaluations.initial_evaluations.index');
        
    }//end of update

    public function destroy(InitialEvaluation $initialEvaluation): Application | Response | ResponseFactory
    {
        $initialEvaluation->delete();

        session()->flash('success', __('admin.messages.deleted_successfully'));
        return response(__('admin.messages.deleted_successfully'));

    }//end of delete

    public function bulkDelete(DeleteRequest $request): Application | Response | ResponseFactory
    {
        InitialEvaluation::destroy(request()->ids ?? []);

        session()->flash('success', __('admin.messages.deleted_successfully'));
        return response(__('admin.messages.deleted_successfully'));

    }//end of bulkDelete

    public function status(StatusRequest $request): Application | Response | ResponseFactory
    {
        $initialEvaluation = InitialEvaluation::find($request->id);
        $initialEvaluation->update(['status' => !$initialEvaluation->status]);

        session()->flash('success', __('admin.messages.updated_successfully'));
        return response(__('admin.messages.updated_successfully'));
        
    }//end of status

	public function storeSortable()
    {        
        foreach (request('order') as $index=>$id) {
            InitialEvaluation::where('id', $id)->update(['index' => $index]);
        }
		
        session()->flash('success', __('admin.messages.updated_successfully'));
		return response(__('admin.messages.updated_successfully'));

    }//end of storeSortable

    public function filter()
    {
        $query = SelfEvaluation::query();

        if (request('organization_type_id')) {
            $query->where('organization_type_id', request('organization_type_id'));
        }

        if (request('standard_id')) {
            $fieldIds = Category::where('parent_id', request('standard_id'))->pluck('id');

            $query->whereIn('category_id', $fieldIds);
        }

        if (request('field_id')) {
            $query->where('category_id', request('field_id'));
        }

        $selfEvaluations = $query->pluck('name', 'id');

        return response()->json($selfEvaluations);
    }

}//end of controller