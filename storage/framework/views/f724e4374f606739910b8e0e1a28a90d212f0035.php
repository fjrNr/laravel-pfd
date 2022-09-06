<?php if(Auth::user()->role == 'Admin' || Auth::user()->role == 'Group B'): ?>
	

	<?php $__env->startSection('title'); ?>
	Index Box
	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('styles'); ?>
		<link href="<?php echo e(asset('css/menu/tab.css')); ?>" rel="stylesheet">
	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('scripts'); ?>
	<?php $__env->stopSection(); ?>

	<?php $__env->startSection('content'); ?>
		<div class="container">
		    <div class="row justify-content-center">
		        <div class="col-md-10">
		            <div class="card">
		                <div class="card-header">
		                	Index Loan
		                	<div style="float: right;">
			                	<a href="javascript:void(0);" class="btn btn-warning" id="returnBtn" style="font-weight: bold;"> &#x21E5; Return Doc</a>
			                	<a href="javascript:void(0);" class="btn btn-success" id="addNewBtn" style="font-weight: bold;"> &#xff0b; Add New</a>
		                	</div>
		                </div>

						<div class="card-body">
			                <div class="tab">
			                  <button class="tablinks active" onclick="openTrack(event, 'being')">Being Loaned</button>
			                  <button class="tablinks" onclick="openTrack(event, 'hasBeen')">Has Been Loaned</button>
			                </div>

			                <div id="being" class="tabcontent" style="display: block;">
			                  <h3>Being Loaned</h3>
			                  <table border="1" class="table table-hover" id="myTable" style="width:100%">
			                    <thead>
			                      <th class="text-center">Form Number</th>
			                      <th class="text-center">Package Number</th>
			                      <th class="text-center">Crew Number</th>
			                      <th class="text-center">Crew Name</th>
			                      <th class="text-center">Borrowing Date</th>
			                      <th class="text-center">Deadline</th>
			                    </thead>
			                    <tbody align="center">
			                    </tbody>
			                  </table>
			                </div>

			                <div id="hasBeen" class="tabcontent">
			                  <h3>Has Been Loaned</h3>
			                  <table border="1" class="table table-hover" id="myTable" style="width:100%">
			                    <thead>
			                      <th class="text-center">Form Number</th>
			                      <th class="text-center">Package Number</th>
			                      <th class="text-center">Crew Number</th>
			                      <th class="text-center">Crew Name</th>
			                      <th class="text-center">Borrowing Date</th>
			                      <th class="text-center">Return Date</th>
			                    </thead>
			                    <tbody align="center">
			                    </tbody>
			                  </table>
			                </div>
			                <?php echo $__env->make('loan.insert', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			                <?php echo $__env->make('loan.return', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			          	</div>
		            </div>
	            </div>
            </div>
        </div>
        <script type="text/javascript">
        	function openTrack(evt, trackName) {
				var i, tabcontent, tablinks;
				tabcontent = document.getElementsByClassName("tabcontent");
				for (i = 0; i < tabcontent.length; i++) {
				  tabcontent[i].style.display = "none";
				}
				tablinks = document.getElementsByClassName("tablinks");
				for (i = 0; i < tablinks.length; i++) {
				  tablinks[i].className = tablinks[i].className.replace(" active", "");
				}
				document.getElementById(trackName).style.display = "block";
				evt.currentTarget.className += " active";
		    }

		    $('#returnBtn').click(function(){
		    	$('#myModalReturn').modal('show');
		    });

		    $('#addNewBtn').click(function(){
		    	$('#myModalAddLoan').modal('show');
		    });
        </script>
	<?php $__env->stopSection(); ?>
<?php else: ?>
    <title>Unauthorized.</title>
    <?php
    echo 'You are unauthorized to access this page';
    return back();
    ?>
<?php endif; ?>
<?php echo $__env->make('layouts.appTest', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>