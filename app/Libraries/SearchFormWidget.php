<?php

namespace App\Libraries;

use Illuminate\Support\HtmlString;

class SearchFormWidget {

    public static function createSortButton($sortBy, $sort, $currentSortField): HtmlString {
        return new HtmlString(
            '<i class="fa ' . ($sortBy == $currentSortField ? "fa-sort-{$sort}" : "fa-sort") . '"></i>'
        );
    }

    public static function createSortHiddenValue($sortBy, $sort): HtmlString {
        return new HtmlString(
            '<input type="hidden" name="sort_by" value="' . $sortBy . '">
            <input type="hidden" name="sort" value="' . $sort . '">'
        );
    }

    public static function createFuzzyQuery($value, $reset, $placeholder = 'Keyowrds...'): HtmlString {
        return new HtmlString(
            '<input type="text" name="query" id="query"  class="form-control pull-right ' . ($value ? 'bg-filtered' : '') . '" placeholder="' . $placeholder . '" value="' . $value . '">
            <div class="input-group-btn">
                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                <a type="button" class="btn btn-default" href="' . $reset . '"><i class="fa fa-window-close"></i></a>
            </div>');
    }
}
