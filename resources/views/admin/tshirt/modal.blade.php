<div class="modal" id="modal-tshirt">
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
                <input type="hidden" id="gebruikerId" name="gebruikerId" value="">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="naam">Naam</label>
                                <input type="text" name="naam" id="naam"
                                       class="form-control"
                                       placeholder="Naam"
                                       value="" disabled>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="voornaam">Voornaam</label>
                                <input type="text" name="voornaam" id="voornaam"
                                       class="form-control"
                                       placeholder="Voornaam"
                                       value="" disabled>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="vereniging">Vereniging</label>
                                <input type="text" name="vereniging" id="vereniging"
                                       class="form-control"
                                       placeholder="Vereniging"
                                       value="" disabled>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tshirt_maat">T-shirt maat</label>
                                <select class="form-control" name="tshirt_maat" id="tshirt_maat">
                                    <option value="0">Selecteer T-shirt maat</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <option value="XXL">XXL</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tshirt_geslacht">T-shirt geslacht</label>
                                <select class="form-control" name="tshirt_geslacht" id="tshirt_geslacht">
                                    <option value="0">Selecteer T-shirt geslacht</option>
                                    <option value="M">Man</option>
                                    <option value="V">Vrouw</option>
                                </select>
                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="dropdown-types">T-shirt type</label>
                                <select class="form-control" id="dropdown-types" name="type_id">
                                    <option value="leeg">Selecteer een T-shirt type</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="tshirt_aantal">T-shirt aantal</label>
                                <select class="form-control" name="tshirt_aantal" id="tshirt_aantal">
                                    <option value="0">Selecteer T-shirt aantal</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                </select>

                                <div class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>
