/**
 * Gianluca App.js
 * ---------------
 */
const formatter = new Intl.NumberFormat('it-IT', {
    style: 'currency',
    currency: 'EUR',
    minimumFractionDigits: 2
});


var dynamicColors = function() {
    var r = Math.floor(Math.random() * 255);
    var g = Math.floor(Math.random() * 255);
    var b = Math.floor(Math.random() * 255);
    return "rgb(" + r + "," + g + "," + b + ")";
};

function error(message){
    Swal.fire({
        title: 'Attenzione!',
        html: message,
        icon: 'error',
        confirmButtonText: 'Ho capito'
    })
}

function error422(response) {
    let errors = response.responseJSON.errors;
    let message_error = '';
    $.each(errors, function (key, value) {
        message_error += "C'è un problema per il campo ("+key+")"+"<br>";
    });
    error(message_error);
}

function success(message,reload,path){
    Swal.fire({
        title: 'Ottimo lavoro',
        text: message,
        icon: 'success',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ok'
    }).then((result) => {
        if (reload === true && path === undefined) {
            location.reload()
        }
        if(reload === true && path !== undefined){
            location.href = path;
        }
    })
}

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function uploadFile(url, data,reload = true, success, xhrpercent ) {

    // data = typeof data !== 'undefined' ? data : {}; //default value for data

    var formdata = new FormData();
    $.each(data,function (index,values) {
        $.each(values,function (i,value) {
            formdata.append(index+'['+i+']', value);
        });
    });

    $.ajax({
        'method': 'post',
        'url': url,
        'data': formdata,
        'cache': false,
        'contentType': false,
        //'enctype': 'multipart/form-data',
        'processData': false,
        xhr: function () {
            var myXhr = $.ajaxSettings.xhr();
            if (myXhr.upload) {
                myXhr.upload.addEventListener('progress', progress, false);
            }
            return myXhr;
        },
        beforeSend: function () {
            $('#upload_perc').show();
        },
        complete: function (response) {
            if (response.status === 200) {
                //$('#percentuale').html("Attendi...");
                if(reload){
                    location.reload();
                }

            }
        },
        'statusCode': {
            422: function (response) {
                //get first error to show it on top of pagse
                $('#upload_perc').hide();
                error(response.responseJSON.errors);

            },
            413: function (response) {
                //get first error to show it on top of pagse
                $('#percentuale').html("😞 File troppo grande ");
                setTimeout(function () {
                    $('#upload_perc').hide();
                }, 5000);

            },
            500: function (response) {
                $('#upload_perc').hide();
                error("Si è creato un errore inaspettato, prova con un altro file");
            }
        }
    });

    function progress(e) {
        if (e.lengthComputable) {
            var max = e.total;
            var current = e.loaded;
            var Percentage = (current * 100) / max;
            $('#percentuale').html(Number(Percentage).toFixed(0)+'%');
            if (Percentage === 100) {
                if (typeof xhrpercent !== 'undefined') {
                    xhrpercent(e);
                    sentenceLoading();
                }
            }
        }
    }

}

function getMesi(){
    return {
        1:'Gennaio',
        2:'Febbraio',
        3:'Marzo',
        4:'Aprile',
        5:'Maggio',
        6:'Giugno',
        7:'Luglio',
        8:'Agosto',
        9:'Settembre',
        10:'Ottobre',
        11:'Novembre',
        12:'Dicembre',
    };
}

function hexToRgb(hex) {
    var result = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(hex);
    return result ? {
        r: parseInt(result[1], 16),
        g: parseInt(result[2], 16),
        b: parseInt(result[3], 16)
    } : null;
}


