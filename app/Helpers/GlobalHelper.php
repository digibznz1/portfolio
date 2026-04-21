<?php

use \App\Services\DataTables\Actions\ActionBuilderServices;
use \App\Services\DataTables\DatatableServices;
//use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Support\Facades\Storage;
use \App\Models\Language;

if (!function_exists('permission_admin')) {

	function permissionAdmin(string $permission = ''): bool
	{
		return true;
		return auth('admin')->check() ? auth('admin')->user()->hasPermission($permission) : false;
	} //en dof fun

} //end of exists

if (!function_exists('datatableServices')) {

	function datatableServices(): DatatableServices
	{
		return new DatatableServices();
	} //end of fun

} //end of exists

if (!function_exists('datatableAction')) {

	function datatableAction($model = [], $permissions = [], $parameters = []): ActionBuilderServices
	{
		return new ActionBuilderServices($model, $permissions, $parameters);

	}//end of fun

}//end of exists

if (!function_exists('getLanguages')) {

	function getLanguages(bool $default = false): object
	{
		return $default ? Language::where('default', 1)->first() : Language::all();
	} //end of fun

}//end of exists


if (!function_exists('storeImage')) {
    
    function storeImage($upload, $folder): string
    {
        $path = $folder . '/' . str()->random(40) . '.PNG';

        //$image = Image::read($upload)->resize(3150, 3150);

		Storage::disk('public')->put(
            $path,
            $image->encodeByExtension('PNG', quality: 90)
        );

		return $path;

    }//end of fun

}//end of exists