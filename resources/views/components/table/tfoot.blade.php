@props(['page'])
@php
    $first = $page->firstItem();
    $last = $page->lastItem();
    $total = $page->total();
@endphp
<tfoot>
    <tr>
        <td colspan="12">
            @if($total > 0)
                {{ __('Showing') }} {{ $first }} {{ __('to') }} {{ $last }} {{ __('of') }} {{ $total }} {{ __('results') }}
            @else
                {{ __('No results') }}
            @endif
        </td>
    </tr>
    
</tfoot>
