$(document).ready(function () {
    var actiune = 'start';
    var intrebare = '';
    var raspuns = '';
    var nr_intrebare = 5;
    var punctaj = 0;
    function afis_nr_intrebare(nr) {
        $('#nr_intrebari').text('Mai ai ' + nr + ' intrebari');
    }
    function afis_punctaj(punctaj) {
        $('#pct').text('Ai acumulat ' + punctaj + ' puncte');
    }
    function spune_intrebare(intrebare) {
        var vorbire = new SpeechSynthesisUtterance();
        vorbire.lang = "ro-RO";
        vorbire.text = "care este" + intrebare;
        window.speechSynthesis.speak(vorbire);
    }
    function vorbeste(intrebare) {
        var vorbire = new SpeechSynthesisUtterance();
        vorbire.lang = "ro-RO";
        vorbire.text = intrebare;
        window.speechSynthesis.speak(vorbire);
    }

    function actualizare_punctaj() {
        $.ajax({
            url:"php/update.php",
            method:"POST",
            data:{punctaj:punctaj},
            success:function (data) {
                alert(data);
            }
        });
    }

    function spune_raspuns(raspuns) {
        if('webkitSpeechRecognition' in window){
            var raspuns_vocal = new webkitSpeechRecognition();
            raspuns_vocal.lang = "ro-RO";
            raspuns_vocal.continuous = false;
            raspuns_vocal.interimResults = false;
            raspuns_vocal.start();
            var final = '';
            raspuns_vocal.onresult = function (event) {
                var it = '';
                console.log(event.results.length);

                for(var i = event.resultIndex; i < event.results.length; i++){
                    var ts = event.results[i][0].transcript;
                    ts.replace('\n', '<br>');
                    if(event.results[i].isFinal) {
                        final += ts;
                    } else {
                        it += ts;
                    }
                }
               console.log(final + ' ' + it);


                if(final + it == raspuns) {
                    vorbeste('răspuns corect');
                    afis_punctaj(punctaj += 2);
                } else {
                    vorbeste('răspuns greșit');
                }
                afis_nr_intrebare(--nr_intrebare);
                if(nr_intrebare == 0) {
                    $('#nr_intrebari').text('Ai terminat intrebarile');
                    $('#start').css('display', 'none');
                    actualizare_punctaj();
                }
            };
        }
    }
    function start(){
       afis_nr_intrebare(nr_intrebare);
       afis_punctaj(punctaj);
       if(actiune == 'start') {
           $.ajax({
               url: "../av/php/intrebari.php",
               dataType: "json",
               success: function (data) {
                   console.log(data);
                   intrebare = data.intrebare;
                   raspuns = data.raspuns;
                   spune_intrebare(intrebare);
                   actiune = 'raspunde';

               }
           });
           $('#start').text('raspunde');
       } else {
           console.log(raspuns);
           spune_raspuns(raspuns);
           $('#start').text('start');
           actiune = 'start';
       }
    }
    $('#start').click(function () {
        start();
    });

    $('.info').click(function () {
        if ($('#info').css('margin-top') == '-500px' && $('#info').css('display') == 'none') {
            $('#info').css('display', 'block');
            $('#info').css('margin-top', '0px');
            $('#info').css('opacity', '1');
        }
    });
    $('#closebtn').click(function () {
        if ($('#info').css('margin-top') == '0px' && $('#info').css('display') == 'block') {
            $('#info').css('display', 'none');
            $('#info').css('margin-top', '-500px');
            $('#info').css('opacity', '0');
        }
    });
    $('#icon2').click(function () {
        if ($('#clasament').css('margin-top') == '-600px' && $('#clasament').css('display') == 'none') {
            $('#clasament').css('display','block');
            $('#clasament').css('margin-top', '0px');
            $('#clasament').css('opacity', '1');
        }
    });
    $('#closebtn2').click(function () {
        if ($('#clasament').css('margin-top') == '0px' && $('#clasament').css('display') == 'block') {
            $('#clasament').css('display','block');
            $('#clasament').css('margin-top', '-600px');
            $('#clasament').css('opacity', '0');
        }
    });
    $('.inregistrare').click(function () {
        if($('.nume').val() == '') {
            alert('Introdu numele tau');
        } else {
            // console.log($('.nume').val());
            $.ajax({
                url:'php/inregistrare.php',
                method:'POST',
                data:{
                    nume:$('.nume').val()
                },
                success:function (data) {
                    if(data == '1') {
                        window.location = 'av.html';
                    }
                }
            });
        }
    });

});