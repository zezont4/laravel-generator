$(document).ready(function () {
    $('select').material_select();

    $('.button-collapse').sideNav({
            edge: 'right'
        }
    );

    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();

    /* to work around right aligned side nav */
    document.getElementById("nav-mobile").removeAttribute('style');
    document.getElementById("nav-mobile").style["width"] = "240px";

});

/**
 * custom alert with materialize colors
 * @param $msg
 * @param $type
 * @param $duration
 */
function myAlert($msg, $type, $duration) {
    var msgType = $type ? $type : 'success';
    var typeColorArray = {
        'success': 'green lighten-1',
        'error': 'red lighten-2',
        'info': 'blue lighten-1'
    };
    $duration = $duration ? $duration : 5000;
    Materialize.toast($msg, $duration, typeColorArray[msgType])
}