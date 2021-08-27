<tr>
<td class="header">
<a href="{{ $url }}" style="display: inline-block;">
@if ($slot === 'RedLinks')
<img src="{{ asset('images/redlinks-brand-color-logo.png') }}" class="logo" alt="Links Logo">
@else
{{ $slot }}
@endif
</a>
</td>
</tr>
