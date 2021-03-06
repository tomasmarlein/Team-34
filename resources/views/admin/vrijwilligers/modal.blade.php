<div class="modal" id="modal-vrijwilliger">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Vrijwilligers</h5>
            <form action="" method="post">
                    @method('')
                    @csrf
                <button type="submit" class="btn btn-success">Opslaan</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">
                    Sluit
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
                        <div class="col-md-4">
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
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="dropdown-vereniging">Verenigingen</label>
                                <select class="form-control" id="dropdown-vereniging" name="vereniging_id" style="width: 100%; padding: 10px 5px;">
                                    <option value="leeg">Selecteer een vereniging</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="dropdown-rol">Rol</label>
                                <select class="form-control" id="dropdown-rol" name="rol_id">
                                    <option value="leeg">Selecteer een rol</option>
                                    <option value="3">Verantwoordelijke</option>
                                    <option value="4">Vrijwilliger</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
