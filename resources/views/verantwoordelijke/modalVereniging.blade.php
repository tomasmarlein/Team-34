<div class="modal" id="modal-vereniging">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Vereniging Modal</h5>
                <form action="" method="post">
                    @method('')
                    @csrf
                    <button type="submit" class="btn btn-success">Opslaan</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        Sluit
                    </button>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="naam">Naam</label>
                                    <input type="text" name="naam" id="naam"
                                           class="form-control"
                                           placeholder="Naam"
                                           minlength="3"
                                           value="">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="rekeningnr">Rekeningnummer</label>
                                    <input type="text" name="rekeningnr" id="rekeningnr"
                                           class="form-control"
                                           placeholder="Rekeningnummer"
                                           minlength="3"
                                           value="">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="btwnr">BTW nummer</label>
                                    <input type="text" name="btwnr" id="btwnr"
                                           class="form-control"
                                           placeholder="BTW nummer"
                                           minlength="3"
                                           value="">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="straat">Straat</label>
                                    <input type="text" name="straat" id="straat"
                                           class="form-control"
                                           placeholder="straat"
                                           minlength="3"
                                           value="">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="huisnummer">Huisnummer</label>
                                    <input type="text" name="huisnummer" id="huisnummer"
                                           class="form-control"
                                           placeholder="Huisnummer"
                                           minlength="3"
                                           value="">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="postcode">Postcode</label>
                                    <input type="text" name="postcode" id="postcode"
                                           class="form-control"
                                           placeholder="Postcode"
                                           minlength="3"
                                           value="">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group ">
                                    <label for="gemeente">Gemeente</label>
                                    <input type="text" name="gemeente" id="gemeente"
                                           class="form-control"
                                           placeholder="Gemeente"
                                           minlength="3"
                                           value="">
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
