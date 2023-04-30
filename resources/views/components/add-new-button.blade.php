@can(str_replace('.index', '.create', Route::currentRouteName()))
    <div style="right:0px; position: absolute;">
        <a href="{{ route('admin.'.$entity.'.create') }}" type="button" class="btn btn-primary btn-sm"><i class="ri-add-line align-bottom me-1"></i> Add New</a>
    </div>
@endcan
