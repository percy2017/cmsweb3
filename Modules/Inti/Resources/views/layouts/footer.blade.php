    <!-- footer part start-->
    <footer class="footer-area">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-sm-6 col-md-4 col-xl-3">
                    <div class="single-footer-widget footer_1">
                        <a href="/"> <img src="{{ asset('vendor/inti/img/logo.png') }}" alt=""> </a>
                        <p>Nuestro curso online está basado en una plataforma de alta calidad y confiabilidad 
                        en su aplicación, siendo impartido por expertos profesionales</p>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-xl-4">
                    <div class="single-footer-widget footer_2">
                        <h4>Boletín informativo</h4>
                        <p>¿Tienes dudas o quieres comunicarte con nosotros?.
                            Elige el medio que más te convenga, te sugerimos Email
                        </p>
                        <form action="#">
                            <div class="form-group">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder='Ingresa tu Email'
                                        onfocus="this.placeholder = ''"
                                        onblur="this.placeholder = 'Ingresa tu Email'">
                                    <div class="input-group-append">
                                        <button class="btn btn_1" type="button"><i class="ti-angle-right"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        
                            {{ menu('LandingPageMenuSocial', 'inti::vendor.MenuSocial') }}
                          {{--   <a href="#"> <i class="ti-twitter-alt"></i> </a>
                            <a href="#"> <i class="ti-instagram"></i> </a>
                            <a href="#"> <i class="ti-skype"></i> </a> --}}
                       
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 col-md-4">
                    <div class="single-footer-widget footer_2">
                        <h4>Contáctanos</h4>
                        <div class="contact_info">
                            <p><span> Direccion :</span> Urb. Santa Ines - Santisima Trinidad</p>
                            <p><span> Telefono :</span> +591 721 XXX XX</p>
                            <p><span> Email : </span>empresa.loginweb@gmail.com </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright_part_text text-center">
                        <div class="row">
                            <div class="col-lg-12">
                                <p class="footer-text m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> Creado con <i class="ti-heart" aria-hidden="true"></i> by <a href="https://loginweb.dev" target="_blank">LoginWeb</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer part end-->