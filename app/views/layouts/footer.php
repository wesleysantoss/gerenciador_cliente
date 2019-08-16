
<script type="text/javascript" src="<?php echo PATH_URL ?>/assets/js/libs/bootstrap/jquery-3.2.1.slim.min.js?v=<?php echo filemtime(PATH . '/assets/js/libs/bootstrap/jquery-3.2.1.slim.min.js') ?>"></script>

<script type="text/javascript" src="<?php echo PATH_URL ?>/assets/js/libs/bootstrap/popper.min.js?v=<?php echo filemtime(PATH . '/assets/js/libs/bootstrap/popper.min.js') ?>"></script>

<script type="text/javascript" src="<?php echo PATH_URL ?>/assets/js/libs/bootstrap/bootstrap.min.js?v=<?php echo filemtime(PATH . '/assets/js/libs/bootstrap/bootstrap.min.js') ?>"></script>

<?php
	if(!empty($js)){
	    foreach($js as $row){
	        if(file_exists('app/assets/js/' . $row)){
                $path = PATH_URL . '/assets/js/' . $row;
                $version = filemtime(PATH . '/assets/js/' . $row);
                
	            echo '<script type="text/javascript" src="'.$path.'?v='.$version.'"></script>';
	        }
	    }
	}
?>
</body>
</html>