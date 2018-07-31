$('document').ready(function(f) {

    let tableBody = '#bulletinTable tbody';
    let moyGene = '#GAVG';
    let CELLS = {
        coefficient: '.b-coef',
        interrogation: '.b-interro',
        devoir: '.b-devoir',
        moyenne: '.b-moy',
        mention: '.b-mention'
    };


    calculerMoyenne();
    calculerMoyGénérale();


    function calculerMoyGénérale() {
        var i = 0;
        var GlobalAvg = 0;
        var avgs = $(CELLS.moyenne);

        $.each(avgs, function(index, value) {
            i++;
            GlobalAvg += parseFloat($(value).text());
        });

        GlobalAvg = parseFloat(GlobalAvg / i);
        $(moyGene).text(GlobalAvg.toFixed(2));
    }

    function calculerMoyenne() {

        var rows = $(tableBody).children();

        $.each(rows, function(index, value) {

            var avg = 0;
            var devoirSum = 0;

            var interro = parseFloat($(this).children(CELLS.interrogation).text());
            var devoirs = $(this).children(CELLS.devoir);

            if (isNaN(interro)) {
                interro = 0;
            }

            $.each(devoirs, function(devoirIndex, devoirValue) {
                var v = parseFloat($(devoirValue).text());
                if (!isNaN(v)) {
                    devoirSum += parseFloat($(devoirValue).text())
                }
            });

            avg = (parseFloat(interro) + devoirSum) / 3;

            // Insertion moyenne et Mention
            $(this).children(CELLS.moyenne).text(avg.toFixed(2));
            $(this).children(CELLS.mention).text(retournerMention(avg.toFixed(2)));
        })

    }

    function retournerMention(avg) {
        var v = parseFloat(avg);
        var a = '';

        if (avg >= 10 && avg <= 11) {
            a = 'Passable';
        } else if (avg >= 12 && avg <= 13) {
            a = 'Assez Bien';
        } else if (avg >= 14 && avg <= 15) {
            a = 'Bien';
        } else if (avg >= 16 && avg <= 17) {
            a = 'Très Bien';
        } else if (avg >= 18 && avg <= 19) {
            a = 'Excellent';
        }

        return a;
    }
});