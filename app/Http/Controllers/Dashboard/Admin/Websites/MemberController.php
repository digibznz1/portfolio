<?php

namespace App\Http\Controllers\Dashboard\Admin\Websites;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\Websites\Members\MemberRequest;
use App\Http\Requests\Dashboard\Admin\Websites\Members\DeleteRequest;
use App\Http\Requests\Dashboard\Admin\Websites\Members\StatusRequest;
use App\Models\Member;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    public function index(): View
    {
        abort_if(!permissionAdmin('read-members'), 403);

        $datatables = datatableServices()
            ->header([
                'admin.global.image',
                'admin.global.name',
                'admin.global.type',
                'admin.global.status',
            ])
            ->checkbox(['status' => 'dashboard.admin.websites.about.members.status'])
            ->route('dashboard.admin.websites.about.members.data')
            ->columns(['image', 'name', 'position', 'status'])
            ->sortable('dashboard.admin.websites.about.members.sortable.store')
            ->run();

        $breadcrumb = [
            ['trans' => 'admin.models.websites'],
            ['trans' => 'admin.websites.about_page'],
            ['trans' => 'admin.models.members'],
        ];

        return view('dashboard.admin.websites.about.members.index', compact('breadcrumb', 'datatables'));

    }//end of index

    public function data(): object
    {
        $permissions = [
            'status' => permissionAdmin('status-members'),
            'update' => permissionAdmin('update-members'),
            'delete' => permissionAdmin('delete-members'),
        ];

        $member = Member::query();

        return dataTables()->of($member)
            ->addColumn('record_select', 'dashboard.admin.dataTables.record_select')
            ->editColumn('image', fn(Member $m) => $m->image
                ? '<img src="' . asset('storage/' . $m->image) . '" class="w-12 h-12 rounded-xl object-cover" />'
                : '<span class="material-symbols-outlined text-outline-variant">person</span>')
            ->editColumn('name', fn(Member $m) => '<div><p class="font-medium">' . e($m->name) . '</p><p class="text-xs text-gray-400">' . e($m->position) . '</p></div>')
            ->editColumn('position', fn(Member $m) => e($m->position))
            ->addColumn('status', fn(Member $m) => view('dashboard.admin.dataTables.checkbox', ['models' => $m, 'permissions' => $permissions, 'type' => 'status']))
            ->addColumn('actions', fn(Member $m) => datatableAction($m, $permissions)->buttons()->build())
            ->rawColumns(['record_select', 'actions', 'status', 'image', 'name'])
            ->addIndexColumn()
            ->toJson();

    }//end of data

    public function create(): View
    {
        abort_if(!permissionAdmin('create-members'), 403);

        $breadcrumb = [
            ['trans' => 'admin.models.websites'],
            ['trans' => 'admin.websites.about_page'],
            ['trans' => 'admin.models.members', 'route' => 'dashboard.admin.websites.about.members.index'],
            ['trans' => 'admin.global.create'],
        ];

        return view('dashboard.admin.websites.about.members.create', compact('breadcrumb'));

    }//end of create

    public function store(MemberRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('members', 'public');
        }

        Member::create($data);

        session()->flash('success', __('admin.messages.added_successfully'));
        return to_route('dashboard.admin.websites.about.members.index');

    }//end of store

    public function edit(Member $member): View
    {
        abort_if(!permissionAdmin('update-members'), 403);

        $breadcrumb = [
            ['trans' => 'admin.models.websites'],
            ['trans' => 'admin.websites.about_page'],
            ['trans' => 'admin.models.members', 'route' => 'dashboard.admin.websites.about.members.index'],
            ['trans' => 'admin.global.edit'],
        ];

        return view('dashboard.admin.websites.about.members.edit', compact('member', 'breadcrumb'));

    }//end of edit

    public function update(MemberRequest $request, Member $member): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            if ($member->image) Storage::disk('public')->delete($member->image);
            $data['image'] = $request->file('image')->store('members', 'public');
        } else {
            unset($data['image']);
        }

        $member->update($data);

        session()->flash('success', __('admin.messages.updated_successfully'));
        return to_route('dashboard.admin.websites.about.members.index');

    }//end of update

    public function destroy(Member $member): Application|Response|ResponseFactory
    {
        if ($member->image) Storage::disk('public')->delete($member->image);
        $member->delete();

        session()->flash('success', __('admin.messages.deleted_successfully'));
        return response(__('admin.messages.deleted_successfully'));

    }//end of destroy

    public function bulkDelete(DeleteRequest $request): Application|Response|ResponseFactory
    {
        $members = Member::whereIn('id', request()->ids ?? [])->get();

        $members->each(fn($m) => $m->image ? Storage::disk('public')->delete($m->image) : null);

        Member::destroy($members->pluck('id')->toArray());

        session()->flash('success', __('admin.messages.deleted_successfully'));
        return response(__('admin.messages.deleted_successfully'));

    }//end of bulkDelete

    public function status(StatusRequest $request): Application|Response|ResponseFactory
    {
        $member = Member::find($request->id);
        $member->update(['status' => !$member->status]);

        session()->flash('success', __('admin.messages.updated_successfully'));
        return response(__('admin.messages.updated_successfully'));

    }//end of status

    public function storeSortable(): bool
    {
        foreach (request('order') as $index => $id) {
            Member::where('id', $id)->update(['index' => $index]);
        }

        return true;

    }//end of storeSortable

}//end of controller
