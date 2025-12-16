<?php

namespace App\Enums;

enum OrderStatuses: string
{
    case PENDING = 'pending';
    case ACCEPTED = 'accepted';
    case CANCELLED = 'cancelled';

    /**
     * Get all order statuses as array
     */
    public static function toArray(): array
    {
        return [
            self::PENDING->value => __('pending'),
            self::ACCEPTED->value => __('accepted'),
            self::CANCELLED->value => __('cancelled'),
        ];
    }

    /**
     * Get the translated label for the order status
     */
    public function label(): string
    {
        return match ($this) {
            self::PENDING => __('pending'),
            self::ACCEPTED => __('accepted'),
            self::CANCELLED => __('cancelled'),
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
     * Get order status from string value
     */
    public static function fromString(string $value): ?self
    {
        return self::tryFrom($value);
    }
}
