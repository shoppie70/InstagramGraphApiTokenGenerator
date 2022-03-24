function showNotification(b, a, c) {
    $.toast({
        heading: b,
        text: c,
        showHideTransition: "slide",
        icon: a,
        loaderBg: "#57c7d4",
        position: "top-right",
        hideAfter: 5000
    })
}

$(function () {
    $(".api_form").on("submit", function (a) {
        a.preventDefault();
        let form = $(this);
        let formData = new FormData(this);
        let action = form.attr('action');
        api_ajax(action, formData, form)
    })
});
let ajax_active = false;

function api_ajax(action, form_data) {

    if (ajax_active) {
        return false;
    }
    ajax_active = true;

    $(document).ajaxSend(function () {
        $(".spinner-overlay").fadeIn(300);
    });

    $.ajax({
        url: action,
        dataType: "json",
        method: "POST",
        data: form_data,
        contentType: false,
        processData: false,
    })
        .done(function (data, textStatus, jqXHR) {
            showNotification(
                textStatus,
                textStatus,
                data.message ?? jqXHR.statusText
            );

            $("#accessTokenContent").html(data.accessToken3);
            $("#pageName").text(data.page_name);
            $("#businessAccountId").text(data.business_account);

            for (let i = 0; i < data.posts.length; i++) {
                if (data.posts[i] != null) {
                    $("#post" + i).css('background-image', "url(" + (data.posts[i].img) + ")");
                }
                if( i === 11 ) {
                    break;
                }
            }
        })
        .fail(function (data, textStatus, jqXHR) {
            const response_text = $.parseJSON(data.responseText);

            showNotification(
                "Danger",
                textStatus,
                response_text.message ?? jqXHR
            );
        })
        .always(function () {
            ajax_active = false;
            setTimeout(function () {
                $(".spinner-overlay").fadeOut(300);
            }, 500);
        });
}

$('.js-modal-open').each(function () {
    $(this).on('click', function () {
        var target = $(this).data('target');
        var modal = document.getElementById(target);
        $(modal).fadeIn(300);
        return !1
    })
});
$('.js-modal-close').on('click', function () {
    $('.js-modal').fadeOut(300);
    return !1
});

function copyToClipboard(id_name) {
    const copyTarget = document.getElementById(id_name);
    copyTarget.select();
    if (document.execCommand("Copy") && copyTarget.value) {
        showNotification("Success", "success", copyTarget.value + "をコピーしました。");
    } else {
        showNotification("Danger", "error", "コピーに失敗しました。");
    }
}

$(document).ready(function () {
    $('.popup-gallery').magnificPopup({
        delegate: 'a',
        type: 'image',
        tLoading: 'Loading image #%curr%...',
        mainClass: 'mfp-img-mobile',
        gallery: {
            enabled: !0,
            navigateByImgClick: !0,
            preload: [0, 1]
        },
    })
})