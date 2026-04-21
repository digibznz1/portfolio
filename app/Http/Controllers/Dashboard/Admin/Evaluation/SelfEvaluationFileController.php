<?php

namespace App\Http\Controllers\Dashboard\Admin\Evaluation;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\Evaluation\SelfEvaluation\SelfEvaluationFile\SelfEvaluationFileRequest;
use App\Http\Requests\Dashboard\Admin\Evaluation\SelfEvaluation\SelfEvaluationFile\StatusRequest;
use App\Http\Requests\Dashboard\Admin\Evaluation\SelfEvaluation\SelfEvaluationFile\DeleteRequest;
use App\Models\SelfEvaluation;
use App\Models\SelfEvaluationFile;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\Facades\Storage;

class SelfEvaluationFileController extends Controller
{
    public function index(SelfEvaluation $selfEvaluation): View
    {
        abort_if(!permissionAdmin('read-self_evaluation_files'), 403);

        $datatables = datatableServices()
                        ->header([
                            'admin.files.file',
                            'admin.global.description',
                            'admin.global.status',
                        ])
                        ->checkbox(['status' => 'dashboard.admin.evaluations.self_evaluations.self_evaluation_files.status'], ['self_evaluation' => $selfEvaluation->id])
                        ->route('dashboard.admin.evaluations.self_evaluations.self_evaluation_files.data', ['self_evaluation' => $selfEvaluation->id])
						->sortable('dashboard.admin.evaluations.self_evaluations.self_evaluation_files.sortable.store', ['self_evaluation' => $selfEvaluation->id])
                        ->columns(['file', 'description', 'status'])
                    ->run();

        $breadcrumb = [
            [
                'trans' => 'admin.models.evaluations',
            ],
            [
                'route' => 'dashboard.admin.evaluations.self_evaluations.index',
                'trans' => 'admin.evaluations.self_evaluations.model',
            ],
            ['trans' => 'admin.evaluations.self_evaluation_files.model']
        ];

        return view('dashboard.admin.evaluations.self_evaluations.self_evaluation_files.index', compact('datatables', 'breadcrumb', 'selfEvaluation'));

    }//end of index

    public function data(SelfEvaluation $selfEvaluation): object
    {
        $permissions = [
            'status' => permissionAdmin('status-self_evaluation_files'),
            'update' => permissionAdmin('update-self_evaluation_files'),
            'delete' => permissionAdmin('delete-self_evaluation_files'),
        ];

        $selfEvaluationFiles = $selfEvaluation->selfEvaluationFiles;

        if (request('status') == '0' || request('status') == '1') $selfEvaluationFiles->where('status', request('status'));

        return dataTables()->of($selfEvaluationFiles)
                ->addColumn('record_select', 'dashboard.admin.dataTables.record_select')
                ->editColumn('file', 'dashboard.admin.dataTables.file')
                ->addColumn('actions', fn(SelfEvaluationFile $selfEvaluationFile) => datatableAction($selfEvaluationFile, $permissions, ['self_evaluation_file' => $selfEvaluationFile->id, 'self_evaluation' => $selfEvaluation->id])->buttons()->build())
                ->addColumn('status', fn (SelfEvaluationFile $selfEvaluationFile) => view('dashboard.admin.dataTables.checkbox', ['models' => $selfEvaluationFile, 'permissions' => $permissions, 'type' => 'status']))
                ->editColumn('description', fn (SelfEvaluationFile $selfEvaluationFile) => str()->limit($selfEvaluationFile->description, 70))
                ->rawColumns(['record_select', 'actions', 'status', 'file', 'description'])
                ->addIndexColumn()
                ->toJson();

    }//end of data

    public function create(SelfEvaluation $selfEvaluation): View
    {
        abort_if(!permissionAdmin('create-self_evaluation_files'), 403);

        $breadcrumb = [
            ['trans' => 'admin.models.evaluations'],
            [
                'route' => 'dashboard.admin.evaluations.self_evaluations.index',
                'trans' => 'admin.evaluations.self_evaluations.model',
            ],
            [
                'route' => 'dashboard.admin.evaluations.self_evaluations.self_evaluation_files.index',
                'prams' => ['self_evaluation' => $selfEvaluation->id],
                'trans' => 'admin.evaluations.self_evaluation_files.model',
            ],
            [
                'route' => '#',
                'trans' => 'admin.global.create',
            ]
        ];
        
        return view('dashboard.admin.evaluations.self_evaluations.self_evaluation_files.create', compact('breadcrumb', 'selfEvaluation'));
        
    }//end of create

