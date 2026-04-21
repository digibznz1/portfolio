<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    public array $operations = [
        'index' => 'عرض القائمة',
        'create' => 'اضافة',
        'edit' => 'تعديل',
        'delete' => 'حذف',
        //'show' => 'عرض التفاصيل',
    ];

    public array $models = [
        'dashboard' => 'لوحة المعلومات',
        'admins' => 'المشرفين',
        'roles' => 'الادوار',
        'fields' => 'المعيار',
        'standards' => 'المجال',
        'initial_evaluations' => 'الاسئلة',
        'self_evaluations' => 'المهمات',
        'self_evaluation_files' => 'ملفات المهمات',
        'organization_types' => 'انواع المؤسسات',
        'organizations' => 'المؤسسات',
    ];

    public function getModelOperations(string $model, array $ops): array
    {
        if (in_array($model, ['dashboard'])) {
            return ['index-' . $model => 'عرض القائمة'];
        }

        //unset($ops['show-' . $model]);

        return $ops;
    }

    public function generatePermissions(): array
    {
        $permissions = [];

        foreach ($this->models as $modelKey => $modelLabel) {
            $ops = [];

            foreach ($this->operations as $opKey => $opLabel) {
                $key = $opKey . '-' . $modelKey;
                $ops[$key] = $opLabel;
            }

            $permissions[$modelKey] = $this->getModelOperations($modelKey, $ops);
        }

        return $permissions;
    }
}