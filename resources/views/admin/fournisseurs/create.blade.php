<!-- Modal -->
<div class="modal fade" id="modalAjoutFournisseur" tabindex="-1" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Ajouter un fournisseur</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Messages d'erreur et de succès -->
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Formulaire d'ajout de fournisseur -->
                <form action="{{ route('admin.fournisseurs.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col mb-3">
                            <label for="nom" class="form-label">Nom du fournisseur</label>
                            <input type="text" id="nom" class="form-control" name="nom"
                                placeholder="Entrez le nom du fournisseur" required>
                        </div>
                    </div>
                    <div class="row">
                        <label for="adresse" class="form-label"> Adresse fournisseur</label>
                        <input class="form-control" type="text" name="adresse" id="adresse"
                            placeholder="Adresse du fournisseur" required>
                    </div>

                    <div class="row g-2">
                        <div class="col mb-0">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email" class="form-control" name="email"
                                placeholder="xxxx@xxx.xx" required>
                        </div>
                        <div class="col mb-0">
                            <label for="telephone" class="form-label">Téléphone</label>
                            <input type="tel" class="form-control" name="telephone" id="telephone">
                        </div>
                    </div>

                    <!-- Boutons du modal -->
                    <div class="modal-footer mt-3">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
