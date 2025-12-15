<?php

namespace App\Enums;

enum ProductsType: string
{
    case GIFT = 'gift';
    case MEDICINE = 'medicine';

    /**
     * Get all products type as array
     */
    public static function toArray(): array
    {
        return [
            self::GIFT->value => __('gift'),
            self::MEDICINE->value => __('medicine'),
        ];
    }

    /**
     * Get the translated label for the products type
     */
    public function label(): string
    {
        return match ($this) {
            self::GIFT => __('gift'),
            self::MEDICINE => __('medicine'),
        };
    }

    /**
     * Get all cases as options for select inputs
     */
    public static function options(): array
    {
        $options = [];
        foreach (self::cases() as $case) {
            $options[] = [
                'value' => $case->value,
                'label' => $case->label(),
            ];
        }
        return $options;
    }

    /**
     * Get products type from string value
     */
    public static function fromString(string $value): ?self
    {
        return self::tryFrom($value);
    }
}
