<!-- Modal voor het toevoegen van een student 
 Eerste div id moet gelijk zijn aan de data-target hashtag -->
        <div id="ModalAddStudent" class="modal fade" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Student toevoegen</h4>
                    </div>
                    <div class="modal-body">
                        <form method="POST">
                        <label>Naam:</label>
                        <input type="text" class="form-control" style="border-radius: 0;" name="student_naam" placeholder="Naam" required>
                        <br>
                        <label>E-mailadres:</label>
                        <input type="text" class="form-control" style="border-radius: 0;" name="student_email" placeholder="Emailadres" required>
                        <input type="submit" name="NewStudentSubmit" class="btn btn-success" value="Versturen" style="border-radius: 0;">
                        </form>
                        <?php 

                        ?>
                        </div>
                    <div class="modal-footer">
                    </div>
                </div>

            </div>
        </div>


<!-- Modal voor het toevoegen van een student 
 Eerste div id moet gelijk zijn aan de data-target hashtag -->
<!--        <div id="ModalAddStudent" class="modal">
            <div class="modal-header">
                <h5>Add Student</h5>
            </div>
            <div class="modal-content">
                
                <label>Naam:</label>
                <input type="text" placeholder="Naam">
            </div>
            <div class="modal-footer">
                <button style="float:right">Send</button>
            </div>
        </div>-->