<?php $activePage = 'gestione_utenti'; ?>
<?php $activePageTitle = 'Gestione Utenti'; ?>
<?php include 'header.php'; ?>

<div class="container mt-5">
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addModal">Aggiungi Utente</button>
   
    <!-- Questo div conterrà le card degli utenti -->
    <div id="utentiContainer" class="card-columns">
    </div>
</div>

<!-- Modal per l'aggiunta di un utente -->
<div class="modal" id="addModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Aggiungi Utente</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="addForm" method="post" action="insert_utente.php">
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" class="form-control" id="nome" name="nome" required>
                    </div>
                    <div class="form-group">
                        <label for="cognome">Cognome:</label>
                        <input type="text" class="form-control" id="cognome" name="cognome" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="ruolo">Ruolo:</label>
                        <select class="form-control" id="ruolo" name="ruolo">
                            <option value="amministratore">Amministratore</option>
                            <option value="manager">Manager</option>
                            <option value="dipendente">Dipendente</option>
                            <option value="revisore">Revisore</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="data_nascita">Data Nascita:</label>
                        <input type="date" class="form-control" id="data_nascita" name="data_nascita">
                    </div>
                    <div class="form-group">
                        <label for="codice_fiscale">Codice Fiscale:</label>
                        <input type="text" class="form-control" id="codice_fiscale" name="codice_fiscale">
                    </div>
				    <div class="modal-footer">
						<button type="submit" class="btn btn-primary">Aggiungi</button>
					</div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal per la modifica di un utente -->
<div class="modal" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modifica Utente</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="post" action="updateUtente.php">
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
                        <label for="editEmail">Email:</label>
                        <input type="email" class="form-control" id="editEmail" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="editPassword">Password:</label>
                        <input type="password" class="form-control" id="editPassword" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="editRuolo">Ruolo:</label>
                        <select class="form-control" id="editRuolo" name="ruolo">
                            <option value="amministratore">Amministratore</option>
                            <option value="manager">Manager</option>
                            <option value="dipendente">Dipendente</option>
                            <option value="revisore">Revisore</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editData_nascita">Data Nascita:</label>
                        <input type="date" class="form-control" id="editData_nascita" name="data_nascita">
                    </div>
                    <div class="form-group">
                        <label for="editCodice_fiscale">Codice Fiscale:</label>
                        <input type="text" class="form-control" id="editCodice_fiscale" name="codice_fiscale">
                    </div>
					            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Salva Modifiche</button>
            </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal per la cancellazione di un utente -->
<div class="modal" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Conferma Cancellazione</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                Sei sicuro di voler cancellare questo utente?
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
        loadUtenti();

        // Funzione di caricamento degli utenti
        function loadUtenti() {
            $.ajax({
                url: 'loadUtenti.php',
                type: 'POST',
                success: function(data) {
                    $('#utentiContainer').html(data);
                }
            });
        }

    // Funzione di aggiunta di un utente
    $('#addForm').submit(function(e) {
        e.preventDefault();
        const formData = $(this).serialize();
        $.ajax({
            url: 'insert_utente.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                loadUtenti();
                $('#addModal').modal('hide');
				location.reload();
            }
        });
    });

	// Funzione di aggiornamento dell'utente
	$('#editForm').submit(function(e) {
		e.preventDefault();
		const formData = $(this).serialize();
		$.ajax({
			url: 'updateUtente.php',
			type: 'POST',
			data: formData,
			success: function(response) {
				console.log('Aggiornamento utente:', response); // Aggiungi un log di debug
				loadUtenti();
				$('#editModal').modal('hide');
			},
			error: function(xhr, status, error) {
				console.log('Errore AJAX:', error); // Aggiungi un log di debug per gli errori
			}
		});
	});

        // Funzione di cancellazione dell'utente
        $('#deleteForm').submit(function(e) {
            e.preventDefault();
            const formData = $(this).serialize();
            $.ajax({
                url: 'deleteUtente.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    loadUtenti();
                    $('#deleteModal').modal('hide');
                }
            });
        });

        // Imposta l'ID dell'utente quando il pulsante "Modifica" viene cliccato
        $(document).on('click', '.btn-edit', function() {
            const utenteId = $(this).data('id');
            $.ajax({
                url: 'getUtenteDetails.php',
                type: 'POST',
                data: { id: utenteId },
                success: function(data) {
                    const utente = JSON.parse(data);
                    $('#editId').val(utente.id);
                    $('#editNome').val(utente.nome);
                    $('#editCognome').val(utente.cognome);
                    $('#editEmail').val(utente.email);
                    // Non recuperiamo la password per ragioni di sicurezza
                    $('#editRuolo').val(utente.ruolo);
                    $('#editData_nascita').val(utente.data_nascita);
                    $('#editCodice_fiscale').val(utente.codice_fiscale);
                    $('#editModal').modal('show');
                }
            });
        });

        // Imposta l'ID dell'utente quando il pulsante "Elimina" viene cliccato
        $(document).on('click', '.btn-delete', function() {
            const utenteId = $(this).data('id');
            $('#deleteId').val(utenteId);
            $('#deleteModal').modal('show');
        });
    });
</script>

<?php include 'footer.php'; ?>