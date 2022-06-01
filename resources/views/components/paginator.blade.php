<div class="col-md-12">
    {{ $records->appends(request()->query())->links() }}
</div>
