<div class="row">
    <div class="col-sm-12">
        @if ($enfant->inscription->first()->reste > 0)
        <div class="alert alert-warning fade show" role="alert">
            <strong>Scolarité non soldée !</strong> 
            Vous devez passer le plus tôt possible dans son école afin de payer le reste avant l'échéance.
        </div>
            <div class="text-center">
                <h2>Reste à payer :  {!! $enfant->inscription->first()->reste !!} </h2>
                <p class="lead">Echéance : - </p>
            </div>
        @else
            <div class="alert alert-success fade show" role="alert">
            <strong>Scolarité soldée !</strong> 
            Vous n'avez pas d'inquiétude à avoir, votre enfant suivra les cours sans interruption.
        </div>
        @endif
    </div>
</div>