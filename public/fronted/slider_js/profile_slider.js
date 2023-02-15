    // product details slider 
    $(document).ready(function() {
        var sync1 = $(".slider1");
        var sync2 = $(".navigation-thumbs1");
        var thumbnailItemClass = '.owl-item';
        var slides = sync1.owlCarousel({
            video: true,
            startPosition: 12,
            responsive: {
                0: {
                    items: 1,
                    margin: 10,
                },
                767: {
                    items: 3,
                    margin: 15,
                },
                1200: {
                    items: 5,
                    margin: 20,
                }
            },
            loop: false,
            touchDrag: false,
            mouseDrag: false,
            nav: true,
            dots: false,
            video: true,
            lazyLoad: true,
            center: true
        }).on('changed.owl.carousel', syncPosition);


        function syncPosition(el) {
            $owl_slider = $(this).data('owl.carousel');
            var loop = $owl_slider.options.loop;

            if (loop) {
                var count = el.item.count - 1;
                var current = Math.round(el.item.index - (el.item.count / 2) - .5);
                if (current < 0) {
                    current = count;
                }
                if (current > count) {
                    current = 0;
                }
            } else {
                var current = el.item.index;
            }

            var owl_thumbnail = sync2.data('owl.carousel');
            var itemClass = "." + owl_thumbnail.options.itemClass;


            var thumbnailCurrentItem = sync2
                .find(itemClass)
                .removeClass("synced")
                .eq(current);

            thumbnailCurrentItem.addClass('synced');
            thumbnailCurrentItem.addClass('see-this-story');

            if (!thumbnailCurrentItem.hasClass('active')) {
                var duration = 300;
                sync2.trigger('to.owl.carousel', [current, duration, true]);

            }
        }
        var thumbs = sync2.owlCarousel({
                startPosition: 1,
                items: 12,
                responsive: {
                    1366: {
                        items: 9,
                        margin: 20,
                    },
                    1200: {
                        items: 7,
                        margin: 20,
                    },
                    1000: {
                        items: 5,
                        margin: 20,
                    },
                    767: {
                        items: 3,
                        margin: 15,
                    },
                    0: {
                        items: 3,
                        margin: 10,
                        autoWidth: true
                    }
                },
                loop: false,
                margin: 0,
                autoplay: false,
                nav: false,
                dots: false,
                onInitialized: function(e) {
                    var thumbnailCurrentItem = $(e.target).find(thumbnailItemClass).eq(this._current);
                    thumbnailCurrentItem.addClass('synced');
                    thumbnailCurrentItem.addClass('see-this-story');

                },
            })
            .on('click', thumbnailItemClass, function(e) {
                e.preventDefault();
                var duration = 300;
                var itemIndex = $(e.target).parents(thumbnailItemClass).index();
                sync1.trigger('to.owl.carousel', [itemIndex, duration, true]);
            }).on("changed.owl.carousel", function(el) {
                var number = el.item.index;
                $owl_slider = sync1.data('owl.carousel');
                $owl_slider.to(number, 100, true);
            });

        $('.story-slider-wrapper').hide();
        $('#sync2 .owl-item').click(function() {
            $('.story-slider-wrapper').show();
            $('body').css('overflow', 'hidden');
        })

        $('.close-story-btn').click(function() {
            $('.story-slider-wrapper').hide();
            $('body').css('overflow', 'unset');
        });

        var videoSlider = $('.multi-story-slider.owl-carousel');
        videoSlider.owlCarousel({
            margin: 0,
            nav: false,
            dots: true,
            animateOut: 'fadeOut',
            navText: [
                "<i class='bx bx-left-arrow-alt'></i>",
                "<i class='bx bx-right-arrow-alt'></i>"
            ],
            items: 1,
            smartSpeed: 1000,
            loop: false
        });




        $('#sync2 .owl-item').click(function() {
            setTimeout(function() {
                if ($('.owl-item.active.center .multi-story-slider .owl-item.active').find(
                        'video').length !== 0) {
                    $('.owl-item.active .item video').get(0).play();
                    $(this).get(0).currentTime = 0;
                } else {
                    $('.owl-item.active.center .multi-story-slider .owl-item.active .item video')
                        .get(0).pause();
                    $(this).get(0).currentTime = 0;
                }
            }, 1000);
        })

        $('.close-story-btn').click(function() {
            $('.item video').get(0).pause();
        })


        sync1.on('translate.owl.carousel', function(e) {
            setTimeout(function() {
                $('.multi-story-slider .owl-item .item video').each(function() {
                    $(this).get(0).pause();
                    $(this).get(0).currentTime = 0;
                });
            }, 1000);
            setTimeout(function() {
                if ($('.owl-item.active.center .multi-story-slider .owl-item.active').find(
                        'video').length !== 0) {
                    $('.owl-item.active.center .multi-story-slider .owl-item.active .item video')
                        .get(0).play();
                    $(this).get(0).currentTime = 0;
                }
            }, 1000);
        });
        $('.owl-item.active.see-this-story').removeClass('see-this-story');
    });

    $(document).ready(function() {
        var sync1 = $(".slider1");
        var sync2 = $(".navigation-thumbs1");

        var thumbnailItemClass = '.owl-item';

        var slides = sync1.owlCarousel({
            video: true,
            startPosition: 9,
            responsive: {
                0: {
                    items: 1,
                    margin: 10,
                },
                767: {
                    items: 3,
                    margin: 15,
                },
                1200: {
                    items: 5,
                    margin: 20,
                }
            },
            loop: true,
            smartSpeed: 1000,
            nav: false,
            dots: false,
            video: true,
            lazyLoad: true,
            center: true
        }).on('changed.owl.carousel', syncPosition);

        function syncPosition(el) {
            $owl_slider = $(this).data('owl.carousel');
            var loop = $owl_slider.options.loop;

            if (loop) {
                var count = el.item.count - 1;
                var current = Math.round(el.item.index - (el.item.count / 2) - .5);
                if (current < 0) {
                    current = count;
                }
                if (current > count) {
                    current = 0;
                }
            } else {
                var current = el.item.index;
            }

            var owl_thumbnail = sync2.data('owl.carousel');
            var itemClass = "." + owl_thumbnail.options.itemClass;


            var thumbnailCurrentItem = sync2
                .find(itemClass)
                .removeClass("synced")
                .eq(current);

            thumbnailCurrentItem.addClass('synced');

            if (!thumbnailCurrentItem.hasClass('active')) {
                var duration = 300;
                sync2.trigger('to.owl.carousel', [current, duration, true]);
            }
        }
        var thumbs = sync2.owlCarousel({
                startPosition: 1,
                items: 12,
                responsive: {
                    1200: {
                        margin: 20,
                    },
                    767: {
                        margin: 15,
                    },
                    0: {
                        margin: 10,
                    }
                },
                autoWidth: true,
                loop: false,
                margin: 0,
                autoplay: false,
                nav: false,
                dots: false,
                onInitialized: function(e) {
                    var thumbnailCurrentItem = $(e.target).find(thumbnailItemClass).eq(this._current);
                    thumbnailCurrentItem.addClass('synced');
                    thumbnailCurrentItem.addClass('see-this-story');

                },
            })
            .on('click', thumbnailItemClass, function(e) {
                e.preventDefault();
                var duration = 300;
                var itemIndex = $(e.target).parents(thumbnailItemClass).index();
                sync1.trigger('to.owl.carousel', [itemIndex, duration, true]);
            }).on("changed.owl.carousel", function(el) {
                var number = el.item.index;
                $owl_slider = sync1.data('owl.carousel');
                $owl_slider.to(number, 100, true);
            });


        $('.story-slider-wrapper').hide();

        $('#sync2 .owl-item').click(function() {
            $(this).addClass('see-this-story');
            $('.story-slider-wrapper').show();
            $('body').css('overflow', 'hidden');
        })

        $('.close-story-btn').click(function() {
            $('.story-slider-wrapper').hide();
            $('body').css('overflow', 'unset');
        });

    });