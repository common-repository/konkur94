<?php
/*
Plugin Name: konkur 94
Description:just a simple widget for showing konkurs distance from today
author:Reza nasrollahi in 7learn.com
Plugin URI: http://7learn.com/

*/
/* Start Adding Functions Bekonkurw this Line */


/* Stop Adding Functions Bekonkurw this Line */
?>
<script type="text/javascript">
dateFuture1 = new Date(2015,5,11,8,0,0);



function GetCount(ddate,iid){

	dateNow = new Date();	
	amount = ddate.getTime() - dateNow.getTime();	
	delete dateNow;

	if(amount < 0){
		document.getElementById(iid).innerHTML="Now!";
	}
	else{
		days=0;out="";

		amount = Math.floor(amount/1000);

		days=Math.floor(amount/86400);
		amount=amount%86400;

		if(days != 0){out += days +" "+((days==1)?"روز":"روز باقیمانده تا کنکور سراسری ")+", ";}
		out = out.substr(0,out.length-2);
		document.getElementById(iid).innerHTML=out;

		setTimeout(function(){GetCount(ddate,iid)}, 1000);
	}
}

window.onload=function(){
	GetCount(dateFuture1, 'countbox1');
};
</script>
<?php // Creating the widget 
class konkur_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'konkur_widget', 

// Widget name will appear in UI
__('روز شمار کنکور', 'konkur_widget_domain'), 

// Widget description
array( 'description' => __( 'شمارنده ی معکوس کنکور سراسری رشته ی ریاضی', 'konkur_widget_domain' ), ) 
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];

// This is where you run the code and display the output
print __( '<style>

.sticky {
  background: linear-gradient(#FEFCAF, #FFFEDA);
  padding: 5px 20px 10px 20px;
  width: 250px;
  margin: 30px auto;
  box-shadow: 1px 1px 3px rgba(0, 0, 0, 0.25);
	border-radius: 2% / 50%;
  position: relative;
  
  
}

.sticky h1 {
   color: #eb2626;
}

.sticky:before,
.sticky:after {
   z-index: -1;
  position: absolute;
  left: 20px;
  bottom: 10px;
  width: 70%;
  max-width: 300px;
  max-height: 100px;
  height: 55%;
  box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
  transform: skew(-15deg) rotate(-6deg); 
}

.sticky:after {
  left: auto;
  right: 20px;
  transform: skew(15deg) rotate(6deg); 
}
</style>

<center><div class="sticky">
  <h1  style="direction:rtl">روز شمار کنکور 94</h1><div id="countbox1" style="direction:rtl"></div>
  ','konkur_widget_domain' );
echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'روز شمار کنکور 94', 'konkur_widget_domain' );
}
// Widget admin form
?>

<p>
  <label for="<?php echo $this->get_field_id( 'title' ); ?>">
    <?php _e( 'Title:' ); ?>
  </label>
  <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<?php 
}
	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}
} // Class konkur_widget ends here

// Register and konkurad the widget
function konkur_konkurad_widget() {
	register_widget( 'konkur_widget' );
}
add_action( 'widgets_init', 'konkur_konkurad_widget' );?>
