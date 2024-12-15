<table class="action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
        <td align="center" style="padding: 32px 0;"> <!-- Menambah padding vertical -->
            <table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                    <td align="center">
                        <table border="0" cellpadding="0" cellspacing="0" role="presentation">
                            <tr>
                                <td>
                                    <a href="{{ $url }}" class="button button-primary" target="_blank"
                                        rel="noopener"
                                        style="font-size: 18px; /* Lebih besar */
                                      padding: 20px 40px; /* Lebih besar */
                                      display: inline-block;
                                      min-width: 200px; /* Minimal width */
                                      text-align: center;">
                                        {{ $slot }}
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
