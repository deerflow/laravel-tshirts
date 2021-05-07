<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('index') }}">Shirtify</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link @if(Request::routeIs('index')) active @endif" aria-current="page"
                       href="{{ route('index') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link @if(Request::routeIs('backoffice.index')) active @endif"
                       href="{{ route('backoffice.index') }}">Backoffice</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
