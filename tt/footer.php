</section>
</section>
 <!-- js placed at the end of the document so the pages load faster -->

    <script src="assets/js/bootstrap.min.js"></script>

    <script src="assets/js/tablesort.min.js"></script>
    <script src="assets/js/tablesort.date.js"></script>
    <script src="assets/js/tablesort.number.js"></script>

    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="ajax.js" type="text/javascript"></script>

    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>

    <!--script for this page-->
    <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script>
    
  <script type="text/javascript">
      //custom select box
/*
      $(function(){
          $('select.styled').customSelect();
      });
	  */
	  
	//highlight current page in sidebar
	a=location.href; 
	a=a.substring(a.lastIndexOf('/')+1) ;
	var done=0;
	var cur = $('a[href^="'+a+'"]');
	console.log(cur);
	cur.each(function( index ) {
	if(done)
		return;
	innera=$( this );
	categorya=innera.parent().parent();
	if(categorya.is(".sub")){
		innera.parent().addClass("active");
		categorya.prev().addClass("active");
	}
	else
		
		innera.addClass("active");
		done=1;
}
);
  </script> 
</body>

</html>
