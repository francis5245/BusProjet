@extends('Admin.layout.template')
@section('title', 'Tableau de Bord')
@section('content')
    <div class="container-fluid mt-4">
        <div class="row g-3 mb-4">
            <div class="col-md-6 col-lg-3">
                <div class="card-gradient" style="--gradient: var(--gradient-trip);">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon">
                            <i class="fas fa-hard-hat"></i>
                        </div>
                        <div>
                            <div class="stat-number">4</div>
                            <div class="stat-label">Trajets Total</div>
                            <div class="mt-2"><i class="fas fa-caret-down me-1"></i> Aujourd'hui</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card-gradient" style="--gradient: var(--gradient-ticket);">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon">
                            <i class="fas fa-ticket-alt"></i>
                        </div>
                        <div>
                            <div class="stat-number">50</div>
                            <div class="stat-label">Réservations Total</div>
                            <div class="mt-2"><i class="fas fa-caret-down me-1"></i> Aujourd'hui</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card-gradient" style="--gradient: var(--gradient-booking);">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon">
                            <i class="fas fa-list-alt"></i>
                        </div>
                        <div>
                            <div class="stat-number">86</div>
                            <div class="stat-label">Montant Réservations</div>
                            <div class="mt-2"><i class="fas fa-caret-down me-1"></i> Aujourd'hui</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card-gradient" style="--gradient: var(--gradient-passenger);">
                    <div class="d-flex align-items-center">
                        <div class="stat-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <div class="stat-number">31</div>
                            <div class="stat-label">Passagers Total</div>
                            <div class="mt-2"><i class="fas fa-caret-down me-1"></i> Aujourd'hui</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Liste des trajets disponibles -->
        <div class="table-container">
            <div class="table-header">
                <h5>Liste des Trajets Disponibles</h5>
                <button class="btn-driver-report">Rapport Conducteur</button>
            </div>

            <div class="d-flex justify-content-between mb-3 flex-wrap">
                <div class="mb-2">
                    Afficher <select class="form-select form-select-sm d-inline-block w-auto">
                        <option>10</option>
                        <option>25</option>
                        <option>50</option>
                        <option>100</option>
                    </select> entrées
                </div>
                <div class="btn-group mb-2">
                    <button class="btn-export">Copier</button>
                    <button class="btn-export">CSV</button>
                    <button class="btn-export">Excel</button>
                    <button class="btn-export">PDF</button>
                    <button class="btn-export">Imprimer</button>
                </div>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">Rechercher :</span>
                <input type="text" class="form-control" placeholder="Rechercher des trajets...">
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th># <i class="fas fa-sort"></i></th>
                            <th>Départ <i class="fas fa-sort"></i></th>
                            <th>Arrivée <i class="fas fa-sort"></i></th>
                            <th>Horaire</th>
                            <th>Véhicule</th>
                            <th>Date de Début</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="badge bg-primary">1</span></td>
                            <td>Cox's Bazar</td>
                            <td>Dhaka</td>
                            <td>10:00 PM - 01:00 AM</td>
                            <td>Bus-101</td>
                            <td>2024-11-01</td>
                            <td>
                               <button class="btn btn-sm btn-success me-1" data-bs-toggle="modal" data-bs-target="#editTripModal" title="Modifier"><i
                                        class="fas fa-edit"></i></button>
                               <button class="btn btn-sm btn-info me-1" data-bs-toggle="modal" data-bs-target="#viewTripModal" title="Voir"><i class="fas fa-eye"></i></button>
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteTripModal" title="Supprimer"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="badge bg-primary">2</span></td>
                            <td>Dhaka</td>
                            <td>Rangpur</td>
                            <td>10:00 PM - 01:00 AM</td>
                            <td>Bus-102</td>
                            <td>2024-11-02</td>
                            <td>
                                <button class="btn btn-sm btn-success me-1" title="Modifier"><i
                                        class="fas fa-edit"></i></button>
                                <button class="btn btn-sm btn-info me-1" title="Voir"><i class="fas fa-eye"></i></button>
                                <button class="btn btn-sm btn-danger" title="Supprimer"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="badge bg-primary">3</span></td>
                            <td>Cox's Bazar</td>
                            <td>Dhaka</td>
                            <td>10:00 PM - 01:00 AM</td>
                            <td>Bus-103</td>
                            <td>2024-11-03</td>
                            <td>
                                <button class="btn btn-sm btn-success me-1" title="Modifier"><i
                                        class="fas fa-edit"></i></button>
                                <button class="btn btn-sm btn-info me-1" title="Voir"><i class="fas fa-eye"></i></button>
                                <button class="btn btn-sm btn-danger" title="Supprimer"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="badge bg-primary">4</span></td>
                            <td>Dhaka</td>
                            <td>Cox's Bazar</td>
                            <td>10:00 PM - 01:00 AM</td>
                            <td>Bus-104</td>
                            <td>2024-11-04</td>
                            <td>
                                <button class="btn btn-sm btn-success me-1" title="Modifier"><i
                                        class="fas fa-edit"></i></button>
                                <button class="btn btn-sm btn-info me-1" title="Voir"><i class="fas fa-eye"></i></button>
                                <button class="btn btn-sm btn-danger" title="Supprimer"><i
                                        class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center flex-wrap mt-3">
                <div class="mb-2">Affichage 1 à 4 sur 4 entrées</div>
                <div class="pagination mb-2">
                    <button>Précédent</button>
                    <button class="active">1</button>
                    <button>Suivant</button>
                </div>
                <button class="btn btn-success mb-2" style="padding: 5px 10px;" title="Ajouter un trajet">
                    <i class="fas fa-plus"></i> Ajouter un Trajet
                </button>
            </div>
        </div>
    </div>

    <!-- Modal d'édition -->
