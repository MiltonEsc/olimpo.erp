<script src="../../public/js/lib/jquery/jquery.min.js"></script>
<script src="../../public/js/lib/tether/tether.min.js"></script>
<script src="../../public/js/lib/bootstrap/bootstrap.min.js"></script>
<script src="../../public/js/plugins.js"></script>
<script src="../../public/js/lib/slick-carousel/slick.min.js"></script>
<script src="../../public/js/lib/datatables-net/datatables.min.js"></script>
<script src="../../public/js/lib/html2canvas/html2canvas.min.js"></script>
<!-- <script src="../../public/js/lib/bootstrap-sweetalert/sweetalert.min.js"></script> -->
<script src="../../public/js/lib/summernote/summernote.min.js"></script>
<script src="../../public/js/lib/fancybox/jquery.fancybox.pack.js"></script>
<script src="../../public/js/summernote-ES.js"></script>
<script src="../../public/js/loading-bar.js"></script>
<script src="../../public/js/lib/select2/select2.full.min.js"></script>
<script type="text/javascript" src="../../public/js/lib/moment/moment-with-locales.min.js"></script>
<script type="text/javascript" src="../../public/js/lib/flatpickr/flatpickr.min.js"></script>
<script src="../../public/js/lib/clockpicker/bootstrap-clockpicker.min.js"></script>
<script src="../../public/js/lib/clockpicker/bootstrap-clockpicker-init.js"></script>
<script src="../../public/js/lib/daterangepicker/daterangepicker.js"></script>
<script src="../../public/js/lib/bootstrap-select/bootstrap-select.min.js"></script>
<script src="../../public/js/lib/prism/prism.js"></script>
<script src="../../public/js/lib/peity/jquery.peity.min.js"></script>
<script type="text/javascript" src="../../public/js/lib/match-height/jquery.matchHeight.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/smartwizard@5/dist/js/jquery.smartWizard.min.js" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.js" type="text/javascript"></script>
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- <script>
    $(function () {
        $(".profile-card-slider").slick({
            slidesToShow: 1,
            adaptiveHeight: true,
            prevArrow: '<i class="slick-arrow font-icon-arrow-left"></i>',
            nextArrow: '<i class="slick-arrow font-icon-arrow-right"></i>'
        });

        var postsSlider = $(".posts-slider");

        postsSlider.slick({
            slidesToShow: 4,
            adaptiveHeight: true,
            arrows: false,
            responsive: [
                {
                    breakpoint: 1700,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 1350,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 500,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });

        $('.posts-slider-prev').click(function(){
            postsSlider.slick('slickPrev');
        });

        $('.posts-slider-next').click(function(){
            postsSlider.slick('slickNext');
        });

        /* ==========================================================================
            Recomendations slider
            ========================================================================== */

        var recomendationsSlider = $(".recomendations-slider");

        recomendationsSlider.slick({
            slidesToShow: 4,
            adaptiveHeight: true,
            arrows: false,
            responsive: [
                {
                    breakpoint: 1700,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 1350,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 500,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });

        $('.recomendations-slider-prev').click(function() {
            recomendationsSlider.slick('slickPrev');
        });

        $('.recomendations-slider-next').click(function(){
            recomendationsSlider.slick('slickNext');
        });

        $('.gallery-item').matchHeight({
				target: $('.gallery-item .gallery-picture')
		});

     
        $(".bar-chart").peity("bar",{
            delimiter: ",",
            fill: ["#919fa9"],
            height: 16,
            max: null,
            min: 0,
            padding: 0.1,
            width: 384
        });

    });
</script> -->

<script>
    $(document).ready(function () {
        // Inicializar el slider de perfil
        $(".profile-card-slider").slick({
            slidesToShow: 1,
            adaptiveHeight: true,
            prevArrow: '<i class="slick-arrow font-icon-arrow-left"></i>',
            nextArrow: '<i class="slick-arrow font-icon-arrow-right"></i>'
        });

        // Configuración común para los sliders de publicaciones y recomendaciones
        var commonSliderSettings = {
            slidesToShow: 4,
            adaptiveHeight: true,
            arrows: false,
            responsive: [
                {
                    breakpoint: 1700,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 1350,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 500,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        };

        // Inicializar el slider de publicaciones
        var postsSlider = $(".posts-slider");
        postsSlider.slick($.extend({}, commonSliderSettings));

        // Navegación del slider de publicaciones
        $('.posts-slider-prev').click(function(){
            postsSlider.slick('slickPrev');
        });
        $('.posts-slider-next').click(function(){
            postsSlider.slick('slickNext');
        });

        // Inicializar el slider de recomendaciones
        var recomendationsSlider = $(".recomendations-slider");
        recomendationsSlider.slick($.extend({}, commonSliderSettings));

        // Navegación del slider de recomendaciones
        $('.recomendations-slider-prev').click(function() {
            recomendationsSlider.slick('slickPrev');
        });
        $('.recomendations-slider-next').click(function(){
            recomendationsSlider.slick('slickNext');
        });

        // Ajustar la altura de los elementos de la galería
        $('.gallery-item').matchHeight({
            target: $('.gallery-item .gallery-picture')
        });

        // Configurar gráficos de barras Peity
        $(".bar-chart").peity("bar", {
            delimiter: ",",
            fill: ["#919fa9"],
            height: 16,
            max: null,
            min: 0,
            padding: 0.1,
            width: 384
        });
    });
</script>



<script src="../../public/js/app.js"></script>