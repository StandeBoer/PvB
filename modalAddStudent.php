<!-- Modal voor het toevoegen van een student -->
<!-- Eerste div id moet gelijk zijn aan de data-target hashtag -->
        <div id="ModalAddStudent" class="modal fade" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Student toevoegen</h4>
                    </div>
                    <div class="modal-body">
                        <label>Naam:</label>
                        <input type="text" class="form-control" name="student_naam" placeholder="Naam" required>
                        <br>
                        <label>E-mailadres:</label>
                        <input type="text" class="form-control" name="student_email" placeholder="Emailadres" required>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="NewStudentSubmit" class="btn btn-success" value="Versturen">
                    </div>
                </div>

            </div>
        </div>