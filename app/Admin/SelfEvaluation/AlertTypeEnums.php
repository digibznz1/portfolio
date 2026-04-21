<?php

namespace App\Admin\SelfEvaluation;

enum AlertTypeEnums : string
{
    case TEXT = 'text';
    case URL  = 'url';
    case FILE = 'file';

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public function label(): string
    {
        return __("admin.types.{$this->value}");
    }

    public static function options(): array
    {
        return collect(self::cases())
            ->mapWithKeys(fn ($case) => [
                $case->value => $case->label(),
            ])
            ->toArray();
    }
}
