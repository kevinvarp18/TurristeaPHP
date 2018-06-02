</section>
<div id="footer">

</div>
<footer>

 <p> HTML5, CSS3, Javascript, PHP <br>
   &copy;2018 Turristea. All Rights Reserved</a>
 </p>

 </footer>
   <script type='text/javascript' src='public/js/jquery-2.2.3.min.js'></script>
 <script src="public/js/bootstrap.min.js"></script>
<script src="public/js/lightbox-plus-jquery.min.js"></script>
 <script type="text/javascript" src="public/js/numscroller-1.0.js"></script>
     <script type="text/javascript" src="public/js/move-top.js"></script>
     <script type="text/javascript" src="public/js/easing.js"></script>
     <script type="text/javascript">
       jQuery(document).ready(function($) {
         $(".scroll").click(function(event){
           event.preventDefault();
           $('html,body').animate({scrollTop:$(this.hash).offset().top},900);
         });
       });
     </script>
     <script type="text/javascript">
       $(document).ready(function() {
       $().UItoTop({ easingType: 'easeOutQuart' });
       });
     </script>
     <a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
</body>
</html>
