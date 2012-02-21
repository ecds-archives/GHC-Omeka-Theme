<?php head(array('bodyid'=>'home', 'headerClass'=>'home'), $file='header_home'); ?>

  <div class="feature">
   <a href="<?php echo uri('collections/show/1');?>">
     <img width="255" height="77" src="<?php echo img('BillFoege.jpg', $dir='images/features'); ?>" />
     <b>Smallpox</b>:  Global eradication of smallpox, by any measure, ranks among the great achievements of humankind.
   </a>
 </div>

  <div class="feature">
   <a href="<?php echo uri('collections/show/2');?>">
     <img width="255" height="77" src="<?php echo img('DonaldHopkins.png', $dir='images/features'); ?>"/>
     <b>Guinea worm</b>: A painful and debilitating infestation contracted by drinking stagnant water
     contaminated with Guinea worm larvae.
   </a>
  </div>

 <div class="feature">
   <a href="<?php echo uri('collections/show/3');?>">
     <img width="255" height="77" src="<?php echo img('PHIL_2622.jpg', $dir='images/features'); ?>"/>
     <b>Malaria</b>: The origin of CDC's disease prevention and eradication programs.
   </a>
 </div>

<?php foot(); ?>