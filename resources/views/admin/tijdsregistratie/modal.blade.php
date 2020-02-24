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
                            <input type="datetime-local"  name="" id="checkIn"
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
                            <input type="datetime-local" name="checkUit" id="checkUit"
                                   class="form-control"
                                   placeholder="CheckUit"
                                   value="06/09/2020 22:30" disabled>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="container">
                        <br><br><br>
                        <div class='col-sm-6'>
                            <div class="form-group">
                                <label for="">Simple Date &amp; Time</label>
                                <div class='input-group date' id='example1'>
                                    <input type='text' class="form-control" />
                                    <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                 </span>
                                </div>
                            </div>
                        </div>
                    </div>


            </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="CheckUit">CheckUit</label>
                            <input type="datetime-local" name="checkUit" id="checkUit"
                                   class="form-control"
                                   placeholder="CheckUit"
                                   value="" disabled>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="CheckUit">CheckUit</label>
                            <input type="datetime-local" name="checkUit" id="checkUit"
                                   class="form-control"
                                   placeholder="CheckUit"
                                   value="" disabled>
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="CheckUit">CheckUit</label>
                            <input type="datetime-local" name="checkUit" id="checkUit"
                                   class="form-control"
                                   placeholder="CheckUit"
                                   value="" >
                            <div class="invalid-feedback"></div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="datetime">CheckUit</label>
                            <input type="date" name="checkUit" id="checkUit"
                                   class="form-control"
                                   placeholder="CheckUit"
                                   value="" >
                            <div class="invalid-feedback"></div>
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
