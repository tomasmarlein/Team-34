<div class="modal" id="modal-tijdsregistratie">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Evenement Modal</h5>
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
                    <div class="col-md-4">
                        <div class="form-group ">
                            <label for="naam">Naam</label>
                            <input type="text" name="naam" id="naam"
                                   class="form-control"
                                   placeholder="Naam"
                                   minlength="3"
                                   value="" disabled>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group ">
                            <label for="voornaam">Voornaam</label>
                            <input type="text" name="voornaam" id="voornaam"
                                   class="form-control"
                                   placeholder="Vooraam"
                                   minlength="3"
                                   value="" disabled>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group ">
                            <label for="vereniging">Vereniging</label>
                            <input type="text" name="vereniging" id="vereniging"
                                   class="form-control"
                                   placeholder="Vereniging"
                                   minlength="3"
                                   value="" disabled>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group ">
                            <label for="checkIn">Check in</label>
                            <input type="text" name="checkIn" id="checkIn"
                                   class="form-control"
                                   placeholder="checkIn"
                                   minlength="3"
                                   value="" disabled>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group ">
                            <label for="checkUit">Check uit</label>
                            <input type="text" name="checkUit" id="checkUit"
                                   class="form-control"
                                   placeholder="Einddatum"
                                   minlength="3"
                                   value="" disabled>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group ">
                            <label for="manCheckIn">Manuele check in</label>
                            <input type="text" name="manCheckIn" id="manCheckIn"
                                   class="form-control"
                                   placeholder="Einddatum"
                                   minlength="3"
                                   value="" disabled>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group ">
                            <label for="manCheckUit">Manuele check uit</label>
                            <input type="text" name="manCheckUit" id="manCheckUit"
                                   class="form-control"
                                   placeholder="Einddatum"
                                   minlength="3"
                                   value="" disabled>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group ">
                            <label for="adminCheckIn">Admin check in</label>
                            <input type="datetime-local" name="adminCheckIn" id="adminCheckIn"
                                   class="form-control"
                                   minlength="3"
                                   value="">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group ">
                            <label for="adminCheckUit">Admin check uit</label>
                            <input type="datetime-local" name="adminCheckUit" id="adminCheckUit"
                                   class="form-control"
                                   minlength="3"
                                   value="">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>


                </div>
                </form>
            </div>
        </div>
    </div>
</div>
