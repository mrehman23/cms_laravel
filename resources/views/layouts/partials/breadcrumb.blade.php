@if(!empty($page_name->name))
    {{ generateBreadcrumb(['Dashboard',(!empty($page_name->name) ? $page_name->name : '')]) }}
@endif
