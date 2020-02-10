<div class="modal" id="modal-evenementen">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Evenement Modal</h5>
                <form action="" method="post">
                    @method('')
                    @csrf
                    <button type="submit" class="btn btn-success">Opslaan</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">
                        Close
                    </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
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
                            <label for="startdatum">startdatum</label>
                            <input type="datetime" name="startdatum" id="startdatum"
                                   class="form-control"
                                   placeholder="Startdatum"
                                   minlength="3"
                                   value="">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group ">
                            <label for="einddatum">einddatum</label>
                            <input type="datetime" name="einddatum" id="einddatum"
                                   class="form-control"
                                   placeholder="Einddatum"
                                   minlength="3"
                                   value="">
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" id="actief" name="actief">
                            <label class="form-check-label" for="actief">
                                Actief?
                            </label>
                        </div>
                    </div>


                </div>



                </form>
            </div>
        </div>
    </div>
</div>
