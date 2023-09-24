<?php $activePage = 'gestione_dipendenti'; ?>
<?php $activePageTitle = 'Gestione Dipendenti'; ?>
<?php include 'header.php'; ?>

<div class="container mt-5">
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addModal">Aggiungi Dipendente</button>
   
    <!-- Questo div conterrà le card dei dipendenti -->
    <div id="dipendentiContainer" class="card-columns">
    </div>
</div>

<!-- Modal per l'aggiunta di un dipendente -->
<div class="modal" id="addModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Aggiungi Dipendente</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="addForm">
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label for="cognome">Cognome:</label>
                        <input type="text" class="form-control" id="cognome" name="cognome" required>
                    </div>
                    <div class="form-group">
                        <label for="ruolo">Ruolo:</label>
                        <input type="text" class="form-control" id="ruolo" name="ruolo" required>
                    </div>
                    <div class="form-group">
                        <label for="data_assunzione">Data Assunzione:</label>
                        <input type="date" class="form-control" id="data_assunzione" name="data_assunzione" required>
                    </div>
                    <div class="form-group">
                        <label for="data_nascita">Data Nascita:</label>
                        <input type="date" class="form-control" id="data_nascita" name="data_nascita" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="codice_fiscale">Codice Fiscale:</label>
                        <input type="text" class="form-control" id="codice_fiscale" name="codice_fiscale" required>
                    </div>
				    <div class="modal-footer">
						<button type="submit" class="btn btn-primary">Aggiungi</button>
					</div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal per la modifica di un dipendente -->
<div class="modal" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modifica Dipendente</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <input type="hidden" id="editId" name="id">
                    <div class="form-group">
                        <label for="editNome">Nome:</label>
                        <input type="text" class="form-control" id="editNome" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label for="editCognome">Cognome:</label>
                        <input type="text" class="form-control" id="editCognome" name="cognome" required>
                    </div>
                    <div class="form-group">
                        <label for="editRuolo">Ruolo:</label>
                        <input type="text" class="form-control" id="editRuolo" name="ruolo" required>
                    </div>
                    <div class="form-group">
                        <label for="editData_assunzione">Data Assunzione:</label>
                        <input type="date" class="form-control" id="editData_assunzione" name="data_assunzione" required>
                    </div>
                    <div class="form-group">
                        <label for="editData_nascita">Data Nascita:</label>
                        <input type="date" class="form-control" id="editData_nascita" name="data_nascita" required>
                    </div>
                    <div class="form-group">
                        <label for="editEmail">Email:</label>
                        <input type="email" class="form-control" id="editEmail" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="editCodice_fiscale">Codice Fiscale:</label>
                        <input type="text" class="form-control" id="editCodice_fiscale" name="codice_fiscale" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Salva Modifiche</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal per la cancellazione di un dipendente -->
<div class="modal" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Conferma Cancellazione</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                Sei sicuro di voler cancellare questo dipendente?
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
        loadDipendenti();

        // Funzione di caricamento dei dipendenti
        function loadDipendenti() {
            $.ajax({
                url: 'loadDipendenti.php',
                type: 'GET',
                success: function(data) {
                    $('#dipendentiContainer').html(data);
                }
            });
        }

        // Funzione di aggiornamento del dipendente
        $('#editForm').submit(function(e) {
            e.preventDefault();
            const formData = $(this).serialize();
            $.ajax({
                url: 'updateDipendente.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    loadDipendenti();
                    $('#editModal').modal('hide');
                }
            });
        });

        // Funzione di cancellazione del dipendente
        $('#deleteForm').submit(function(e) {
            e.preventDefault();
            const formData = $(this).serialize();
            $.ajax({
                url: 'deleteDipendente.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    loadDipendenti();
                    $('#deleteModal').modal('hide');
                }
            });
        });

        // Imposta l'ID del dipendente quando il pulsante "Modifica" viene cliccato
        $(document).on('click', '.btn-edit', function() {
            const dipendenteId = $(this).data('id');
            $.ajax({
                url: 'getDipendenteDetails.php',
                type: 'POST',
                data: { id: dipendenteId },
                success: function(data) {
                    const dipendente = JSON.parse(data);
                    $('#editId').val(dipendente.id);
                    $('#editNome').val(dipendente.nome);
                    $('#editCognome').val(dipendente.cognome);
                    $('#editRuolo').val(dipendente.ruolo);
                    $('#editData_assunzione').val(dipendente.data_assunzione);
                    $('#editData_nascita').val(dipendente.data_nascita);
                    $('#editEmail').val(dipendente.email);
                    $('#editCodice_fiscale').val(dipendente.codice_fiscale);
                    $('#editModal').modal('show');
                }
            });
        });

        // Imposta l'ID del dipendente quando il pulsante "Elimina" viene cliccato
        $(document).on('click', '.btn-delete', function() {
            const dipendenteId = $(this).data('id');
            $('#deleteId').val(dipendenteId);
            $('#deleteModal').modal('show');
        });
    });
</script>

<?php include 'footer.php'; ?>