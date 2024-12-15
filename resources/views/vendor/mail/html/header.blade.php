<tr>
    <td class="header">
        <a href="{{ $url }}" style="display: inline-block;">
            @if (trim($slot) === 'e-Block')
                <img src="https://e-block.vercel.app/logo.png" class="logo" alt="e-Block Logo">
            @else
                {{ $slot }}
            @endif
        </a>
    </td>
</tr>