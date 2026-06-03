<?php

namespace App\Http\Controllers\Dashboard\Admin\Websites;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\Websites\Packages\PricingSettingRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class PricingSettingController extends Controller
{
    public function index(): View
    {
        abort_if(!permissionAdmin('read-packages'), 403);

        $breadcrumb = [
            ['trans' => 'admin.models.websites'],
            ['trans' => 'admin.models.packages', 'route' => 'dashboard.admin.websites.packages.index'],
            ['trans' => 'admin.settings.general'],
        ];

        return view('dashboard.admin.websites.packages.setting', compact('breadcrumb'));

    }//end of index

    public function store(PricingSettingRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('custom_image')) {
            $old = setting('pricing_page')->toArray()['custom_image'] ?? null;
            if ($old) Storage::disk('public')->delete($old);
            $data['custom_image'] = $request->file('custom_image')->store('pricing_page', 'public');
        } else {
            unset($data['custom_image']);
        }

        // Preserve non-form fields that we don't edit here
        $existing = setting('pricing_page')->toArray();
        $data = array_merge($existing, $data);

        setting('pricing_page')->save($data);

        session()->flash('success', __('admin.messages.updated_successfully'));
        return redirect()->back();

    }//end of store

}//end of controller
