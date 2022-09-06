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
        <div class="col-md-12">
          <div class="card">
              <div class="card-header">Tracking</div>

              <div class="card-body">
                <div class="tab">
                  <button class="tablinks active" onclick="openTrack(event, 'queOSI')">In queue at OSI</button>
                  <button class="tablinks" onclick="openTrack(event, 'queDV')">In queue at DV</button>
                  <button class="tablinks" onclick="openTrack(event, 'queCP')">In queue at CP</button>
                  <button class="tablinks" onclick="openTrack(event, 'onShift')">On Shiftting</button>
                  <button class="tablinks" onclick="openTrack(event, 'finishShift')">Finished Shiftted</button>
                </div>

                <div id="queOSI" class="tabcontent" style="display: block;">
                  <h3>In queue at OSI</h3>
                  <table border="1" class="table table-hover" id="myTable" style="width:100%">
                    <thead>
                      <th class="text-center"><input id="select_all" value="1" type="checkbox"></th>
                      <th class="text-center">ID</th>
                      <th class="text-center">Box Number</th>
                      <th class="text-center">Package Number</th>
                      <th class="text-center">Packing Date</th>
                      <th class="text-center">Action</th>
                    </thead>
                    <tbody align="center">
                    </tbody>
                  </table>
                  <div style="float: right">
                    <input type="button" class="btn btn-danger" value="X Cancel request" id="submit">
                    <input type="button" class="btn btn-success" value="&#x2713; Send to DV" id="submit">
                  </div>
                </div>

                <div id="queDV" class="tabcontent">
                  <h3>In queue at DV</h3>
                  <table border="1" class="table table-hover" id="myTable" style="width:100%">
                    <thead>
                      <th class="text-center"><input id="select_all" value="1" type="checkbox"></th>
                      <th class="text-center">ID</th>
                      <th class="text-center">Box Number</th>
                      <th class="text-center">Package Number</th>
                      <th class="text-center">Packing Date</th>
                      <th class="text-center">Action</th>
                    </thead>
                    <tbody align="center">
                    </tbody>
                  </table>
                  <div style="float: right">
                    <input type="button" class="btn btn-danger" value="X Cancel request" id="submit">
                    <input type="button" class="btn btn-success" value="&#x2713; Send to CP" id="submit">
                  </div>
                </div>

                <div id="queCP" class="tabcontent">
                  <h3>In queue at CP</h3>
                  <table border="1" class="table table-hover" id="myTable" style="width:100%">
                    <thead>
                      <th class="text-center"><input id="select_all" value="1" type="checkbox"></th>
                      <th class="text-center">ID</th>
                      <th class="text-center">Box Number</th>
                      <th class="text-center">Package Number</th>
                      <th class="text-center">Packing Date</th>
                      <th class="text-center">Action</th>
                    </thead>
                    <tbody align="center">
                    </tbody>
                  </table>
                  <div style="float: right">
                    <input type="button" class="btn btn-danger" value="X Cancel request" id="submit">
                    <input type="button" class="btn btn-success" value="&#x2713; Proceed to shiftting" id="submit">
                  </div>
                </div>

                <div id="onShift" class="tabcontent">
                  <h3>On Shiftting</h3>
                  <table border="1" class="table table-hover" id="myTable" style="width:100%">
                    <thead>
                      <th class="text-center"><input id="select_all" value="1" type="checkbox"></th>
                      <th class="text-center">ID</th>
                      <th class="text-center">Box Number</th>
                      <th class="text-center">Package Number</th>
                      <th class="text-center">Packing Date</th>
                      <th class="text-center">Action</th>
                    </thead>
                    <tbody align="center">
                    </tbody>
                  </table>
                  <div style="float: right">
                    <input type="button" class="btn btn-danger" value="X Cancel request" id="submit">
                    <input type="button" class="btn btn-success" value="&#x2713; Finish shiftting" id="submit">
                  </div>
                </div>

                <div id="finishShift" class="tabcontent">
                  <h3>Finished Shiftted</h3>
                  <table border="1" class="table table-hover" id="myTable" style="width:100%">
                    <thead>
                      <th class="text-center"><input id="select_all" value="1" type="checkbox"></th>
                      <th class="text-center">ID</th>
                      <th class="text-center">Box Number</th>
                      <th class="text-center">Package Number</th>
                      <th class="text-center">Packing Date</th>
                      <th class="text-center">Action</th>
                    </thead>
                    <tbody align="center">
                    </tbody>
                  </table>
                </div>

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