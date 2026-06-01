<?php

namespace App\Http\Controllers\Dashboard\Admin\Websites;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\Websites\Appointments\DeleteRequest;
use App\Http\Requests\Dashboard\Admin\Websites\Appointments\StatusRequest;
use App\Models\Appointment;
use App\Enums\AppointmentStatusEnum;
use Illuminate\View\View;
use Illuminate\Http\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;

class AppointmentController extends Controller
{
    public function index(): View
    {
        abort_if(!permissionAdmin('read-appointments'), 403);

        $datatables = datatableServices()
            ->header([
                'admin.global.name',
                'admin.global.email',
                'admin.global.date',
                'admin.global.status',
            ])
            ->checkbox(['status' => 'dashboard.admin.websites.contacts.appointments.status'])
            ->route('dashboard.admin.websites.contacts.appointments.data')
            ->columns(['name', 'email', 'date', 'status'])
            ->run();

        $breadcrumb = [
            ['trans' => 'admin.models.websites'],
            ['trans' => 'admin.models.appointments'],
        ];

        return view('dashboard.admin.websites.appointments.index', compact('breadcrumb', 'datatables'));

    }//end of index

    public function data(): object
    {
        $permissions = [
            'show'   => permissionAdmin('read-appointments'),
            'status' => permissionAdmin('status-appointments'),
            'delete' => permissionAdmin('delete-appointments'),
        ];

        return dataTables()->of(Appointment::query()->latest())
            ->addColumn('record_select', 'dashboard.admin.dataTables.record_select')
            ->editColumn('name', fn(Appointment $a) => '<div><p class="font-medium">' . e($a->name) . '</p><p class="text-xs text-gray-400">' . e($a->phone ?? '') . '</p></div>')
            ->editColumn('email', fn(Appointment $a) => '<a href="mailto:' . e($a->email) . '" class="text-primary hover:underline text-sm">' . e($a->email) . '</a>')
            ->editColumn('date', fn(Appointment $a) => '<div><p class="font-medium">' . $a->date->format('Y-m-d') . '</p><p class="text-xs text-secondary font-bold">' . e($a->time_slot) . '</p></div>')
            ->addColumn('status', fn(Appointment $a) => view('dashboard.admin.websites.appointments.data_tables.status', compact('a'), ['permissions' => $permissions]))
            ->addColumn('actions', fn(Appointment $a) => datatableAction($a, $permissions)
                ->baseRoute('dashboard.admin.websites.contacts.appointments')
                ->buttons(['show', 'delete'])
                ->build())
            ->rawColumns(['record_select', 'actions', 'status', 'name', 'email', 'date'])
            ->addIndexColumn()
            ->toJson();

    }//end of data

    public function show(Appointment $appointment): View
    {
        abort_if(!permissionAdmin('read-appointments'), 403);

        $breadcrumb = [
            ['trans' => 'admin.models.websites'],
            ['trans' => 'admin.models.appointments', 'route' => 'dashboard.admin.websites.contacts.appointments.index'],
            ['trans' => 'admin.global.show'],
        ];

        return view('dashboard.admin.websites.appointments.show', compact('appointment', 'breadcrumb'));

    }//end of show

    public function status(StatusRequest $request): Application|Response|ResponseFactory
    {
        Appointment::find($request->id)?->update(['status' => $request->status]);

        return response(__('admin.messages.updated_successfully'));

    }//end of status

    public function destroy(Appointment $appointment): Application|Response|ResponseFactory
    {
        $appointment->delete();

        return response(__('admin.messages.deleted_successfully'));

    }//end of destroy

    public function bulkDelete(DeleteRequest $request): Application|Response|ResponseFactory
    {
        Appointment::destroy(request()->ids ?? []);

        return response(__('admin.messages.deleted_successfully'));

    }//end of bulkDelete

}//end of controller
