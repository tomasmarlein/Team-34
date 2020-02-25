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
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="naam">Naam</label>
                            <input type="text" name="volledigenaam" id="volledigenaam"
                                   class="form-control"
                                   placeholder="volledigenaam"
                                   value="" disabled>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="vereniging">Vereniging</label>
                            <input type="text" name="vereniging" id="vereniging"
                                   class="form-control"
                                   placeholder="vereniging"
                                   value="" disabled>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>


                    <div class="col-md-3">
                        <div class="form-group ">
                            <label for="checkIn">Checkin</label>
                            <input type="datetime-local"  name=""
                                   class="form-control"
                                   placeholder="checkIn"
                                   value="2018-01-30T23:59">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="CheckUit">CheckUit</label>
                            <input type="datetime" name="checkUit" id="checkUit"
                                   class="form-control"
                                   placeholder="CheckUit"
                                   value="" disabled>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group ">
                            <label for="einddatum">checkUit</label>
                            <input type="checkUit" name="checkUit" id="checkUit"
                                   class="form-control"
                                   placeholder="checkUit"
                                   minlength="3"
                                   value="">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

            </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="naam">test</label>
                        <input type="text" name="volledigenaam" id="naam"
                               class="form-control"
                               placeholder="volledigenaam"
                               value="" disabled>
                        <div class="invalid-feedback"></div>
                    </div>
                </div>

                    </div>
            </div>

            </form>
        </div>
    </div>
</div>

