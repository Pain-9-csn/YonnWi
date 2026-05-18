<!DOCTYPE html>
<html lang="en">
<?php require_once("../../../sections/admin/head.php"); ?>

<body>
    <div class="container-scroller">
        <?php require_once("../../../sections/admin/navbar.php"); ?>
        <!-- partial:partials/_sidebar.html -->
        <?php require_once("../../../sections/admin/sidebar.php"); ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">

            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title"> Xassidas PDF disponibles </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="model-add" data-bs-toggle="modal" data-bs-target="#modal-add"><span class="mdi mdi-plus">Ajouter</span></a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span class="mdi mdi-delete-empty">Corbeille</span></li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Listes Xassida PDF</h4>
                                    <p class="card-description"> Xassida <code>.table</code>
                                    </p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Titre</th>
                                                    <th>Date d'ajout</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>53275532</td>
                                                    <td>Mawahibou Nafih</td>
                                                    <td>15 May 2026</td>
                                                    <td><label class="badge badge-success">Optimal</label></td>
                                                </tr>
                                                <tr>
                                                    <td>53275533</td>
                                                    <td>Shakawtou</td>
                                                    <td>14 May 2017</td>
                                                    <td><label class="badge badge-success">Optimal</label></td>
                                                </tr>
                                                <tr>
                                                    <td>53275534</td>
                                                    <td>Peter</td>
                                                    <td>16 May 2017</td>
                                                    <td><label class="badge badge-success">Optimal</label></td>
                                                </tr>
                                                <tr>
                                                    <td>53275531</td>
                                                    <td>Doll 1</td>
                                                    <td>29 Mars 2026</td>
                                                    <td><label class="badge badge-warning">Volumineux</label></td>
                                                </tr>
                                                <tr>
                                                    <td>53275535</td>
                                                    <td>CHakartou rabiyya wa rabiyya</td>
                                                    <td>20 May 2018</td>
                                                    <td><label class="badge badge-danger">Indisponible</label></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:../../partials/_footer.html -->
                <footer class="footer">
                    <div class="d-sm-flex justify-content-center justify-content-sm-between">
                        <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2026 <a href="https://www.bootstrapdash.com/" target="_blank">BootstrapDash</a>. All rights reserved.</span>
                        <span class="text-muted float-none float-sm-end d-block mt-1 mt-sm-0 text-center"> <span class="text-muted float-none float-sm-end d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="mdi mdi-heart text-danger"></i></span> <i class="mdi mdi-heart text-danger"></i></span>
                    </div>
                </footer>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- Modal -->
    <div class="modal fade" id="modal-add" tabindex="-1" aria-labelledby="modalAddLabel" aria-hidden ="true" data-backdrop ="static" data-keyboard ="false">
    <div class="modal-dialog">
        <div class="modal-content">
            
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalAddLabel">Ajouter un Khassida</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <form id="form-khassida">

                    <!-- Titre -->
                    <div class="mb-3">
                        <label for="titre" class="form-label">Titre</label>
                        <input type="text" class="form-control" id="titre" name="titre" required>
                    </div>

                    <!-- Fichier PDF -->
                    <div class="mb-3">
                        <label for="fichier" class="form-label">Fichier PDF</label>
                        <input type="file" class="form-control" id="fichier" name="fichier" accept="application/pdf" required>
                    </div>

                    <!-- Date d'ajout -->
                    <div class="mb-3">
                        <label for="date_ajout" class="form-label">Date d'ajout</label>
                        <input type="date" class="form-control" id="date_ajout" name="date_ajout" required>
                    </div>

                    <!-- Statut -->
                    <div class="mb-3">
                        <label for="statut" class="form-label">Statut</label>
                        <select class="form-select" id="statut" name="statut" required>
                            <option value="">-- Choisir un statut --</option>
                            <option value="optimal">Optimal (lisible)</option>
                            <option value="volumineux">Volumineux (peut être lent)</option>
                            <option value="indisponible">Indisponible</option>
                        </select>
                    </div>

                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" form="form-khassida" class="btn btn-primary">Enregistrer</button>
            </div>

        </div>
    </div>
</div>
    <!-- plugins:js -->
    <?php require_once("../../../sections/admin/script.php"); ?>
    <!-- End custom js for this page -->
</body>

</html>