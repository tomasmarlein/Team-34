

<div class="modal" id="modal-lid">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Lid</h5>
            </div>
            <form action="" method="post">
                @method('')
                @csrf
                <button type="submit" class="btn btn-success">Opslaan</button>
                <button onclick="location.reload()" type="button" class="btn btn-danger" data-dismiss="modal">
                    Sluit
                </button>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="naam">Naam *</label>
                            <input oninput="checkNaam()" type="text" class="form-control is-invalid" name="naam"
                                   id="naam" placeholder="Naam" value="" required>
                            <div class="invalid-feedback">
                                Naam is Verplicht
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="voornaam">voornaam *</label>
                            <input oninput="checkVoornaam()" type="text" class="form-control is-invalid" name="voornaam"
                                   id="voornaam" placeholder="Voornaam" value="" required>
                            <div class="invalid-feedback">
                                Voornaam is Verplicht
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email">E-Mail *</label>
                            <input  type="email" class="form-control" name="email"
                                   id="email" placeholder="E-mail" required>

                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="rijksregisternr">Rijksregisternummer * <b>NIET: </b>89.05.14-168.85 <b>
                                    WEL: </b> 88051416885 </label>
                            <input oninput="checkRijks()" type="text" class="form-control"
                                   name="rijksregisternr" id="rijksregisternr" placeholder="rijksregisternr" value="">
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="telefoon">Telefoon</label>
                            <input type="text" class="form-control" name="telefoon" id="telefoon" placeholder="Telefoon"
                                   value="">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="geboortedatum">Geboortedatum</label>
                            <input type="date" class="form-control" name="geboortedatum" id="geboortedatum"
                                   placeholder="" value="">
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-6">
                            <label for="opmerking">Opmerking</label>
                            <input type="text" class="form-control" name="opmerking" id="opmerking" placeholder="Opmerking"
                                   value="">
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

<script>

    // $( document ).ready(function() {
    //     var inp = $("input[id='rijksregisternr'] ");
    //     inp.bind('keyup', function(){
    //         this.value = this.value.replace(/[^0-9]/,'');
    //     });
    // });

    function checkNaam() {

        var naamveld = document.getElementById("naam").value;

        if(naamveld === ""){
            $('#naam').addClass("is-invalid");

        }else {

            $('#naam').removeClass("is-invalid");
            $('#naam').addClass("is-valid");
        }
    }


    function checkVoornaam() {

        var naamveld = document.getElementById("voornaam").value;

        if(naamveld === ""){
            $('#voornaam').addClass("is-invalid");

        }else {

            $('#voornaam').removeClass("is-invalid");
            $('#voornaam').addClass("is-valid");
        }
    }


    function checkRijks() {

        var inp = $("input[id='rijksregisternr'] ");
        inp.bind('keyup', function(){
            this.value = this.value.replace(/[^0-9]/,'');
        });
    }
</script>
