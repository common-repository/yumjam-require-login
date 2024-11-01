<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
?>
<div class="wrap">
    <img style="vertical-align: middle;" src='data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+PHN2ZyAgIHhtbG5zOmRjPSJodHRwOi8vcHVybC5vcmcvZGMvZWxlbWVudHMvMS4xLyIgICB4bWxuczpjYz0iaHR0cDovL2NyZWF0aXZlY29tbW9ucy5vcmcvbnMjIiAgIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyIgICB4bWxuczpzdmc9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiAgIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgICB4bWxuczpzb2RpcG9kaT0iaHR0cDovL3NvZGlwb2RpLnNvdXJjZWZvcmdlLm5ldC9EVEQvc29kaXBvZGktMC5kdGQiICAgeG1sbnM6aW5rc2NhcGU9Imh0dHA6Ly93d3cuaW5rc2NhcGUub3JnL25hbWVzcGFjZXMvaW5rc2NhcGUiICAgdmVyc2lvbj0iMS4xIiAgIGlkPSJzdmc0MTY5IiAgIHZpZXdCb3g9IjAgMCA1My45NDYzNDIgNTQuOTU5Njc3IiAgIGhlaWdodD0iNTQuOTU5Njc1IiAgIHdpZHRoPSI1My45NDYzNDIiICAgaW5rc2NhcGU6dmVyc2lvbj0iMC45MSByMTM3MjUiICAgc29kaXBvZGk6ZG9jbmFtZT0ieXVtamFtLXJlcXVpcmUtbG9naW4taWNvbi5zdmciPiAgPHRpdGxlICAgICBpZD0idGl0bGU1NDIxIj5ZdW1KYW0gUmVxdWlyZSBMb2dpbiBJY29uPC90aXRsZT4gIDxzb2RpcG9kaTpuYW1lZHZpZXcgICAgIHBhZ2Vjb2xvcj0iI2ZmZmZmZiIgICAgIGJvcmRlcmNvbG9yPSIjNjY2NjY2IiAgICAgYm9yZGVyb3BhY2l0eT0iMSIgICAgIG9iamVjdHRvbGVyYW5jZT0iMTAiICAgICBncmlkdG9sZXJhbmNlPSIxMCIgICAgIGd1aWRldG9sZXJhbmNlPSIxMCIgICAgIGlua3NjYXBlOnBhZ2VvcGFjaXR5PSIwIiAgICAgaW5rc2NhcGU6cGFnZXNoYWRvdz0iMiIgICAgIGlua3NjYXBlOndpbmRvdy13aWR0aD0iMTMxMiIgICAgIGlua3NjYXBlOndpbmRvdy1oZWlnaHQ9Ijg1MCIgICAgIGlkPSJuYW1lZHZpZXc0MjE2IiAgICAgc2hvd2dyaWQ9ImZhbHNlIiAgICAgc2hvd2JvcmRlcj0iZmFsc2UiICAgICBmaXQtbWFyZ2luLXRvcD0iMCIgICAgIGZpdC1tYXJnaW4tbGVmdD0iMCIgICAgIGZpdC1tYXJnaW4tcmlnaHQ9IjAiICAgICBmaXQtbWFyZ2luLWJvdHRvbT0iMCIgICAgIGlua3NjYXBlOnpvb209IjExLjE2NDkxMiIgICAgIGlua3NjYXBlOmN4PSIxOS40NjEzMTQiICAgICBpbmtzY2FwZTpjeT0iMjYuNDIzODYxIiAgICAgaW5rc2NhcGU6d2luZG93LXg9IjMzMCIgICAgIGlua3NjYXBlOndpbmRvdy15PSI4OSIgICAgIGlua3NjYXBlOndpbmRvdy1tYXhpbWl6ZWQ9IjAiICAgICBpbmtzY2FwZTpjdXJyZW50LWxheWVyPSJsYXllcjIiIC8+ICA8ZGVmcyAgICAgaWQ9ImRlZnM0MTcxIiAvPiAgPG1ldGFkYXRhICAgICBpZD0ibWV0YWRhdGE0MTc0Ij4gICAgPHJkZjpSREY+ICAgICAgPGNjOldvcmsgICAgICAgICByZGY6YWJvdXQ9IiI+ICAgICAgICA8ZGM6Zm9ybWF0PmltYWdlL3N2Zyt4bWw8L2RjOmZvcm1hdD4gICAgICAgIDxkYzp0eXBlICAgICAgICAgICByZGY6cmVzb3VyY2U9Imh0dHA6Ly9wdXJsLm9yZy9kYy9kY21pdHlwZS9TdGlsbEltYWdlIiAvPiAgICAgICAgPGRjOnRpdGxlPll1bUphbSBSZXF1aXJlIExvZ2luIEljb248L2RjOnRpdGxlPiAgICAgIDwvY2M6V29yaz4gICAgPC9yZGY6UkRGPiAgPC9tZXRhZGF0YT4gIDxnICAgICBpZD0iZzM2ODYiICAgICBzdHlsZT0iZmlsbDojOWYwOTQ1O2ZpbGwtb3BhY2l0eToxIiAgICAgdHJhbnNmb3JtPSJtYXRyaXgoMS40NzE1NTg5LDAsMCwxLjQ3MTU1ODksMi43NDg5NzQ3LDIuNzAxNDQ3OCkiPiAgICA8cGF0aCAgICAgICBkPSJtIDguNjczLDQuNzkxIDE1LjY1NCwwIGMgMCwwIDEuNTA4LC0wLjcxOCAxLjUwOCwtMi4wOSAwLC0xLjk4OSAtMS44NTUsLTIuMjAxIC0yLjg0MiwtMi4yMDEgLTAuOTg1LDAgLTYuNDkzLDAgLTYuNDkzLDAgMCwwIC01LjUwOCwwIC02LjQ5MywwIC0wLjk4NiwwIC0yLjg0MiwwLjIxMiAtMi44NDIsMi4yMDEgMCwxLjM3MiAxLjUwOCwyLjA5IDEuNTA4LDIuMDkgeiIgICAgICAgaWQ9InBhdGgzNjgyIiAgICAgICBzdHlsZT0iZmlsbDojOWYwOTQ1O2ZpbGwtb3BhY2l0eToxIiAgICAgICBpbmtzY2FwZTpjb25uZWN0b3ItY3VydmF0dXJlPSIwIiAvPiAgICA8cGF0aCAgICAgICBkPSJtIDI0Ljk5OCw1Ljg2NCAtMTYuOTk3LDAgLTEuNTA0LDIuNDA3IGMgMi41LDAgMi41LDEuODU2IDUsMS44NTYgMi41LDAgMi41LC0xLjg1NiA1LC0xLjg1NiAyLjUwMiwwIDIuNTAyLDEuODU2IDUuMDA0LDEuODU2IDIuNTAyLDAgMi41MDIsLTEuODU2IDUuMDAyLC0xLjg1NiBMIDI0Ljk5OCw1Ljg2NCBaIiAgICAgICBpZD0icGF0aDM2ODQiICAgICAgIHN0eWxlPSJmaWxsOiM5ZjA5NDU7ZmlsbC1vcGFjaXR5OjEiICAgICAgIGlua3NjYXBlOmNvbm5lY3Rvci1jdXJ2YXR1cmU9IjAiIC8+ICA8L2c+ICA8cGF0aCAgICAgZD0ibSA0NS4zNjIzNzgsNDAuNzk4NjM2IDAsLTcuMDg0MDg0IGMgMCwtNy4xNzM4NSAtMC4yODY5NTQsLTEwLjM2MjcxOCAtMy4wNzI2MTUsLTEzLjg5NDQ1OSAtMC43NDE2NjYsLTAuOTQzMjcgLTEuMzQ1MDA1LC0xLjkxMTU1NSAtMS44NDM4NjQsLTIuODY5NTQgLTIuMTk0MDk0LDAuNjY4MDg3IC0yLjc1MTgxNSwyLjUzODQzOSAtNS44NTgyNzYsMi41Mzg0MzkgLTMuNzgwNDM0LDAgLTQuNTI2NTE1LC0yLjc3Mzg4OSAtNy41NTc5MjYsLTIuNzczODg5IC0zLjAzMTQxMiwwIC0zLjc4MDQzNSwyLjc3Mzg4OSAtNy41NjA4NywyLjc3Mzg4OSAtMy4xMDM1MTgsMCAtMy42NjEyMzksLTEuODY4ODggLTUuODU2ODA1LC0yLjUzODQzOSAtMC40OTczODYsMC45NTY1MTMgLTEuMTAwNzI2LDEuOTI2MjcgLTEuODQyMzkxLDIuODY5NTQgLTIuNzg1NjYxMiwzLjUzMTc0MSAtMy4wNzI2MTUyLDYuNzIwNjA5IC0zLjA3MjYxNTIsMTMuODk0NDU5IGwgMCw3LjA4NDA4NCBjIDAsMi4xOTk5ODEgLTAuNjg0Mjc0OSw5LjcyODQ3NiA4LjM2Mjg2OTIsOS43Mjg0NzYgbCA5Ljk2OTgxMiwwIDkuOTY5ODExLDAgYyA5LjA0NTY3MywwIDguMzYyODcsLTcuNTI4NDk1IDguMzYyODcsLTkuNzI4NDc2IHoiICAgICBpZD0icGF0aDM2ODgiICAgICBzdHlsZT0iZmlsbDojOWMwOTQ1O2ZpbGwtb3BhY2l0eToxIiAgICAgaW5rc2NhcGU6Y29ubmVjdG9yLWN1cnZhdHVyZT0iMCIgICAgIHNvZGlwb2RpOm5vZGV0eXBlcz0ic3NjY3Nzc2Njc3NzY3NzIiAvPiAgPGcgICAgIGlua3NjYXBlOmdyb3VwbW9kZT0ibGF5ZXIiICAgICBpZD0ibGF5ZXIyIiAgICAgaW5rc2NhcGU6bGFiZWw9InNxdWFyZSIgICAgIHN0eWxlPSJkaXNwbGF5OmlubGluZSIgICAgIHRyYW5zZm9ybT0idHJhbnNsYXRlKDE0LjY4NjU4MiwxMS4wMzMwODkpIiAvPiAgPGcgICAgIGlkPSJzdXJmYWNlMSIgICAgIHRyYW5zZm9ybT0ibWF0cml4KDAuOTMwNjEzMjUsMCwwLDAuOTMwNjEzMjUsMTEuOTA1NDQ2LDIxLjMyNjQ2KSIgICAgIHN0eWxlPSJmaWxsOiNmZmZmZmYiPiAgICA8cGF0aCAgICAgICBpZD0icGF0aDU0MTEiICAgICAgIGQ9Ik0gMTYsMCBDIDEzLjc4OTA2MywwIDExLjg3ODkwNiwwLjkxNzk2OSAxMC42ODc1LDIuNDA2MjUgOS40OTYwOTQsMy44OTQ1MzEgOSw1LjgyNDIxOSA5LDcuOTA2MjUgTCA5LDkgMTIsOSAxMiw3LjkwNjI1IEMgMTIsNi4zMjgxMjUgMTIuMzkwNjI1LDUuMDg1OTM4IDEzLjAzMTI1LDQuMjgxMjUgMTMuNjcxODc1LDMuNDc2NTYzIDE0LjU0Mjk2OSwzIDE2LDMgMTcuNDYwOTM4LDMgMTguMzI4MTI1LDMuNDQ5MjE5IDE4Ljk2ODc1LDQuMjUgMTkuNjA5Mzc1LDUuMDUwNzgxIDIwLDYuMzA4NTk0IDIwLDcuOTA2MjUgTCAyMCw5IDIzLDkgMjMsNy45MDYyNSBDIDIzLDUuODEyNSAyMi40NzI2NTYsMy44NjMyODEgMjEuMjgxMjUsMi4zNzUgMjAuMDg5ODQ0LDAuODg2NzE5IDE4LjIwNzAzMSwwIDE2LDAgWiBNIDksMTAgYyAtMS42NTYyNSwwIC0zLDEuMzQzNzUgLTMsMyBsIDAsMTAgYyAwLDEuNjU2MjUgMS4zNDM3NSwzIDMsMyBsIDE0LDAgYyAxLjY1NjI1LDAgMywtMS4zNDM3NSAzLC0zIGwgMCwtMTAgYyAwLC0xLjY1NjI1IC0xLjM0Mzc1LC0zIC0zLC0zIHogbSA3LDUgYyAxLjEwNTQ2OSwwIDIsMC44OTQ1MzEgMiwyIDAsMC43MzgyODEgLTAuNDAyMzQ0LDEuMzcxMDk0IC0xLDEuNzE4NzUgTCAxNywyMSBjIDAsMC41NTA3ODEgLTAuNDQ5MjE5LDEgLTEsMSAtMC41NTA3ODEsMCAtMSwtMC40NDkyMTkgLTEsLTEgbCAwLC0yLjI4MTI1IEMgMTQuNDAyMzQ0LDE4LjM3MTA5NCAxNCwxNy43MzgyODEgMTQsMTcgYyAwLC0xLjEwNTQ2OSAwLjg5NDUzMSwtMiAyLC0yIHoiICAgICAgIGlua3NjYXBlOmNvbm5lY3Rvci1jdXJ2YXR1cmU9IjAiICAgICAgIHN0eWxlPSJmaWxsOiNmZmZmZmYiIC8+ICA8L2c+PC9zdmc+' >

    <h1 style="display: inline-block;">
        Welcome to YumJam Require Login
    </h1>    
    <form method="post" action="options.php">
        <?php settings_fields('rl_options_group1'); ?>
        <?php do_settings_sections('rl_options'); ?>
        <?php submit_button(null,'primary','submit', true , array('id' => 'rl_submit') ); ?>
    </form>
</div>