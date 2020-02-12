<div class="modal" id="modal-vrijwilliger">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">modal-genre-title</h5>
            <form action="" method="post">
                    @method('')
                    @csrf
                <button type="submit" class="btn btn-success">Bewaar</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Close
                </button>

                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="naam">Naam</label>
                                <input type="text" name="naam" id="naam"
                                       class="form-control"
                                       placeholder="Naam"
                                       value="">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="voornaam">Voornaam</label>
                                <input type="text" name="voornaam" id="voornaam"
                                       class="form-control"
                                       placeholder="Voornaam"
                                       value="">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="roepnaam">Roepnaam</label>
                                <input type="text" name="roepnaam" id="roepnaam"
                                       class="form-control"
                                       placeholder="Roepnaam"
                                       value="">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email"
                                       class="form-control"
                                       placeholder="Email"
                                       value="">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="rijksregisternr">Rijksregisternummer</label>
                                <input oninput="checkRijks()" type="tel" name="rijksregisternr" id="rijksregisternr"
                                       class="form-control"
                                       placeholder="Rijksregisternummer"
                                       required
                                       value=""
                                       minlength="11"
                                       maxlength="11">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="telefoon">Telefoon</label>
                                <input type="tel" name="telefoon" id="telefoon"
                                       class="form-control"
                                       placeholder="Telefoon"
                                       required
                                       value="">
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="geboortedatum">Geboortedatum</label>
                                <input type="date" name="geboortedatum" id="geboortedatum"
                                       class="form-control"
                                       placeholder="Geboortedatum"
                                       required
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
