/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$('.audio_lesson').click(function() {
    var id = this.id.split('/');
    var carpeta = id[0];
    var cd = id[1];
    var pista = id[2];
    var file = carpeta + '/' + cd + '/' + pista;


    jwplayer("player_audio").setup({
        flashplayer: "lib/jwplayer/player.swf",
        file: file,
        controlbar: 'bottom',
        autostart: true,
        height: 24,
        width: 250
    });

    $('#audio').dialog({
        title: 'Reproductor',
        autoOpen: true,
        resizable: true,
        modal: false,
        width: 'auto',
        buttons: {
            Cerrar: function() {
                $(this).html('<div id="player_audio"></div>');
                $(this).dialog('close');
            }
        }
    });
});