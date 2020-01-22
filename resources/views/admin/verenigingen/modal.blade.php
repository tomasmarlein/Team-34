<div class="modal" id="modal-vereniging">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Vereniging Modal</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    @method('')
                    @csrf
                    <div class="form-group">
                        <label for="naam">Naam</label>
                        <input type="text" name="naam" id="naam"
                               class="form-control"
                               placeholder="Naam"
                               minlength="3"
                               required
                               value="">
                        <div class="invalid-feedback"></div>
                    </div>
                    <button type="submit" class="btn btn-success">Opslagen</button>
                </form>
            </div>
        </div>
    </div>
</div>
