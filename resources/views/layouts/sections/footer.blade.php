<footer class="footer pt-5 text-white">
    <hr class="horizontal dark mb-2">
    <div class="container">
        <div class="row">
            <div class="col-md-5 mb-4 ms-auto">
                <div>
                    <div class="font-weight-bolder mb-2">
                        <a class="navbar-brand font-weight-bold" href="/" rel="tooltip"
                            data-placement="bottom" target="_blank">
                            <img src="{{ asset('img/logo/skillage-3d-logo2.png') }}"
                                class="navbar-brand-img h-100" style="max-height: 30px;" alt="...">
                        </a>
                    </div>
                    E.7, D Amerta Residence, No.6,<br />
                    Bojongsoang, Kab. Bandung, <br />
                    Jawa Barat 40288<br />

                    {{-- add social media  --}}
                    <div class="d-flex flex-row justify-content-start mt-3">
                        <a href="https://www.instagram.com/skillageid/" target="_blank" class="me-2">
                            <i class="fab fa-instagram text-white"></i>
                        </a>
                        <a href="https://www.tiktok.com/@skillageid" target="_blank" class="me-2">
                            <i class="fab fa-tiktok text-white"></i>
                        </a>                 
                        <a href="https://www.youtube.com/@skillageindonesia9328/featured" target="_blank" class="me-2">
                            <i class="fab fa-youtube text-white"></i>
                        </a>
                        <a href="mailto:idskillage@gmail.com " target="_blank" class="me-2">
                            <i class="fa fa-envelope text-white"></i>
                        </a>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-6 col-6 mb-4 me-auto ">
                <div>
                    <h6 class="text-white ms-3">COURSE</h6>
                    <ul class="flex-column  nav">
                        @foreach ($categories->take(5) as $category)
                            <li class="nav-item ">
                                <a class="nav-link text-white" href="{{route('course-list', $category->id)}}">
                                    {{ $category->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-2 col-sm-6 col-6 mb-4 me-auto">
                <div>
                    <h6 class="text-white ms-3">LEARN LANGUAGE</h6>
                    <ul class="flex-column  nav">
                        @foreach ($sub_categories->take(5) as $subcategory)
                            <li class="nav-item ">
                                <a class="nav-link text-white" href="{{route('course-list', "all") . "?sub_category=".$subcategory->id}}">
                                    {{ $subcategory->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-2 col-sm-6 col-6 mb-4 me-auto">
                <div>
                    <h6 class="text-white ms-3">RESOURCES</h6>
                    <ul class="flex-column  nav">
                        <li class="nav-item ">
                            <a class="nav-link text-white" href="/home" target="_blank">
                                Career
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link text-white" href="/home" target="_blank">
                                Blog
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </div>
    <hr style="border: 1px solid white;">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center">
                    <p class="my-1 ms-3 text-sm">
                        Copyrights ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script> PT. Permata Cendekia Indonesia
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>