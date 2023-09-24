<?php $activePage = 'gestione_azioni_correttive'; ?>
<?php $activePageTitle = 'Gestione Azioni Correttive'; ?>
<?php include 'header.php'; ?>

<div class="container mt-5">
    <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#addModal">Aggiungi Azione Correttiva</button>
   
    <!-- Questo div conterrà le card delle azioni correttive -->
    <div id="azioniCorrettiveContainer" class="card-columns">
    </div>
</div>

<!-- Modal per l'aggiunta di un'azione correttiva -->
<div class="modal" id="addModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Aggiungi Azione Correttiva</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="addForm" method="post" action="insert_azione_correttiva.php">
                    <div class="form-group">
                        <label for="descrizione">Descrizione:</label>
                        <textarea class="form-control" id="descrizione" name="descrizione" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="data">Data:</label>
                        <input type="date" class="form-control" id="data" name="data" required>
                    </div>
                    <div class="form-group">
                        <label for="responsabile">Responsabile:</label>
                        <input type="text" class="form-control" id="responsabile" name="responsabile">
                    </div>
                    <div class="form-group">
                        <label for="stato">Stato:</label>
                        <select class="form-control" id="stato" name="stato">
                            <option value="pianificato">Pianificato</option>
                            <option value="in corso">In Corso</option>
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

<!-- Modal per la modifica di un'azione correttiva -->
<div class="modal" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Modifica Azione Correttiva</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form id="editForm" method="post" action="updateAzioneCorrettiva.php">
                    <input type="hidden" id="editId" name="id">
                    <div class="form-group">
                        <label for="editDescrizione">Descrizione:</label>
                        <textarea class="form-control" id="editDescrizione" name="descrizione" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="editData">Data:</label>
                        <input type="date" class="form-control" id="editData" name="data" required>
                    </div>
                    <div class="form-group">
                        <label for="editResponsabile">Responsabile:</label>
                        <input type="text" class="form-control" id="editResponsabile" name="responsabile">
                    </div>
                    <div class="form-group">
                        <label for="editStato">Stato:</label>
                        <select class="form-control" id="editStato" name="stato">
                            <option value="pianificato">Pianificato</option>
                            <option value="in corso">In Corso</option>
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

<!-- Modal per la cancellazione di un'azione correttiva -->
<div class="modal" id="deleteModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Conferma Cancellazione</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                Sei sicuro di voler cancellare questa azione correttiva?
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
        loadAzioniCorrettive();

        // Funzione di caricamento delle azioni correttive
        function loadAzioniCorrettive() {
            $.ajax({
                url: 'loadAzioniCorrettive.php',
                type: 'POST',
                success: function(data) {
                    $('#azioniCorrettiveContainer').html(data);
                }
            });
        }

        // Funzione di aggiunta di un'azione correttiva
        $('#addForm').submit(function(e) {
            e.preventDefault();
            const formData = $(this).serialize();
            $.ajax({
                url: 'insert_azione_correttiva.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    loadAzioniCorrettive();
                    $('#addModal').modal('hide');
                    location.reload();
                }
            });
        });

        // Funzione di aggiornamento di un'azione correttiva
        $('#editForm').submit(function(e) {
            e.preventDefault();
            const formData = $(this).serialize();
            $.ajax({
                url: 'updateAzioneCorrettiva.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    console.log('Aggiornamento azione correttiva:', response);
                    loadAzioniCorrettive();
                    $('#editModal').modal('hide');
                },
                error: function(xhr, status, error) {
                    console.log('Errore AJAX:', error);
                }
            });
        });

        // Funzione di cancellazione di un'azione correttiva
        $('#deleteForm').submit(function(e) {
            e.preventDefault();
            const formData = $(this).serialize();
            $.ajax({
                url: 'delete_azione_correttiva.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    loadAzioniCorrettive();
                    $('#deleteModal').modal('hide');
                }
            });
        });

        // Imposta l'ID dell'azione correttiva quando il pulsante "Modifica" viene cliccato
        $(document).on('click', '.btn-edit', function() {
            const azioneCorrettivaId = $(this).data('id');
            $.ajax({
                url: 'getAzioneCorrettivaDetails.php',
                type: 'POST',
                data: { id: azioneCorrettivaId },
                success: function(data) {
                    const azioneCorrettiva = JSON.parse(data);
                    $('#editId').val(azioneCorrettiva.id);
                    $('#editDescrizione').val(azioneCorrettiva.descrizione);
                    $('#editData').val(azioneCorrettiva.data);
                    $('#editResponsabile').val(azioneCorrettiva.responsabile);
                    $('#editStato').val(azioneCorrettiva.stato);
                    $('#editModal').modal('show');
                }
            });
        });

        // Imposta l'ID dell'azione correttiva quando il pulsante "Elimina" viene cliccato
        $(document).on('click', '.btn-delete', function() {
            const azioneCorrettivaId = $(this).data('id');
            $('#deleteId').val(azioneCorrettivaId);
            $('#deleteModal').modal('show');
        });
    });
</script>

<?php include 'footer.php'; ?>