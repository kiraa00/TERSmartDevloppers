<footer class="footer_area section_gap_top">
		<div class="container">
			<div class="row single-footer-widget">	
			</div>

			<div class="footer_style" style="text-align:center;padding-bottom:20px;">
					
					<a style="color:white;margin-left:15px;" href="<?php echo base_url('index.php/mentions');?>" >Mentions légales</a>
					<a style="color:white;margin-left:15px;" href="<?php echo base_url('index.php/conditions');?>">Conditions d'utilisation</a>
					<a style="color:white;margin-left:15px;" href="<?php echo base_url('index.php/a-propos');?>">À propos d'Enigmots</a>
					<a style="color:white;margin-left:15px;" href="<?php echo base_url('index.php/export');?>">Export</a>
					<a style="color:white;margin-left:15px;" href="<?php echo base_url('index.php/Contact');?>">Contact</a><br>
					<a style="color:white;margin-left:15px;" href="<?php echo base_url('');?>">~ Enigmots © <?php echo date("Y"); ?> ~</a>
				
			</div>
			
		</div>
	</footer>
	<!--================End Footer Area =================-->

	<!-- Optional JavaScript -->
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.js"></script>

	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.6.8-fix/jquery.nicescroll.min.js"> </script>
	<script src="<?php echo base_url('assets/js/sweetalert.js');?>"></script>
	<script src="<?php echo base_url('assets/js/popper.js');?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/bootstrap-multiselect.js');?>"></script>
	<script src="<?php echo base_url('assets/js/stellar.js');?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.magnific-popup.min.js');?>"></script>
	<script src="<?php echo base_url('assets/vendors/nice-select/js/jquery.nice-select.min.js');?>"></script>
	<script src="<?php echo base_url('assets/vendors/isotope/imagesloaded.pkgd.min.js');?>"></script>
	<script src="<?php echo base_url('assets/vendors/isotope/isotope-min.js');?>"></script>
	<script src="<?php echo base_url('assets/vendors/owl-carousel/owl.carousel.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.ajaxchimp.min.js');?>"></script>
	<script src="<?php echo base_url('assets/vendors/counter-up/jquery.waypoints.min.js');?>"></script>
	<script src="<?php echo base_url('assets/vendors/counter-up/jquery.counterup.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/mail-script.js');?>"></script>
	<!--gmaps Js-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="<?php echo base_url('assets/js/gmaps.min.js');?>"></script>
	<script src="<?php echo base_url('assets/js/theme.js');?>"></script>
	<script src="<?php echo base_url('assets/js/jquery.selection.js');?>"></script>
	<?php if (isset($javaFile) && $javaFile !== "") { ?><script src="<?php echo base_url($javaFile);?>"></script><?php } ?>
	<script src="<?php echo base_url('assets/js/inscription.js');?>"></script>
	<script src="<?php echo base_url('assets/js/connexion.js');?>"></script>
	<script src="<?php echo base_url('assets/js/creation_rattachement.js');?>"></script>
	<script src="<?php echo base_url('assets/js/header.js');?>"></script>


</body>

</html>