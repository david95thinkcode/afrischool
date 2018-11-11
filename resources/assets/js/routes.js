export const rootURI = window.location.protocol + '//' + document.location.host + '/';

export const Routes = {
    presenceProfesseur: {
        store: rootURI + 'api/presence-prof/store/',
        existing: rootURI + 'api/presence-prof/existing/',
    },
    emploiDuTemps: {
        get: {
            prof: rootURI.concat('api/emploi-du-temps/p/'),
            classe: rootURI.concat('api/emploi-du-temps/c/'),
        },
        post: {
            date: rootURI.concat('api/emploi-du-temps/day/'),
        }
    },
    enseigner: {
        get: {
            forClasse: rootURI.concat('api/enseigner/c/'),
            details: rootURI.concat('api/enseigner/')
        },
        post: {
            classNdate: rootURI.concat('api/enseigner/cnd/'),
        }
    },
    absenses: {
        post: {
            store: rootURI.concat('api/absences/store/'),
        }
    },
    classes: {
        get: {
            fetch: rootURI.concat('api/classes/fetch/'),
        }
    },
    inscription: {
        forClasse: rootURI.concat('api/inscription/c/'),
        basicsForClasse: rootURI.concat('api/inscription/c/basics/'),
        fullForClasse: rootURI.concat('api/inscription/c/full/'),
    },
};