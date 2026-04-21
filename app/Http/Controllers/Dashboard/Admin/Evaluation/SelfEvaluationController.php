<?php

namespace App\Http\Controllers\Dashboard\Admin\Evaluation;

use App\Admin\SelfEvaluation\AlertTypeEnums;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\Evaluation\SelfEvaluation\SelfEvaluationRequest;
use App\Http\Requests\Dashboard\Admin\Evaluation\SelfEvaluation\StatusRequest;
use App\Http\Requests\Dashboard\Admin\Evaluation\SelfEvaluation\DeleteRequest;
use App\Models\Category;
use App\Models\InitialEvaluation;
use App\Models\OrganizationType;
use App\Models\SelfEvaluation;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\Facades\Storage;

class SelfEvaluationController extends Controller
{
    public function index(): View
    {
        abort_if(!permissionAdmin('read-self_evaluations'), 403);

        $datatables = datatableServices()
                        ->header([
                            'admin.global.name',
                            'admin.evaluations.self_evaluations.alert',
                            'admin.evaluations.self_evaluations.explain',
                            'admin.evaluations.self_evaluations.degree',
                            'admin.models.organization_types',
                            'admin.global.status',
                            'admin.files.file',
                        ])
                        ->checkbox(['status' => 'dashboard.admin.evaluations.self_evaluations.status'])
                        ->route('dashboard.admin.evaluations.self_evaluations.data')
						->sortable('dashboard.admin.evaluations.self_evaluations.sortable.store')
                        ->columns(['name', 'alert', 'explain', 'degree', 'organization_type', 'status', 'files'])
                        ->run();
        $organizationTypes = OrganizationType::pluck('name', 'id');

        $breadcrumb = [['trans' => 'admin.models.evaluations'],['trans' => 'admin.evaluations.initial_evaluations.model']];

        return view('dashboard.admin.evaluations.self_evaluations.index', compact('datatables', 'breadcrumb', 'organizationTypes'));

    }//end of index

