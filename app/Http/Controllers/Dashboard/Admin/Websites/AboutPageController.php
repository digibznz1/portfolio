<?php

namespace App\Http\Controllers\Dashboard\Admin\Websites;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Admin\Websites\AboutPage\AboutPageRequest;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;

class AboutPageController extends Controller
{
    public function index(): View
    {
        abort_if(!permissionAdmin('read-about-page'), 403);

         $breadcrumb = [
            ['trans' => 'admin.models.websites'],
            ['trans' => 'admin.websites.about'],
            ['trans' => 'admin.websites.about_page'],
        ];

        return view('dashboard.admin.websites.about-page.settings', compact('breadcrumb'));

    }//end of index

    public function store(AboutPageRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if ($request->hasFile('hero_image')) {
            $old = setting('about_page')->getValue('hero_image');
            if ($old) Storage::disk('public')->delete($old);
            $data['hero_image'] = $request->file('hero_image')->store('about_page', 'public');
        } else {
            unset($data['hero_image']);
        }

        setting('about_page')->save($data);

        session()->flash('success', __('admin.messages.updated_successfully'));
        return redirect()->back();

    }//end of store

}//end of controller
