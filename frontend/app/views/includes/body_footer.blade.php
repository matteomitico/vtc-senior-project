<script type="text/javascript" src="{{asset('js/classie.js')}}"></script>
<script type="text/javascript">
	var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
		showLeft = document.getElementById( 'showLeft' ),	
		body = document.body;
	showLeft.onclick = function() {
		classie.toggle( this, 'active' );
		classie.toggle( menuLeft, 'cbp-spmenu-open' );
		disableOther( 'showLeft' );
	};
	function disableOther( button ) {
		if( button !== 'showLeft' ) {
			classie.toggle( showLeft, 'disabled' );
		}
	}
	//twitterFetcher.fetch('379999980263444480', 'slider-tweet', 3, true, false);
	

	var delay=2000, setTimeoutConst, timed=false;
	$('#cbp-spmenu-s1')
	    .on('mouseover', function() {
	    	if(timed || $('#showLeft').hasClass('active') ) return;
	    	timed = true;
	        setTimeoutConst = setTimeout(function(){
	               $('#showLeft').addClass( 'active' );
					$('#cbp-spmenu-s1').addClass( 'cbp-spmenu-open' );
					disableOther( 'showLeft' ); 
	         		clearTimeout(setTimeoutConst );
	         		timed = false;

	         }, delay);
	    });
	$(body).on('click',function() {
		//if( !($('#showLeft').hasClass('active')) ) return;
		$('#showLeft').removeClass('active');
		$('#cbp-spmenu-s1').removeClass( 'cbp-spmenu-open' );
		disableOther( 'showLeft' ); 
		clearTimeout(setTimeoutConst );
	    timed = false;
	});

</script>
<style>
	#slider-tweet .tweet {
		overflow: hidden;
		clear: both;
		word-wrap: break-word;
		white-space: pre-wrap;
	}
	
	#slider-tweet .tweet a {
		font-size: 14px;
		color: #fff;
		white-space: nowrap;
		max-width: 100%;
		overflow: hidden;
		text-overflow: ellipsis;
	}
	#slider-tweet .tweet a:hover {
		text-decoration: underline;
	}
	
	.timePosted {
		font-size: 10px;
		color: #d8d8d8;
	}
	
	.tco-hidden,
	#slider-tweet .interact {
		display: none;
	}
</style>