    public function data(): object
    {
        $permissions = [
            'status' => permissionAdmin('status-self_evaluations'),
            'update' => permissionAdmin('update-self_evaluations'),
            'delete' => permissionAdmin('delete-self_evaluations'),
        ];

        $selfEvaluation = SelfEvaluation::organizationTypeJoin();

        if (request('status') == '0' || request('status') == '1') $selfEvaluation->where('status', request('status'));

        if (request('organization_type')) $selfEvaluation->where('organization_type_id', request('organization_type'));

        return dataTables()->of($selfEvaluation)
                ->addColumn('record_select', 'dashboard.admin.dataTables.record_select')
                ->addColumn('files', fn (SelfEvaluation $selfEvaluation) => '
                    <div class="d-flex gap-1">
                        <a href="' . route('dashboard.admin.evaluations.self_evaluations.self_evaluation_files.index', ['self_evaluation' => $selfEvaluation->id]) . '" class="kt-btn kt-btn-primary kt-sm d-flex align-items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-file-output-icon lucide-file-output"><path d="M4.226 20.925A2 2 0 0 0 6 22h12a2 2 0 0 0 2-2V8a2.4 2.4 0 0 0-.706-1.706l-3.588-3.588A2.4 2.4 0 0 0 14 2H6a2 2 0 0 0-2 2v3.127" data--h-bstatus="0OBSERVED"/><path d="M14 2v5a1 1 0 0 0 1 1h5" data--h-bstatus="0OBSERVED"/><path d="m5 11-3 3" data--h-bstatus="0OBSERVED"/><path d="m5 17-3-3h10" data--h-bstatus="0OBSERVED"/></svg>
                        </a>
                    </div>
                ')
                ->addColumn('actions', fn(SelfEvaluation $selfEvaluation) => datatableAction($selfEvaluation, $permissions)->buttons()->build())
                ->addColumn('status', fn (SelfEvaluation $selfEvaluation) => view('dashboard.admin.dataTables.checkbox', ['models' => $selfEvaluation, 'permissions' => $permissions, 'type' => 'status']))
                ->addColumn('answer', fn (SelfEvaluation $selfEvaluation) => trans('admin.global.' . $selfEvaluation->answer))
                ->editColumn('description', fn (SelfEvaluation $selfEvaluation) => str()->limit($selfEvaluation->description, 70))
                ->editColumn('alert', fn (SelfEvaluation $selfEvaluation) => str()->limit($selfEvaluation->alert, 70))
                ->editColumn('explain', fn (SelfEvaluation $selfEvaluation) => str()->limit($selfEvaluation->explain, 70))
                ->addColumn('organization_type', fn (SelfEvaluation $selfEvaluation) => $selfEvaluation->organization_type_name)
                ->rawColumns(['record_select', 'actions', 'status', 'description', 'explain', 'degree', 'files', 'organization_type'])
                ->addIndexColumn()
                ->toJson();

    }//end of data

    public function create(): View
    {
        abort_if(!permissionAdmin('create-self_evaluations'), 403);

        $breadcrumb = [
            ['trans' => 'admin.models.evaluations'],
            [
                'route' => 'dashboard.admin.evaluations.self_evaluations.index',
                'trans' => 'admin.evaluations.self_evaluations.model',
            ],
            [
                'route' => '#',
                'trans' => 'admin.global.create',
            ]
        ];

        $initialEvaluations = InitialEvaluation::pluck('question', 'id');
        $standards          = Category::standards()->pluck('name', 'id');
        $fields             = Category::fields()->get(['id', 'name', 'parent_id']);
        $organizationTypes  = OrganizationType::pluck('name', 'id');
        $alerTypes          = AlertTypeEnums::options();
        
        return view('dashboard.admin.evaluations.self_evaluations.create', compact('breadcrumb', 'initialEvaluations', 'standards', 'fields', 'alerTypes', 'organizationTypes'));
        
    }//end of create

    //RedirectResponse
    public function store(SelfEvaluationRequest $request): RedirectResponse
    {
        $validated = $request->safe()->except(['standard_id', 'alert_value']);

        if(request()->file('alert_value')) {

            $validated['alert_value'] = request()->file('alert_value')->store('self_evaluations', 'public');

        }

        $selfEvaluation = SelfEvaluation::create($validated);
        $selfEvaluation->initialEvaluations()->sync($request->self_evaluations ?? []);

        session()->flash('success', __('admin.messages.added_successfully'));
        return to_route('dashboard.admin.evaluations.self_evaluations.index');

    }//end of store

    public function edit(SelfEvaluation $selfEvaluation): View
    {
        abort_if(!permissionAdmin('update-self_evaluations'), 403);

        $breadcrumb = [
            ['trans' => 'admin.models.evaluations'],
            [
                'route' => 'dashboard.admin.evaluations.self_evaluations.index',
                'trans' => 'admin.evaluations.self_evaluations.model',
            ],
            [
                'route' => '#',
                'trans' => 'admin.global.edit',
            ]
        ];

        $initialEvaluations = InitialEvaluation::pluck('question', 'id');
        $standards          = Category::standards()->pluck('name', 'id');
        $fields             = Category::fields()->get(['id', 'name', 'parent_id']);
        $organizationTypes  = OrganizationType::pluck('name', 'id');
        $alerTypes          = AlertTypeEnums::options();
        
        return view('dashboard.admin.evaluations.self_evaluations.edit', compact('standards', 'initialEvaluations', 'fields', 'selfEvaluation', 'alerTypes', 'breadcrumb', 'organizationTypes'));

    }//end of edit

    public function update(SelfEvaluationRequest $request, SelfEvaluation $selfEvaluation): RedirectResponse
    {
        $validated = $request->safe()->except(['standard_id', 'alert_value']);
        
        if($selfEvaluation->alert_type == 'file' && request('alert_type') != 'file') Storage::disk('public')->delete($selfEvaluation->alert_value);

        if(request()->file('alert_value')) {

            $validated['alert_value'] = request()->file('alert_value')->store('self_evaluations', 'public');
        }

        $selfEvaluation->update($validated);
        $selfEvaluation->initialEvaluations()->sync($request->self_evaluations ?? []);
        
        session()->flash('success', __('admin.messages.updated_successfully'));
        return to_route('dashboard.admin.evaluations.self_evaluations.index');
        
    }//end of update

    public function destroy(SelfEvaluation $selfEvaluation): Application | Response | ResponseFactory
    {
        if($selfEvaluation->alert_type == 'file') Storage::disk('public')->delete($selfEvaluation->alert_value);

        $selfEvaluation->delete();

        session()->flash('success', __('admin.messages.deleted_successfully'));
        return response(__('admin.messages.deleted_successfully'));

    }//end of delete

    public function bulkDelete(DeleteRequest $request): Application | Response | ResponseFactory
    {
        SelfEvaluation::destroy(request()->ids ?? []);

        session()->flash('success', __('admin.messages.deleted_successfully'));
        return response(__('admin.messages.deleted_successfully'));

    }//end of bulkDelete

    public function status(StatusRequest $request): Application | Response | ResponseFactory
    {
        $selfEvaluation = SelfEvaluation::find($request->id);
        $selfEvaluation->update(['status' => !$selfEvaluation->status]);

        session()->flash('success', __('admin.messages.updated_successfully'));
        return response(__('admin.messages.updated_successfully'));
        
    }//end of status

	public function storeSortable()
    {        
        foreach (request('order') as $index=>$id) {
            SelfEvaluation::where('id', $id)->update(['index' => $index]);
        }
		
        session()->flash('success', __('admin.messages.updated_successfully'));
		return response(__('admin.messages.updated_successfully'));

    }//end of storeSortable

}//end of controller