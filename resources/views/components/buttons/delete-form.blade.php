    @props([
        'action' => '',
        'text' => 'delete',
        'class' => 'btn btn-outline-danger btn-sm',
        'confirmTitle' => 'Are you sure?',
        'confirmText' => "You won't be able to revert this!",
        'confirmIcon' => 'warning',
        'confirmButtonText' => 'Yes, delete it!',
        'cancelButtonText' => 'Cancel',
        'confirmButtonColor' => '#2e8e87',
        'cancelButtonColor' => '#C42A02',
    ])
   <form action="{{ $action }}" method="POST" style="display:inline-block">
        @csrf
        @method('DELETE')
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
