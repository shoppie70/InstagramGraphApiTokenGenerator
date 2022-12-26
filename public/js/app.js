function api_axios(action, formData, form) {
    axios
        .post(action, formData)
        .then(function (response) {
            console.log(response)

            if (response.data.success === false) {
                showErrorToast(response.data.message);
            } else {
                setReturnValueToProperty(response.data);
                setPostInField(response.data.posts);
                removeDescriptionArea();
                displayResultArea();
            }
        })
        .catch(function (error) {

            showErrorToast(error.data.message ?? 'エラーが発生しました。');
        })
        .finally(function () {
            setTimeout(function () {
                fadeOut(".spinner-overlay", 1000);
            }, 500);
        });
}

function setReturnValueToProperty(data) {
    document.getElementById('accessTokenContent').innerHTML = data.accessToken3;
    document.getElementById('businessAccountId').innerHTML = data.business_account;
}

function setPostInField(posts) {
    for (let i = 0; i < posts.length; i++) {
        if (posts[i] != null) {
            document.getElementById('post' + i).style.backgroundImage = 'url(' + (posts[i].img) + ')';
        }
        if (i === 11) {
            break;
        }
    }
}

function showSuccessToast(message) {
    iziToast.success({
        title: 'OK',
        message: message ?? 'データを正常に更新しました。',
        position: 'topRight'
    });
}

function showErrorToast(message) {
    iziToast.error({
        title: 'Error',
        message: message ?? 'エラーが発生しました。',
        position: 'topRight',
        closeOnClick: true,
        timeout: 10000
    });

    fadeIn("#manual_tool", 1000);
}

function fadeIn(selector, msec) {
    const ms = msec;
    const elm = document.querySelector(selector);

    elm.style.opacity = 0; // 透過度０
    elm.style.transition = "opacity " + ms + "ms";

    setTimeout(function () {
        elm.style.opacity = 1;
        elm.style.zIndex = 9999;
    }, 1);
}

function fadeOut(selector, msec) {
    const ms = msec;
    const elm = document.querySelector(selector);

    elm.style.opacity = 1; // 透過度1
    elm.style.transition = "opacity " + ms + "ms";

    setTimeout(function () {
        elm.style.opacity = 0;
    }, 1); // 0.001秒後に transition開始（透過度0にする）
    setTimeout(function () {
        elm.style.display = "none";
        elm.style.zIndex = -1;
    }, ms + 10); // 1.01秒後に完全に消す。
}

function removeDescriptionArea() {
    fadeOut('#description_area', 500);
}

function displayResultArea() {
    document.querySelector('#result_area').style.display = 'block';
    fadeIn('#result_area', 500);
}

function copyToClipboard(id_name) {
    const copyTarget = document.getElementById(id_name);
    copyTarget.select();

    if (document.execCommand("Copy") && copyTarget.value) {
        showSuccessToast(copyTarget.value + 'をコピーしました。');
    } else {
        showErrorToast('コピーに失敗しました');
    }
}

document.getElementById('api_form').addEventListener('submit', function (e) {
    e.preventDefault();
    let form = this;
    let formData = new FormData(this);
    let action = form.action;
    fadeIn(".spinner-overlay", 1000);

    api_axios(action, formData, form);
});

document.getElementById('manual-tool-close').addEventListener('click', function () {
    fadeOut("#manual_tool", 1000);
});
