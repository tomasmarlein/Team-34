<div class="modal" id="modal-evenementen">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Evenement Modal</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    @method('')
                    @csrf
                    <div class="form-group ">
                        <label for="naam">Naam</label>
                        <input type="text" name="naam" id="naam"
                               class="form-control"
                               placeholder="Naam"
                               minlength="3"
                               value="">
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="form-group ">
                        <label for="startdatum">startdatum</label>
                        <input type="date" name="startdatum" id="startdatum"
                               class="form-control"
                               placeholder="Startdatum"
                               minlength="3"
                               value="">
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="form-group ">
                        <label for="einddatum">einddatum</label>
                        <input type="date" name="einddatum" id="einddatum"
                               class="form-control"
                               placeholder="Einddatum"
                               minlength="3"
                               value="">
                        <div class="invalid-feedback"></div>
                    </div>

                    <div class="form-group ">
                        <label for="actief">actief</label>
                        <input type="text" name="actief" id="actief"
                               class="form-control"
                               placeholder="actief"
                               minlength="3"
                               value="">
                        <div class="invalid-feedback"></div>
                    </div>

                    <button type="submit" class="btn btn-success">Opslaan</button>
                </form>
            </div>
        </div>
    </div>
</div>
