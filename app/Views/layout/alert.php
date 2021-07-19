<?php
    if(session()->getFlashData('error')){ ?>
	<div class="modal fade" id="alertFalse" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered " role="document">
			<div class="modal-content alert alert-danger">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Error</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div >
					<?= session()->getFlashData('error') ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(document).ready(function(){
			$('#alertFalse').modal('show')
		})
	</script>
<?php
}?> 
<?php
    if(session()->getFlashData('success')){ ?>
    
	<div class="modal fade" id="alertTrue" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered " role="document">
			<div class="modal-content alert alert-success">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Success</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div >
					<?= session()->getFlashData('success') ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
		$(document).ready(function(){
			$('#alertTrue').modal('show')
		})
	</script>
<?php } ?>

