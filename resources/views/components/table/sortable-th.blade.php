<th class="text-uppercase text-xs sorting {{ $sortBy !== $field ? '' : ($sortDir === 'ASC' ? 'sorting_asc' : 'sorting_desc') }}" tabindex="0" aria-controls="data_table" rowspan="1"
    colspan="1"  style="width: {{ $width }};" wire:click="setSortBy('{{ $field }}')">
    {{ $displayName }}
</th>
