<?php

namespace App\Http\Controllers\Dashboard\Organization\Auth\Account;

use App\Http\Requests\Dashboard\Organization\Auth\Account\ProfileRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Models\Organization;

class ProfileController extends Controller
{
    public function edit(): View
    {
        abort_if(!auth('organization')->check(), 403);

        $breadcrumb   = [['trans' => 'admin.auth.edit_profile']];
        $organization = auth('organization')->user();

        return view('dashboard.organization.auth.accounts.edit_profile', compact('organization', 'breadcrumb'));

    }//end of edit page

    public function update(ProfileRequest $request, Organization $organization): RedirectResponse
    {
        $validated = $request->safe()->except(['image']);

        if(request()->hasFile('image')) {

            $organization->image != 'default.png' ? Storage::disk('public')->delete($organization->image) : '';

            $validated['image'] = request()->file('image')->store('admins', 'public');

        }

        session()->flash('success', __('admin.messages.updated_successfully'));

        $organization->update($validated);

        return redirect()->back();
        
    }//end of update

}//end of controller