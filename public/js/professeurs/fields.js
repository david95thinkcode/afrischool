$('document').ready(function () {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    LoadCountriesInside([$('#prof_nationalite')]);

    /**
     *  Crée des éléments <option> à l'intérieur de chaque élément <select>
     * @param CountrySelectElements
     * Tableau d'éléments <select>
    */
    function LoadCountriesInside(CountrySelectElements) {

        let _paysURL = '/ajax/pays';

        if (CountrySelectElements != null && CountrySelectElements.length > 0) {
            $.ajax({
                type: 'GET',
                url: _paysURL,
                dataType: 'json'
            })
                .done(function (data) {

                    // Pour chaque objet JSON, Créer un élément <option> et y mettre la valeur du
                    // pays
                    if (data != null) {
                        data.sort();
                        CountrySelectElements.forEach(field => {
                            data.forEach(country => {
                                var item = $('<option></option>')
                                    .text(country.nom_fr_fr)
                                    .val(country.nom_fr_fr);
                                field.append(item);
                            });
                        });
                    }
                    else {
                        console.log('Data not fetched');
                    }
                })
        }
    }
});
