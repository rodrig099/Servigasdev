@props(['url'])
<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if (trim($slot) === 'Laravel')
<img src="{{ asset('build/assets/dashboard/assets/img/favicon/favicon.ico') }}" class="logo" alt="Laravel Logo">
<h1 class="mt-3">Servigas del Huila</h1>
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
