<div class="container-scroller">
  <!-- partial -->
  <div class="container-fluid page-body-wrapper">
    <!-- partial -->
    <?php include_once "view/admin/component/side_bar.php"; ?>
    <!-- partial -->
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">

          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">

                <nav>
                  <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button data-status="all" class="tab-content-clickable nav-link active" id="nav-all-tab" data-bs-toggle="tab" data-bs-target="#nav-all" type="button" role="tab" aria-controls="nav-all" aria-selected="true">All Order</button>
                    <button data-status="new" class="tab-content-clickable nav-link" id="nav-new-tab" data-bs-toggle="tab" data-bs-target="#nav-new" type="button" role="tab" aria-controls="nav-new" aria-selected="false">New</button>
                    <button data-status="processing" class="tab-content-clickable nav-link" id="nav-processing-tab" data-bs-toggle="tab" data-bs-target="#nav-processing" type="button" role="tab" aria-controls="nav-processing" aria-selected="false">Processing</button>
                    <button data-status="confirmed" class="tab-content-clickable nav-link" id="nav-confirm-tab" data-bs-toggle="tab" data-bs-target="#nav-confirm" type="button" role="tab" aria-controls="nav-confirm" aria-selected="false">Confirmed</button>
                    <button data-status="on_delivery" class="tab-content-clickable nav-link" id="nav-on-delivery-tab" data-bs-toggle="tab" data-bs-target="#nav-on-delivery" type="button" role="tab" aria-controls="nav-on-delivery" aria-selected="false">On delivery</button>
                    <button data-status="completed" class="tab-content-clickable nav-link" id="nav-completed-tab" data-bs-toggle="tab" data-bs-target="#nav-completed" type="button" role="tab" aria-controls="nav-completed" aria-selected="false">Completed</button>
                    <button data-status="cancelled" class="tab-content-clickable nav-link" id="nav-cancel-tab" data-bs-toggle="tab" data-bs-target="#nav-cancel" type="button" role="tab" aria-controls="nav-cancel" aria-selected="false">Cancelled</button>
                  </div>
                </nav>

                <div class="tab-content" id="nav-tabContent">
                  <div class="render-tab-layout"> <!-- class render tab layout -->

                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
      <!-- content-wrapper ends -->
      <?php include_once "view/admin/component/footer.php" ?>
      <!-- partial -->
    </div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->
</div>