<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
	<title>jquery vs javascript test</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style type="text/css">
	/* http://meyerweb.com/eric/tools/css/reset/ v2.0 | 20110126 License: none (public domain) */ html, body, div, span, applet, object, iframe, h1, h2, h3, h4, h5, h6, p, blockquote, pre, a, abbr, acronym, address, big, cite, code, del, dfn, em, img, ins, kbd, q, s, samp, small, strike, strong, sub, sup, tt, var, b, u, i, center, dl, dt, dd, ol, ul, li, fieldset, form, label, legend, table, caption, tbody, tfoot, thead, tr, th, td, article, aside, canvas, details, embed, figure, figcaption, footer, header, hgroup, menu, nav, output, ruby, section, summary, time, mark, audio, video {margin: 0; padding: 0; border: 0; font-size: 100%; font: inherit; vertical-align: baseline; } /* HTML5 display-role reset for older browsers */ article, aside, details, figcaption, figure, footer, header, hgroup, menu, nav, section {display: block; } body {line-height: 1; } ol, ul {list-style: none; } blockquote, q {quotes: none; } blockquote:before, blockquote:after, q:before, q:after {content: ''; content: none; } table {border-collapse: collapse; border-spacing: 0; }
		body {
			color:#fff;
			text-align: center;
			font-family: "Courier New",Courier,"Lucida Sans Typewriter","Lucida Typewriter",monospace
		}
		.container {
			width:600px;
			background-color: gray;
			margin:0 auto;
		}
		button {
			background-color: #43A047;
		    border: 0;
		    color: #fff;
		    cursor: pointer;
		    width: 100%;
		    font-size: 40px;
		    text-transform: uppercase;
		    line-height: 60px;
		}

		.results {
			background-color: #2196F3;
			width:100%;
			height:80px;
			padding-top: 20px;
		}

		p{font-weight: bold;margin:20px 0px;}

		button:disabled {
			background-color: #F44336;
		}

		@media (max-width: 960px) {
			.container {width:100%;}
		}

	</style>
	<meta property="og:image" content="https://ween.io/weenog.png" />
	<meta property="og:image:type" content="image/png" />
    <meta property="og:image:width" content="1200" />
    <meta property="og:image:height" content="630" />
</head>
<body>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-60460010-1', 'auto');
  ga('send', 'pageview');

</script>
<div class="container">
	<button id="start">Start Test</button>

	<p>Status: <span id="status">not running.</span></p>
	<div class="results">
		<div id="result"></div>
		<div id="jquery"></div><div id="js"></div>
	</div>
	<p>refresh page to run it again.</p>
	<p>Test DOM stuff</p>
	<div class="hideWhenDone">
		<div id="test">hello</div>
		<div class="test">test1 of test class</div>
		<div class="test">test2 of test class</div>
	</div>
</div>



<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.4/lodash.min.js"></script>
<script src="platform.js"></script>
<script src="benchmark.js"></script>
<script type="text/javascript" src="lol.js"></script>
<script>
$("#start").click(function() {
	updateStatus();
	setTimeout(function() {
		var suite = new Benchmark.Suite('tests', {
			'onStart': updateStatus()	
		});
		suite.add('jQuery[DOM].test', function() {
			$(".test").hide().show().hide();
		})
		.add('JS[DOM].test', function() {
			lol.e(".test").hide().show().hide();
		})
		.on('start', function() {
			$("#start").html("running...");
			$("#start").attr("disabled", "disabled");
		})
		// add listeners
		.on('cycle', function(event) {
			// Benchmark.prototype.hz

			//console.log(event);
		})
		.on('complete', function(event) {
			console.log('Fastest is ' + this.filter('fastest').map('name'));
			//$(".hideWhenDone").hide();
			$("#start").html("finished!");
			$("#status").html("finished!");
			
			$("#result").html('Fastest is ' + this.filter('fastest').map('name'));
		})
		// run async
		.run({ 'async': false });

		var r = lol.post(suite[0].hz, suite[1].hz);

		$("#jquery").html("jquery " + suite[0].hz + " ops/sec");
		$("#js").html("javascript " + suite[1].hz + " ops/sec");
	}, 50);
});

function updateStatus() {
	document.getElementById("status").innerHTML = "running...";
}
</script>
</body>
</html>