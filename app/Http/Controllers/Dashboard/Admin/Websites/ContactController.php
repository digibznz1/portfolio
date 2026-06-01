<?php

namespace App\Http\Controllers\Dashboard\Admin\Websites;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\Websites\Contacts\DeleteRequest;
use App\Http\Requests\Dashboard\Admin\Websites\Contacts\StatusRequest;
use App\Models\Contact;
use App\Enums\ContactTypeEnum;
use App\Enums\ContactStatusEnum;
use Illuminate\View\View;
use Illuminate\Http\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;

class ContactController extends Controller
{
    public function index(): View
    {
        abort_if(!permissionAdmin('read-contacts'), 403);

        $datatables = datatableServices()
            ->header([
                'admin.global.type',
                'admin.global.name',
                'admin.global.email',
                'admin.global.date',
                'admin.global.status',
            ])
            ->checkbox(['status' => 'dashboard.admin.websites.contacts.status'])
            ->route('dashboard.admin.websites.contacts.data')
            ->columns(['type', 'name', 'email', 'created_at', 'status'])
            ->run();

        $breadcrumb = [
            ['trans' => 'admin.models.websites'],
            ['trans' => 'admin.models.contacts'],
        ];

        return view('dashboard.admin.websites.contacts.index', compact('breadcrumb', 'datatables'));

    }//end of index

    public function data(): object
    {
        $permissions = [
            'show'   => permissionAdmin('read-contacts'),
            'status' => permissionAdmin('status-contacts'),
            'delete' => permissionAdmin('delete-contacts'),
        ];

        return dataTables()->of(Contact::query()->latest())
            ->addColumn('record_select', 'dashboard.admin.dataTables.record_select')
            ->editColumn('type', fn(Contact $c) => view('dashboard.admin.websites.contacts.data_tables.type', compact('c')))
            ->editColumn('name', fn(Contact $c) => '<div><p class="font-medium">' . e($c->name) . '</p><p class="text-xs text-gray-400">' . e($c->company_name ?? '') . '</p></div>')
            ->editColumn('email', fn(Contact $c) => '<a href="mailto:' . e($c->email) . '" class="text-primary hover:underline text-sm">' . e($c->email) . '</a>')
            ->editColumn('created_at', fn(Contact $c) => $c->created_at->format('Y-m-d'))
            ->addColumn('status', fn(Contact $c) => view('dashboard.admin.websites.contacts.data_tables.status', compact('c'), ['permissions' => $permissions]))
            ->addColumn('actions', fn(Contact $c) => datatableAction($c, $permissions)->buttons(['show', 'delete'])->build())
            ->rawColumns(['record_select', 'actions', 'status', 'type', 'name', 'email'])
            ->addIndexColumn()
            ->toJson();

    }//end of data

    public function show(Contact $contact): View
    {
        abort_if(!permissionAdmin('read-contacts'), 403);

        // Auto-mark as read when opened
        if ($contact->status->value === 'new') {
            $contact->update(['status' => 'read']);
        }

        $breadcrumb = [
            ['trans' => 'admin.models.websites'],
            ['trans' => 'admin.models.contacts', 'route' => 'dashboard.admin.websites.contacts.index'],
            ['trans' => 'admin.global.show'],
        ];

        return view('dashboard.admin.websites.contacts.show', compact('contact', 'breadcrumb'));

    }//end of show

    public function status(StatusRequest $request): Application|Response|ResponseFactory
    {
        Contact::find($request->id)?->update(['status' => $request->status]);

        return response(__('admin.messages.updated_successfully'));

    }//end of status

    public function destroy(Contact $contact): Application|Response|ResponseFactory
    {
        $contact->delete();

        return response(__('admin.messages.deleted_successfully'));

    }//end of destroy

    public function bulkDelete(DeleteRequest $request): Application|Response|ResponseFactory
    {
        Contact::destroy(request()->ids ?? []);

        return response(__('admin.messages.deleted_successfully'));

    }//end of bulkDelete

}//end of controller
