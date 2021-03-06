<div class="modal" id="modal-admin">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">modal-genre-title</h5>
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
                                   minlength="3"
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
                                   minlength="3"
                                   value="">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" name="email" id="email"
                                   class="form-control"
                                   placeholder="Email"
                                   minlength="3"
                                   value="">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="wachtwoord">Wachtwoord</label>
                            <input type="password" name="wachtwoord" id="wachtwoord"
                                   class="form-control"
                                   placeholder="Wachtwoord"
                                   minlength="3"
                                   required
                                   value="">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="telefoon">Telefoon</label>
                            <input type="tel" name="telefoon" id="telefoon"
                                   class="form-control"
                                   placeholder="Telefoon"
                                   minlength="3"
                                   required
                                   value="">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="geboortedatum">Geboortedatum</label>
                            <input type="date" name="geboortedatum" id="geboortedatum"
                                   class="form-control"
                                   placeholder="Geboortedatum"
                                   minlength="3"
                                   required
                                   value="">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="dropdown-rol">Admin of kernlid</label>
                            <select class="form-control" id="dropdown-rol" name="rol_id">
                                <option value="leeg">Selecteer een rol</option>
                                <option value="1">Admin</option>
                                <option value="2">Kernlid</option>
                            </select>
                        </div>
                    </div>
                </div>


                </form>
            </div>
        </div>
    </div>
</div>
