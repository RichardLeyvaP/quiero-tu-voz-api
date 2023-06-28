<?php

namespace App\Helpers\FieldsOptions;

/**
 * Opciones disponibles para el campo Roles
 */
enum RoleFieldOptions: int implements BaseFunctionsFieldsOptions
{
    case ADMIN = 1;
    case LOCUTOR = 2;
    case CUSTOMER = 3;

    public function label(): string
    {
        return match ($this) {
            static::ADMIN => __('Administrador'),
            static::LOCUTOR => __('Locutor'),
            static::CUSTOMER => __('Cliente')
        };
    }

    public static function toArray(): array
    {
        $options = [];
        foreach (static::cases() as $case)
            $options[] = array('value' => $case->value, 'label' => $case->label());

        return $options;
    }

    public function jsonSerialize(): mixed
    {
        return array('value' => $this->value, 'label' => $this->label());
    }
}
