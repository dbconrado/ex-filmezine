<script type="text/javascript"
	src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js">
</script>

<script type="text/javascript">
	
	$(document).ready(function()
	{
		var posicaoAtual = $(window).scrollTop();
		var documentSize = $(document).height();
		var sizeWindow = $(window).height();
		
		$(window).scroll(function ()
		{
			posicaoAtual = $(window).scrollTop();
	 			if (posicaoAtual >= (documentSize - sizeWindow ))
	 			{
					alert ("Final do documento ->" + posicaoAtual);
				}
		});
		
		$(window).resize(function() 
		{
			posicaoAtual = $(window).scrollTop();
			documentSize = $(document).height();
			sizeWindow = $(window).height();
		});
	});
</script>