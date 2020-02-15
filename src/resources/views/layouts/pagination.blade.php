@section('pagination')
<div class="container">
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
      @if ($page > 1)
        <li class="page-item">
            <a class="page-link" href="home?pg={{ $page - 1 }}">
              <span aria-hidden="true">&laquo;</span>
            </a>
        </li>
        <li class="page-item">
          <a class="page-link" href="home?pg={{ $page - 1 }}">{{ $page - 1 }}</a>
        </li>
      @else
        <li class="page-item disabled">
          <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
            <span aria-hidden="true">&laquo;</span>
          </a>
        </li>
      @endif

      <li class="page-item">
          <a class="page-link" href="#">{{ $page }} <span class="sr-only">(current)</span></a>
      </li>

      @if ($page < $maxPage)
        <li class="page-item">
            <a class="page-link" href="home?page={{ $page + 1 }}">{{ $page + 1 }}</a>
        </li>
        <li class="page-item">
          <a class="page-link" href="home?page={{ $page + 1 }}">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      @else
        <li class="page-item disabled">
          <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
            <span aria-hidden="true">&raquo;</span>
          </a>
        </li>
      @endif
    </ul>
  </nav>
</div>
@endsection