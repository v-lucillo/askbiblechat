<nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
    <div class="container px-5" style = "font-size: 22px">
        <a class="navbar-brand" href="index.html"><span class="fw-bolder ">
            <!-- <img src="{{asset('askbible/img/AskBibleIcon.png')}}" alt="" width="80px"> -->
        </span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 small fw-bolder" style = "display: flex; align-items: center">
                <li class="nav-item"><a class="nav-link" href="/#home">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/#about">About</a></li>
                <li class="nav-item"><a class="nav-link" href="/#contact">Contact</a></li>
                <li class="nav-item"><a class="nav-link" href="{{route('v.bot')}}" style = "border-bottom: 1px solid; color: rgb(25, 103, 210); outline: 0px;border-width: 0px 0px 1px;border-color: rgb(25, 103, 210); background-color: rgb(255, 255, 255); ">Try it now!</a></li>
                <li class="nav-item"><a class="nav-link" href="/">
                <img src="{{asset('askbible/img/AskBibleIcon.png')}}" alt="" width="80px">
                </a></li>
            </ul>
        </div>
    </div>
</nav>