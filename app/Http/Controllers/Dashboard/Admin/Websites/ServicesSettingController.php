<?php

namespace App\Http\Controllers\Dashboard\Admin\Websites;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\Websites\Services\ServicesSettingRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class ServicesSettingController extends Controller
{
    public function index(): View
    {
        abort_if(!permissionAdmin('read-services'), 403);

        $breadcrumb = [
            ['trans' => 'admin.models.websites'],
            ['trans' => 'admin.models.services', 'route' => 'dashboard.admin.websites.services.index'],
            ['trans' => 'admin.settings.general'],
        ];

        return view('dashboard.admin.websites.services.setting', compact('breadcrumb'));

    }//end of index

    public function store(ServicesSettingRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            $old = setting('services_page')->getValue('image');
            if ($old) Storage::disk('public')->delete($old);
            $data['image'] = $request->file('image')->store('services_page', 'public');
        } else {
            unset($data['image']);
        }

        setting('services_page')->save($data);

        session()->flash('success', __('admin.messages.updated_successfully'));
        return redirect()->back();

    }//end of store

}//end of controller
