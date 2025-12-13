@props([
    'action' => '',
    'text' => 'restore',
    'class' => 'btn btn-sm btn-outline-success',
    'confirmTitle' => 'Restore this item?',
    'confirmText' => 'This will reinstate the item.',
    'confirmIcon' => 'question',
    'confirmButtonText' => 'Yes, restore it!',
    'cancelButtonText' => 'Cancel',
    'confirmButtonColor' => '#2e8e87',
    'cancelButtonColor' => '#C42A02',
])
<form method="POST" action="{{ $action }}" style="display:inline-block">
    @csrf
    @method('PUT')
    <button
        type="button"
        class="{{ $class }} sweet-5"
        data-swal-title="{{ __($confirmTitle) }}"
        data-swal-text="{{ __($confirmText) }}"
        data-swal-icon="{{ $confirmIcon }}"
        data-swal-confirm="{{ __($confirmButtonText) }}"
        data-swal-cancel="{{ __($cancelButtonText) }}"
        data-swal-confirm-color="{{ $confirmButtonColor }}"
        data-swal-cancel-color="{{ $cancelButtonColor }}"
    >
        {{ __($text) }}
    </button>
</form>
