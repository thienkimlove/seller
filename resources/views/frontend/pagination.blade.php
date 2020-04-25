@if ($paginate->lastPage() > 1)
    <div class="page">
        <ul class="rs">
            <li><i>Trang {{$paginate->currentPage()}}/{{$paginate->lastPage()}}</i></li>
            @for ($i = 1; $i <= (($paginate->lastPage() > 5) ? 5 : $paginate->lastPage()); $i++)
                <li>
                    <a class="{{ ($paginate->currentPage() == $i) ? 'active' : '' }}" href="{{ $paginate->url($i) }}">Trang {{ $i }}</a>
                </li>
            @endfor
            @if ($paginate->lastPage() > 5)
            <li><i class="arrow">→</i></li>
            <li>
                <a class="{{ ($paginate->currentPage() == $paginate->lastPage()) ? 'active' : '' }}" href="{{ $paginate->url($paginate->lastPage()) }}">Trang {{$paginate->lastPage()}}</a>
            </li>
            @endif
        </ul>
    </div>
@endif