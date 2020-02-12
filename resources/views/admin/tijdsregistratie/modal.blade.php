<div class="modal" id="modal-tijdsregistratie">
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
                        <div class="form-group ">
                            <label for="checkIn">einddatum</label>
                            <input type="datetime-local" name="checkIn" id="checkIn"
                                   class="form-control"
                                   placeholder="checkIn"
                                   minlength="3"
                                   value=""
                                    disabled>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="CheckUit">CheckUit</label>
                            <input type="date" name="checkUit" id="checkUit"
                                   class="form-control"
                                   placeholder="CheckUit"
                                   value="">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                </div>


            </div>




                    </div>
                </div>
            </div>

            </form>
        </div>
    </div>
</div>
