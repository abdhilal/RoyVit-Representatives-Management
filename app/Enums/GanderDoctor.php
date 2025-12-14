<?php

namespace App\Enums;

enum GanderDoctor: string
{
    case MALE = 'male';
    case FEMALE = 'female';

    /**
     * Get all gander doctor as array
     */
    public static function toArray(): array
    {
        return [
            self::MALE->value => __('male'),
            self::FEMALE->value => __('female'),
        ];
    }

    /**
     * Get the translated label for the gander doctor
     */
    public function label(): string
    {
        return match ($this) {
            self::MALE => __('male'),
            self::FEMALE => __('female'),
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
     * Get gander doctor from string value
     */
    public static function fromString(string $value): ?self
    {
        return self::tryFrom($value);
    }
}
