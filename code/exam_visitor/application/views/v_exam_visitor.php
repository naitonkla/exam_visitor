<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.3.0.js"></script>
<!--<script src="https://naitonkla.xyz/exam_visitor/assets/js/count_visitor.js"></script>-->
<span>
	<p id="daily">จำนวนผู้เข้าชมประจำวัน : </p>
	<p id="monthly">จำนวนผู้เข้าชมประจำเดือน :</p>
</span>
<script>
(function (window) {
	{
		var unknown = '-';

		// browser
		var nVer = navigator.appVersion;
		var nAgt = navigator.userAgent;
		var browser = navigator.appName;
		
		 // Yandex Browser
		if ((verOffset = nAgt.indexOf('YaBrowser')) != -1) {
			browser = 'Yandex';
		}
		// Samsung Browser
		else if ((verOffset = nAgt.indexOf('SamsungBrowser')) != -1) {
			browser = 'Samsung';
		}
		// UC Browser
		else if ((verOffset = nAgt.indexOf('UCBrowser')) != -1) {
			browser = 'UC Browser';
		}
		// Opera Next
		else if ((verOffset = nAgt.indexOf('OPR')) != -1) {
			browser = 'Opera';
		}
		// Opera
		else if ((verOffset = nAgt.indexOf('Opera')) != -1) {
			browser = 'Opera';
		}
		// Legacy Edge
		else if ((verOffset = nAgt.indexOf('Edge')) != -1) {
			browser = 'Microsoft Legacy Edge';
		} 
		// Edge (Chromium)
		else if ((verOffset = nAgt.indexOf('Edg')) != -1) {
			browser = 'Microsoft Edge';
		}
		// MSIE
		else if ((verOffset = nAgt.indexOf('MSIE')) != -1) {
			browser = 'Microsoft Internet Explorer';
		}
		// Chrome
		else if ((verOffset = nAgt.indexOf('Chrome')) != -1) {
			browser = 'Chrome';
		}
		// Safari
		else if ((verOffset = nAgt.indexOf('Safari')) != -1) {
			browser = 'Safari';
		}
		// Firefox
		else if ((verOffset = nAgt.indexOf('Firefox')) != -1) {
			browser = 'Firefox';
		}
		// MSIE 11+
		else if (nAgt.indexOf('Trident/') != -1) {
			browser = 'Microsoft Internet Explorer';
		}
		// Other browsers
		else if ((nameOffset = nAgt.lastIndexOf(' ') + 1) < (verOffset = nAgt.lastIndexOf('/'))) {
			browser = nAgt.substring(nameOffset, verOffset);
			if (browser.toLowerCase() == browser.toUpperCase()) {
				browser = navigator.appName;
			}
		}

		// mobile version
		var mobile = /Mobile|mini|Fennec|Android|iP(ad|od|hone)/.test(nVer);

		// system
		var os = unknown;
		var clientStrings = [
			{s:'Windows 10', r:/(Windows 10.0|Windows NT 10.0)/},
			{s:'Windows 8.1', r:/(Windows 8.1|Windows NT 6.3)/},
			{s:'Windows 8', r:/(Windows 8|Windows NT 6.2)/},
			{s:'Windows 7', r:/(Windows 7|Windows NT 6.1)/},
			{s:'Windows Vista', r:/Windows NT 6.0/},
			{s:'Windows Server 2003', r:/Windows NT 5.2/},
			{s:'Windows XP', r:/(Windows NT 5.1|Windows XP)/},
			{s:'Windows 2000', r:/(Windows NT 5.0|Windows 2000)/},
			{s:'Windows ME', r:/(Win 9x 4.90|Windows ME)/},
			{s:'Windows 98', r:/(Windows 98|Win98)/},
			{s:'Windows 95', r:/(Windows 95|Win95|Windows_95)/},
			{s:'Windows NT 4.0', r:/(Windows NT 4.0|WinNT4.0|WinNT|Windows NT)/},
			{s:'Windows CE', r:/Windows CE/},
			{s:'Windows 3.11', r:/Win16/},
			{s:'Android', r:/Android/},
			{s:'Open BSD', r:/OpenBSD/},
			{s:'Sun OS', r:/SunOS/},
			{s:'Chrome OS', r:/CrOS/},
			{s:'Linux', r:/(Linux|X11(?!.*CrOS))/},
			{s:'iOS', r:/(iPhone|iPad|iPod)/},
			{s:'Mac OS X', r:/Mac OS X/},
			{s:'Mac OS', r:/(Mac OS|MacPPC|MacIntel|Mac_PowerPC|Macintosh)/},
			{s:'QNX', r:/QNX/},
			{s:'UNIX', r:/UNIX/},
			{s:'BeOS', r:/BeOS/},
			{s:'OS/2', r:/OS\/2/},
			{s:'Search Bot', r:/(nuhk|Googlebot|Yammybot|Openbot|Slurp|MSNBot|Ask Jeeves\/Teoma|ia_archiver)/}
		];
		for (var id in clientStrings) {
			var cs = clientStrings[id];
			if (cs.r.test(nAgt)) {
				os = cs.s;
				break;
			}
		}
		
		if (/Windows/.test(os)) {
			osVersion = /Windows (.*)/.exec(os)[1];
			os = 'Windows';
		}
	}

	window.vist = {
		browser: browser,
		mobile: mobile,
		os: os
	};
	
	$.getJSON("https://api.ipify.org?format=json", function(data) {
		 
		// Setting text of element P with id gfg
		// $("#gfg").html(data.ip);
		get_ip = data.ip;
		$.post("https://naitonkla.xyz/exam_visitor/index.php/Exam1/save_visitor",
		{
			url: window.location.href,
			host: window.location.hostname,
			path: window.location.pathname,
			ip_address:get_ip,
			browser_name: vist.browser,
			platform: vist.os,
			is_mobile: vist.mobile,
		},
		function(data){
			console.log(JSON.parse(data));
		});
		
		$.ajax({
			url: "https://naitonkla.xyz/exam_visitor/index.php/Exam1/get_count_visitor",
			type: "POST",
			async: false,
			success: function (data) {
			   visit_count = JSON.parse(data);
				$("#daily").html("จำนวนผู้เข้าชมประจำวัน : "+visit_count.daily);
				$("#monthly").html("จำนวนผู้เข้าชมประจำเดือน : "+visit_count.monthly);
			}
		});
	})
}(this));
</script>