<div class="modal fade" id="editTripModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title" id="editModalLabel"><i class="fas fa-edit me-2"></i>Modifier le voyage</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editPickup" class="form-label">Départ <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="editPickup" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editDrop" class="form-label">Arrivée <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="editDrop" required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editSchedule" class="form-label">Horaire</label>
                            <input type="text" class="form-control" id="editSchedule" placeholder="HH:MM - HH:MM">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editVehicle" class="form-label">Véhicule</label>
                            <input type="text" class="form-control" id="editVehicle" placeholder="Bus-XXX">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="editTripDate" class="form-label">Date de Début <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="editTripDate" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="editStatus" class="form-label">Statut</label>
                            <select class="form-select" id="editStatus">
                                <option value="active">Actif</option>
                                <option value="inactive">Inactif</option>
                                <option value="completed">Complété</option>
                                <option value="cancelled">Annulé</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="editNotes" class="form-label">Notes additionnelles</label>
                        <textarea class="form-control" id="editNotes" rows="3" placeholder="Notes optionnelles..."></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                <button type="button" class="btn btn-success" id="saveChangesBtn">Enregistrer les modifications</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal pour Voir le trajet -->
<div class="modal fade" id="viewTripModal" tabindex="-1" aria-labelledby="viewTripModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-info text-white">
        <h5 class="modal-title" id="viewTripModalLabel">Détails du Trajet</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <ul class="list-group">
          <li class="list-group-item"><strong>Départ :</strong> <span id="viewPickup">Cox's Bazar</span></li>
          <li class="list-group-item"><strong>Arrivée :</strong> <span id="viewDrop">Dhaka</span></li>
          <li class="list-group-item"><strong>Horaire :</strong> <span id="viewSchedule">10:00 PM - 01:00 AM</span></li>
          <li class="list-group-item"><strong>Véhicule :</strong> <span id="viewVehicle">Bus-101</span></li>
          <li class="list-group-item"><strong>Date de Début :</strong> <span id="viewDate">2024-11-01</span></li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal pour Supprimer le trajet -->
<div class="modal fade" id="deleteTripModal" tabindex="-1" aria-labelledby="deleteTripModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="deleteTripModalLabel">Confirmer la Suppression</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="text-center mb-4">
          <i class="fas fa-exclamation-triangle text-danger fa-3x mb-3"></i>
          <h5>Êtes-vous sûr de vouloir supprimer ce trajet ?</h5>
          <p class="text-muted" id="deleteConfirmationText">
            Cette action supprimera définitivement le trajet <strong id="deletePickup">-</strong> vers <strong id="deleteDrop">-</strong>.
          </p>
          <div class="alert alert-warning mt-3">
            <i class="fas fa-exclamation-circle me-2"></i>
            <strong>Attention :</strong> Cette action est irréversible.
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Supprimer définitivement</button>
      </div>
    </div>
  </div>
</div>
@endsection
