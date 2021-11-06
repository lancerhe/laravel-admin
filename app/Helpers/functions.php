<?php

use Illuminate\Support\HtmlString;

if (!function_exists('redirects_to')) {
    /**
     * Generate a CSRF token form field.
     *
     * @return \Illuminate\Support\HtmlString
     */
    function redirects_to(): HtmlString {
        return new HtmlString('<input type="hidden" name="redirects_to" value="' . URL::previous() . '">');
    }
}
