/* select2 */
$(document).ready(function () {
    if ($('.select2').length) {
        $('.select2').select2();
    }

    $('.modal').on('shown.bs.modal', function () {
        $(this).find('.select2').each(function () {
            if ($(this).length) {
                $(this).select2({
                    dropdownParent: $(this).closest('.modal')
                });
            }
        });
    });
});
/* end select2 */

/* fancyapps */
$(document).ready(function () {
    Fancybox.bind('[data-fancybox="gallery-1"]');
    Fancybox.bind('[data-fancybox="gallery-2"]');
});
/* end fancyapps */

/* button loading */
$(document).ready(function () {
    $('.btn-loading').on('click', function () {
        $(this).prop('disabled', true);

        var loadingText = $(this).data('loading-text') || 'Loading';
        $(this).html(loadingText);

        setTimeout(() => {
            $(this).closest('form').submit();
        });
    });
});
/* end button loading */

/* topbar */
$(document).ready(function () {
    $.fn.scrollToTop = function () {
        $('html, body').animate({ scrollTop: 0 }, 'smooth');
    };

    $.fn.scrollToBottom = function () {
        $('html, body').animate({ scrollTop: $(document).height() }, 'smooth');
    };

    $(window).on('scroll', function () {
        const scrollUpButton = $("#scrollUp");
        const scrollDownButton = $("#scrollDown");
        const scrollPosition = $(this).scrollTop();
        const documentHeight = $(document).height();
        const windowHeight = $(window).height();

        if (scrollPosition > 0) {
            scrollUpButton.show();
        } else {
            scrollUpButton.hide();
        }

        if (scrollPosition + windowHeight < documentHeight - 10) {
            scrollDownButton.show();
        } else {
            scrollDownButton.hide();
        }
    });

    $('#scrollUp').on('click', function () {
        $('html, body').animate({ scrollTop: 0 }, 'smooth');
    });

    $('#scrollDown').on('click', function () {
        $('html, body').animate({ scrollTop: $(document).height() }, 'smooth');
    });

    const navbarSecondary = $('.navbar-secondary');
    if (navbarSecondary.length) {
        const sticky = navbarSecondary.offset().top;

        $(window).on('scroll', function () {
            if ($(window).scrollTop() >= sticky) {
                navbarSecondary.addClass('sticky');
            } else {
                navbarSecondary.removeClass('sticky');
            }
        });
    }
});
/* end topbar */

/* share content */
$(document).ready(function () {
    $('.share-content').on('click', function () {
        if (navigator.share) {
            navigator.share({
                title: 'Bagikan Konten Ini',
                text: 'Lihat konten menarik ini!',
                url: window.location.href
            })
                .then(() => console.log('Konten berhasil dibagikan!'))
                .catch(error => console.error('Gagal membagikan konten:', error));
        } else {
            alert('Fitur share tidak didukung pada browser ini.');
        }
    });
});
/* end content */


