<?php $activePage = 'gestione_audit'; ?>
<?php $activePageTitle = 'Gestione Audit'; ?>
<?php include 'header.php'; ?>

<div class="container mt-5">
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addModal">Aggiungi Record di Audit</button>

    <!-- Questo div conterrà le card dei record di audit -->
    <div id="auditContainer" class="card-columns">
    </div>
</div>

<!-- Modal per l'aggiunta di un record di audit -->
<div class="modal" id="addModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Aggiungi Record di Audit</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="addForm" method="post">
                    <div class="form-group">
                        <label for="titolo">Titolo:</label>
                        <input type="text" class="form-control" id="titolo" name="titolo" required>
                    </div>
                    <div class="form-group">
                        <label for="data">Data:</label>
                        <input type="date" class="form-control" id="data" name="data" required>
                    </div>
                    <div class="form-group">
                        <label for="auditor">Auditor:</label>
                        <input type="text" class="form-control" id="auditor" name="auditor" required>
                    </div>
                    <div class="form-group">
                        <label for="stato">Stato:</label>
                        <select class="form-control" id="stato" name="stato">
                            <option value="pianificato">Pianificato</option>
                            <option value="in corso">In corso</option>
                            <option value="completato">Completato</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Aggiungi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal per la modifica di un record di audit -->
<div class="modal" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modifica Record di Audit</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="post" action="update_audit.php">
                    <input type="hidden" id="editId" name="id">
                    <div class="form-group">
                        <label for="editTitolo">Titolo:</label>
                        <input type="text" class="form-control" id="editTitolo" name="titolo" required>
                    </div>
                    <div class="form-group">
                        <label for="editData">Data:</label>
                        <input type="date" class="form-control" id="editData" name="data" required>
                    </div>
                    <div class="form-group">
                        <label for="editAuditor">Auditor:</label>
                        <input type="text" class="form-control" id="editAuditor" name="auditor" required>
                    </div>
                    <div class="form-group">
                        <label for="editStato">Stato:</label>
                        <select class="form-control" id="editStato" name="stato">
                            <option value="pianificato">Pianificato</option>
                            <option value="in corso">In corso</option>
                            <option value="completato">Completato</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Salva Modifiche</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal per la cancellazione di un record di audit -->
<div class="modal" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Conferma Cancellazione</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                Sei sicuro di voler cancellare questo record di audit?
                <form id="deleteForm">
                    <input type="hidden" id="deleteId" name="id">
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger">Conferma Cancellazione</button>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function() {
        loadAuditRecords();

        // Funzione di caricamento dei record di audit
        function loadAuditRecords() {
            $.ajax({
                url: 'load_audit_records.php',
                type: 'POST',
                success: function(data) {
                    $('#auditContainer').html(data);
                }
            });
        }

        // Funzione di aggiunta di un record di audit
        $('#addForm').submit(function(e) {
            e.preventDefault();
            const formData = $(this).serialize();
            $.ajax({
                url: 'insert_audit.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    loadAuditRecords();
                    $('#addModal').modal('hide');
                }
            });
        });

        // Funzione di aggiornamento del record di audit
        $('#editForm').submit(function(e) {
            e.preventDefault();
            const formData = $(this).serialize();
            $.ajax({
                url: 'update_audit.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    loadAuditRecords();
                    $('#editModal').modal('hide');
                }
            });
        });

        // Funzione di cancellazione del record di audit
        $('#deleteForm').submit(function(e) {
            e.preventDefault();
            const formData = $(this).serialize();
            $.ajax({
                url: 'delete_audit.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    loadAuditRecords();
                    $('#deleteModal').modal('hide');
                }
            });
        });

        // Imposta l'ID del record di audit quando il pulsante "Modifica" viene cliccato
        $(document).on('click', '.btn-edit', function() {
            const auditId = $(this).data('id');
            $.ajax({
                url: 'get_audit_record_details.php',
                type: 'POST',
                data: { id: auditId },
                success: function(data) {
                    const audit = JSON.parse(data);
                    $('#editId').val(audit.id);
                    $('#editTitolo').val(audit.titolo);
                    $('#editData').val(audit.data);
                    $('#editAuditor').val(audit.auditor);
                    $('#editStato').val(audit.stato);
                    $('#editModal').modal('show');
                }
            });
        });

        // Imposta l'ID del record di audit quando il pulsante "Elimina" viene cliccato
        $(document).on('click', '.btn-delete', function() {
            const auditId = $(this).data('id');
            $('#deleteId').val(auditId);
            $('#deleteModal').modal('show');
        });
    });
</script>

<?php include 'footer.php'; ?>