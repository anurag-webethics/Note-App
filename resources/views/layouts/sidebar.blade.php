<div class="d-flex flex-column flex-shrink-0 pt-4 bg-body-tertiary" style="width: 280px;height:100vh;margin-top:-88px;">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
        <svg class="bi pe-none me-2" width="40" height="32">
            <use xlink:href="#bootstrap"></use>
        </svg>
        <span class="fs-4">Note Taking App</span>
    </a>
    <ul class="nav nav-pills flex-column mb-auto ps-4">
        <li class="nav-item  text-left">
            <a href="{{ route('notes') }}" class="nav-link" aria-current="page">
                Notes
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ route('email.send') }}" class="nav-link" aria-current="page">
                <svg class="bi pe-none me-2" width="16" height="16">
                    <use xlink:href="#home"></use>
                </svg>
                colleagues
            </a>
        </li>
        {{-- <li>
            <a href="#" class="nav-link link-body-emphasis">
                <svg class="bi pe-none me-2" width="16" height="16">
                    <use xlink:href="#grid"></use>
                </svg>
                Private
            </a>
        </li> --}}
    </ul>
</div>
