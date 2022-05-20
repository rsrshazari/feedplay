<script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="../assets1/js/core/popper.min.js"></script>
  <script src="../assets1/js/core/bootstrap.min.js"></script>
  <script src="../assets1/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets1/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets1/js/plugins/chartjs.min.js"></script>
<script src="../assets1/js/argon-dashboard.min790f.js?v=2.0.1"></script>
<script src="../assets1/js/custom.js"></script>

<script>
   var win = navigator.platform.indexOf('Win') > -1;
   if (win && document.querySelector('#sidenav-scrollbar')) {
     var options = {
       damping: '0.5'
     }
     Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
   }
 </script>
 <script type="text/javascript">
 $(document).ready(function(){
   $('.modal').modal({
   backdrop: 'static',
   keyboard: false
 });
});
 </script>
