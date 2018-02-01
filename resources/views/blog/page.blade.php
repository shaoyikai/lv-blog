<div class="pagenavigation">
    <div class="pagenav">
        <!-- Previous Page Link -->
        @if ($paginator->onFirstPage())

        @else
            <div class="left"><a href="{{ $paginator->previousPageUrl() }}">&laquo; Previous Page</a></div>
        @endif

        <!-- Next Page Link -->
        @if ($paginator->hasMorePages())
            <div class="right"><a href="{{ $paginator->nextPageUrl() }}">Next Page &raquo;</a></div>
        @else

        @endif

        <div class="clearer">&nbsp;</div>
    </div>
    <div class="pagenav_bottom"></div>
</div>