    //RedirectResponse
    public function store(SelfEvaluationFileRequest $request, SelfEvaluation $selfEvaluation): RedirectResponse
    {
        $validated = $request->safe()->except(['file']);

        if(request()->file('file')) {

            $validated['file'] = request()->file('file')->store('self_evaluation_files', 'public');

        }

        $selfEvaluation->selfEvaluationFiles()->create($validated);

        session()->flash('success', __('admin.messages.added_successfully'));
        return to_route('dashboard.admin.evaluations.self_evaluations.self_evaluation_files.index', $selfEvaluation->id);

    }//end of store

    public function edit(SelfEvaluation $selfEvaluation, SelfEvaluationFile $selfEvaluationFile): View
    {
        abort_if(!permissionAdmin('update-self_evaluation_files'), 403);

        $breadcrumb = [
            ['trans' => 'admin.models.evaluations'],
            [
                'route' => 'dashboard.admin.evaluations.self_evaluations.index',
                'trans' => 'admin.evaluations.self_evaluations.model',
            ],
            [
                'route' => 'dashboard.admin.evaluations.self_evaluations.self_evaluation_files.index',
                'prams' => ['self_evaluation' => $selfEvaluation->id],
                'trans' => 'admin.evaluations.self_evaluation_files.model',
            ],
            [
                'route' => '#',
                'trans' => 'admin.global.edit',
            ]
        ];
        
        return view('dashboard.admin.evaluations.self_evaluations.self_evaluation_files.edit', compact('breadcrumb', 'selfEvaluation', 'selfEvaluationFile'));

    }//end of edit

    public function update(SelfEvaluationFileRequest $request, SelfEvaluation $selfEvaluation, SelfEvaluationFile $selfEvaluationFile): RedirectResponse
    {
        $validated = $request->safe()->except(['file']);

        if(request()->file('file')) {

            Storage::disk('public')->delete($selfEvaluationFile->file);

            $validated['file'] = request()->file('file')->store('self_evaluation_files', 'public');

        }

        $selfEvaluationFile->update($validated);
        
        session()->flash('success', __('admin.messages.updated_successfully'));
        return to_route('dashboard.admin.evaluations.self_evaluations.self_evaluation_files.index', $selfEvaluation->id);
        
    }//end of update

    public function destroy(SelfEvaluation $selfEvaluation, SelfEvaluationFile $selfEvaluationFile): Application | Response | ResponseFactory
    {
        Storage::disk('public')->delete($selfEvaluationFile->file);

        $selfEvaluationFile->delete();

        session()->flash('success', __('admin.messages.deleted_successfully'));
        return response(__('admin.messages.deleted_successfully'));

    }//end of delete

    public function bulkDelete(DeleteRequest $request): Application | Response | ResponseFactory
    {
        SelfEvaluationFile::destroy(request()->ids ?? []);

        session()->flash('success', __('admin.messages.deleted_successfully'));
        return response(__('admin.messages.deleted_successfully'));

    }//end of bulkDelete

    public function status(StatusRequest $request): Application | Response | ResponseFactory
    {
        $selfEvaluationFile = SelfEvaluationFile::find($request->id);
        $selfEvaluationFile->update(['status' => !$selfEvaluationFile->status]);

        session()->flash('success', __('admin.messages.updated_successfully'));
        return response(__('admin.messages.updated_successfully'));
        
    }//end of status

	public function storeSortable()
    {        
        foreach (request('order') as $index=>$id) {
            SelfEvaluationFile::where('id', $id)->update(['index' => $index]);
        }
		
        session()->flash('success', __('admin.messages.updated_successfully'));
		return response(__('admin.messages.updated_successfully'));

    }//end of storeSortable

}//end of controller