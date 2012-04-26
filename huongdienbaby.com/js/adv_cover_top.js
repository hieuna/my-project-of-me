var ADV_OverTopArea = {
	
	bg_protect_color 				: '#666666',
	bg_protect_opacity 				: 50,
	component_attached				: false,
	//bg_protect_height				:2500,
	
//==================================================================================================
	
	writeComponent : function writeComponent() 
	{
		document.write('<div id="ADV_OverTop_Background"  style="height:2500;"></div>');
		browser=navigator.appName;
		//alert(browser)
		if(browser=='Netscape')
		document.write('<div id="ADV_OverTop"></div>');
		this.galleryShowBgProtect();
	},

//==================================================================================================

	galleryShowBgProtect : function galleryShowBgProtect() 
	{
		var bg_protect = document.getElementById('ADV_OverTop_Background');
		
		if (bg_protect) 
		{
			bg_protect.style.display = 'block';
			bg_protect.style.position = 'absolute';
			bg_protect.style.left = '0px';
			bg_protect.style.top = '0px';
			
			// do it only if styles are supported
			if ((typeof bg_protect.style.filter != 'undefined')
				|| (typeof bg_protect.style.MozOpacity != 'undefined')) {		
	        	
				bg_protect.style.backgroundColor = this.bg_protect_color;
				//bg_protect.style.height = this.bg_protect_height;
	        	bg_protect.style.filter = 'alpha(opacity=' + this.bg_protect_opacity + ')';  
	        	bg_protect.style.MozOpacity = 0.8;		
			}
		}
		
		var oNote = document.getElementById('ADV_OverTop');
		
		if (oNote) 
		{
			//this.CreateStyle();
			this.centerContainer('ADV_OverTop');
		}
		
		this.galleryResizeBgProtect();
	},
	
//==================================================================================================

	HideAllProtect : function HideAllProtect()
	{
		this.galleryHideBgProtect();
		//if (this.oTime != null)	clearTimeout(this.oTime);
		if (document.getElementById('ADV_OverTop'))
			document.getElementById('ADV_OverTop').style.display = 'none';
		//document.getElementById('ADV_OverTop_Background').style.display = 'none';
			
	},

//==================================================================================================

//==================================================================================================
	lastContainerPosition	: false,
	oTime 					: null,
	
	centerContainer : function centerContainer(id) {
		var elem = document.getElementById(id);
		if (!elem) {
			return false;
		}
		
		var pos = Layout.window.centerElement(elem, ADV_OverTopArea.lastContainerPosition);		
		
		if (pos) {
			ADV_OverTopArea.lastContainerPosition = pos;
		}
		ADV_OverTopArea.oTime = setTimeout('ADV_OverTopArea.centerContainer("' + id + '");', 100);
	},
	
//==================================================================================================

	galleryHideBgProtect : function galleryHideBgProtect()
	{	
		if (document.getElementById('ADV_OverTop_Background'))
		{	
		//	alert('a')
			document.getElementById('ADV_OverTop_Background').style.display = 'none';
		}
	},

//==================================================================================================
	
	galleryResizeBgProtect : function galleryResizeBgProtect()
	{
		var elem = document.getElementById('ADV_OverTop_Background');		
				
		if (elem && elem.style.display == 'block') {
			var document_size = Layout.document.getSize();
			elem.style.width = document_size.width + 'px';
			elem.style.height = document_size.height + 'px';					
		
			//setTimeout('ADV_OverTopArea.galleryResizeBgProtect()', 1000);		
		}
	}
};


var DetectEnvironment = {
	detected : false,

	DEV_MODE : false,
	DOMAIN_NAME : 'bkc.vn',
	
	browser : {
		name				: false,	/* Browser Name (firefox)*/
		version				: false,	/* Browser Version (1) */
		minorVersion		: false		/* Browser Minor Version (0rc1) */
	},

	os 	: {
		name				: false,	/* OS Name (win) */
		version				: false,	/* OS Version (winxp) */
		versionNumber		: false,	/* OS Version (winxp) */
		minorVersion		: false		/* OS Minor Version (sp2) */
	},

	detect : function detect() {
			
		if (document.domain.substring(document.domain.lastIndexOf('.') + 1) == 'dev') { 		
			this.DOMAIN_NAME = document.domain.substring(document.domain.indexOf('.') + 1);
			this.DEV_MODE = true;
		} 
		
		var userAgent = navigator.userAgent.toLowerCase();
		var appMinorVersion;

		if (navigator.appMinorVersion) {
			appMinorVersion = navigator.appMinorVersion.toLowerCase();
		} else {
			appMinorVersion = '';
		}

		/* list of supported user agents:  key is browser name and value is a list of keywords used to get browser version */
		var userAgent_list = {
			firefox		:	["firefox"],
			konqueror	:	["konqueror"],
			opera		:	["opera"],
			safari		:	["safari"],
			netscape	:	["netscape6","netscape","mozilla"],
			msie		:	["msie"],
			mozilla		:	["rv"]
		};

		/* list of supported OS with their major version names */
		var OS_list = {
			win:{
				vista	:	["windows nt 6.0"],
				win2k3	:	["windows nt 5.2"],
				winxp	:	["windows nt 5.1","windows xp"],
				win2k	:	["windows nt 5.0", "windows 2000"],
				winnt	:	["winnt","windows nt"],
				winme	:	["win 9x 4.90"],
				win98	:	["win98","windows 98"],
				win95	:	["win95","windows 95"],
				win31	:	["windows 3.1","win16","windows 16-bit","16bit"],
				win		:	["windows","win"]
			},
			os2:{
				os2		:	["os/2","ibm-webexplorer"]
			},

			mac:{
				osx		:	["mac os x"],
				mac9	:	["mac 9."],
				mac		:	["mac"]
			},
			unix:{
				linux	:	["inux"],
				unix	:	["sunos","irix","hp-ux","aix","sco","unix_system_v","ncr","reliantunix","dec","alpha","ultrix","sinix","bsd","x11"]
			}
		};

		/* windows minor versions list */
		var version_list = ["sp1","sp2","sp3","sp4","sp5","sp6"];


		/* detect browser */
		for (i in userAgent_list) {
			if (userAgent.indexOf(i) != -1) {
				this.browser.name = i;
				break;
			}
		}
		if (!this.browser.name) {
			this.browser.name = "other";
		}

		/* detect browser major / minor version */
	   	var pos = false;
		for (i in userAgent_list[this.browser.name]) {
			needle = userAgent_list[this.browser.name][i];
			pos = userAgent.indexOf(needle);

			if (pos != -1) {
				break;
			}
		}

		/* handle mozilla specific:  if rv cannot be found, try again assuming it's netscape instead */
		if (this.browser.name == "mozilla" && pos == -1) {
			this.browser.name = "netscape";
			for (i in userAgent_list[this.browser.name]) {
	    		needle = userAgent_list[this.browser.name][i];
	    		pos = userAgent.indexOf(needle);

	    		if (pos != -1) {
	    			break;
	    		}
			}
		}

		/* extract version from browser user agent string */
		new RegExp("([-.0-9a-z]+)").exec(String(userAgent.substr(pos + needle.length+1)));
		version = RegExp.$1;

		/* safari specific get browser version */
		if (this.browser.name == "safari") {
			this.browser.version = parseInt(version / 100);
			if (this.browser.version) {
				this.browser.minorVersion = version.substr(String(this.browser.version).length, 10);
			}
			else {
				this.browser.minorVersion = parseInt(version - (100 * this.browser.version));
			}
		}
		/* get all other browser major / minor version except 'other' */
		else if (this.browser.name != "other") {
			pos = version.indexOf('.');
	    	if (pos != -1) {
	    		this.browser.minorVersion = version.substr(pos + 1, 10);
	    	}
	    	else {
	    		this.browser.minorVersion = 0;
	    	}

	    	this.browser.version = parseInt(version);
		}

		/* make sure browser version is a valid number */
		if (isNaN(this.browser.version) || !this.browser.version) {
			this.browser.version = 0;
		}
		if (!this.browser.minorVersion) {
			this.browser.minorVersion = 0;
		}

		/* detect OS name / version */
		for (i in OS_list) {
			for (j in OS_list[i]) {
				for (k in OS_list[i][j]) {
					if (userAgent.indexOf(OS_list[i][j][k]) != -1) {
						this.os.name = i;
						this.os.version = j;
						break;
					}
				}

				if (this.os.name) {
					break;
				}
			}

			if (this.os.name) {
				break;
			}
		}

		/* detect OS minor version */
		if (this.os.name && this.os.version) {
			for (i in version_list) {
				if (appMinorVersion.indexOf(version_list[i]) != -1) {
					this.os.minorVersion = version_list[i];
					this.os.versionNumber = i + 1;
					break;
				}
			}
		}
		else {
			this.os.name = "other";
			this.os.version = "other";
		}

		if (!this.os.minorVersion) {
			this.os.minorVersion = "other";
			this.os.versionNumber = 0;
		}

		this.detected = true;
	},

	isTargetEnvironment : function isTargetEnvironment() {
		if (DetectEnvironment.isIE() || DetectEnvironment.isFirefox()) {
			return true;
		}
		return false;
	},
	
	isIE : function isIE() {
		if (DetectEnvironment.browser.name == "msie" && DetectEnvironment.os.name == "win") {
			return true;
		}
		return false;
	},
	
	isFirefox : function isFirefox() {
		if (DetectEnvironment.browser.name == "firefox" && DetectEnvironment.os.name == "win") {
			return true;
		}
		return false;
	},
	
	showDevInfoBar : function showDevInfoBar() 
	{
		if (document.createElement) 
		{
			if (document.body) 
			{
				var oDiv = document.createElement('DIV');
				oDiv.id = '_dev_info_bar';
				oDiv.style.position = 'absolute';
				oDiv.style.backgroundColor = '#FFFF99';
				oDiv.style.width = '100%';
				oDiv.style.height = '2500px';
				oDiv.style.top = '0px';
				oDiv.style.left = '0px';
				oDiv.innerHTML = '<center><b><font color="red">DEV MODE ACTIVATED - ' + this.DOMAIN_NAME + '</font></b></center>';				
				document.body.appendChild(oDiv);
			} else {
				setTimeout('DetectEnvironment.showDevInfoBar()', 500);
			}
		}
	}
};

var Layout = {
	window : {		
	//==================================================================================================	
		
		/* get current browser window size */
		getSize : function getSize() {
		    var width = 0;
		    var height = 0;
		
		    /* Non-IE */
		    if (typeof(window.innerWidth) == 'number') {
		        width = window.innerWidth;
		        height = window.innerHeight;
		    }
		    /* IE 6+ in 'standards compliant mode' */
		    else if (document.documentElement && (document.documentElement.clientWidth || document.documentElement.clientHeight)) {
		        width = document.documentElement.clientWidth;
		        height = document.documentElement.clientHeight;
				//height = 2500;
		    }
		    /* IE 4 compatible */
		    else if (document.body && (document.body.clientWidth || document.body.clientHeight)) {
		        width = document.body.clientWidth;
		        height = document.body.clientHeight;
				//height = 2500;
		    }
		
		    return { width : width, height : height };
		},
		
	//==================================================================================================
		
		/* get current browser scroll position */
		getScroll : function getScroll() {
		    var scroll_x = 0;
		    var scroll_y = 0;
		
		    /* Netscape */
		    if (typeof(window.pageYOffset) == 'number') {
		        scroll_y = window.pageYOffset;
		        scroll_x = window.pageXOffset;
		    }
		    /* DOM */
		    else if (document.body && (document.body.scrollLeft || document.body.scrollTop)) {
		        scroll_y = document.body.scrollTop;
		        scroll_x = document.body.scrollLeft;
		    }
		    /* IE6 */
		    else if (document.documentElement && (document.documentElement.scrollLeft || document.documentElement.scrollTop)) {
		        scroll_y = document.documentElement.scrollTop;
		        scroll_x = document.documentElement.scrollLeft;
		    }
		
		    return { x : scroll_x, y : scroll_y };
		},
		
		
	//==================================================================================================

		centerElement : function centerElement (elem, last_pos) {
			var window_size = Layout.window.getSize();
			var scrolling = Layout.window.getScroll();
			var document_size = Layout.document.getSize();			
			var element = { width : elem.offsetWidth, height : elem.offsetHeight };
			
			var posx = Math.round(((window_size.width - element.width) / 2) + scrolling.x);
			var posy = Math.round(((window_size.height - element.height) / 2) + scrolling.y);
			
			if (last_pos.x < posx && window_size.width < element.width) {
		    	 if ((posx - last_pos.x) < (element.width - window_size.width) / 2) {
		    	 	posx = last_pos.x;
		    	 }
		    	 else {
		    	 	posx = scrolling.x - ((element.width - window_size.width));
		    	 	
		    	 	if (DetectEnvironment.isFirefox() && Layout.document.hScrollbar) {	
		    	 		posx -= 20;
		    	 	}
		    	 }
		    }
		    else if (last_pos.x > posx && window_size.width < element.width) {
		    	 if ((last_pos.x - posx) < (element.width - window_size.width) / 2) {
		    	 	posx = last_pos.x;
		    	 }
		    	 else {
		    	 	posx = scrolling.x;
		    	 }
		    }						
			
		   if (last_pos.y < posy && window_size.height < element.height) {
		    	 if ((posy - last_pos.y) < (element.height - window_size.height) / 2) {
		    	 	posy = last_pos.y;
		    	 }
		    	 else {
		    	 	posy = scrolling.y - ((element.height - window_size.height));
		    	 	
		    	 	if (DetectEnvironment.isFirefox() && Layout.document.vScrollbar) {
		    	 		posy -= 20;
		    	 	}		    	 	
		    	 	
		    	 }
		    }
		    else if (last_pos.y > posy && window_size.height < element.height) {
		    	 if ((last_pos.y - posy) < (element.height - window_size.height) / 2) {
		    	 	posy = last_pos.y;
		    	 }
		    	 else {
		    	 	posy = scrolling.y;
		    	 }
		    }
		    
		    if (posy < 0) {
		        posy = 0;
		    }
		    if (posx < 0) {
		        posx = 0;
		    }
		    	    
			elem.style.left = posx + 'px';
			elem.style.top = posy + 'px';	
		
			
		    return {x: posx, y: posy};	
		}		
	},
	
//==================================================================================================
	
	document : {
		vScrollbar : false,
		hScrollbar : false,
		
		//==================================================================================================		
		getSize : function getSize () {
					
			// use document.documentElement if browser is in standard render mode
			if (document.compatMode && document.compatMode == 'CSS1Compat') {
				var body = document.documentElement;
			}
			// use document.body if browser is in quirks render mode
			else {
				var body = document.body;
			} 
	
		    // browser window dimensions
			var window_size = Layout.window.getSize();		
			
			// background dimensions
			var width = 0;
			var height = 0;
			
			// scrollbar visibility
			var v_scrollbar = false;
			var h_scrollbar = false;
			
			// get document offsetWidth
			width = body.offsetWidth;
				
			// get document offsetHeight
			//height = body.offsetHeight;
			height = 2500;		
			// overwrite dimensions with scrollWidth/scrollHeight if it's bigger
			if (width <= body.scrollWidth) {
				width = body.scrollWidth;
				h_scrollbar = true;
			}
				
			if (height <= body.scrollHeight) {
				height = body.scrollHeight;
				v_scrollbar = true;
			}
			
			// overwrite dimensions with browser window size if it's bigger
			if (width <= window_size.width) {
				width = window_size.width;			
				h_scrollbar = false;
			}
			
			if (height <= window_size.height) {
				height = window_size.height;			
				v_scrollbar = false;
			}
				
			if (DetectEnvironment.isIE()) {
				// substract 20 px for IE right scrollbars if necessary
				if (!h_scrollbar) {
					width -= 20;
				}
				else if (!v_scrollbar) {
					height -= 16;
				}
				
				// substract 4 px for IE bottom 'border' if necessary
				if (!v_scrollbar) {
					height -= 4;
				}
			}
			else {
				// substract 16 px for mozilla scrollbars if necessary
				if (v_scrollbar && !h_scrollbar) {
					width -= 16;
				}
				
				if (h_scrollbar && !v_scrollbar) {
					height -= 16;
				}
			}				
			
			Layout.document.vScrollbar = v_scrollbar;
			Layout.document.hScrollbar = h_scrollbar;
					
			return {width: width, height: height};			
		},		
		
	//==================================================================================================
	
		/* hide SELECT, IFRAME, INPUT and OBJECT elements */
		ie_overlapping_elements : new Array(),
		
		hideIEOverlappingElements : function hideIEOverlappingElements() {
		    var _i = 0;
		    var _j = 0;
		
		    var _elem = document.getElementsByTagName('SELECT');
		    for (_i = 0; _i < _elem.length; _i++) {
		        this.ie_overlapping_elements[_j++] = _elem[_i];
		        _elem[_i].style.visibility = 'hidden';
		    }
		
		    var _elem = document.getElementsByTagName('IFRAME');
		    for (_i = 0; _i < _elem.length; _i++) {
		        this.ie_overlapping_elements[_j++] = _elem[_i];
		        _elem[_i].style.visibility = 'hidden';
		    }
		
		    var _elem = document.getElementsByTagName('INPUT');
		    for (_i = 0; _i < _elem.length; _i++) {
		        this.ie_overlapping_elements[_j++] = _elem[_i];
		        _elem[_i].style.visibility = 'hidden';
		    }
		
		    var _elem = document.getElementsByTagName('OBJECT');
		    for (_i = 0; _i < _elem.length; _i++) {
		        this.ie_overlapping_elements[_j++] = _elem[_i];
		        _elem[_i].style.visibility = 'hidden';
		    }
		    
		    var _elem = document.getElementsByTagName('EMBED');
		    for (_i = 0; _i < _elem.length; _i++) {
		        this.ie_overlapping_elements[_j++] = _elem[_i];
		        _elem[_i].style.visibility = 'hidden';
		    }		    
		},
	
	//==================================================================================================
		
		showIEOverlappingElements : function showIEOverlappingElements() {
			for (var _i = 0; _i < this.ie_overlapping_elements.length; _i++) {
				this.ie_overlapping_elements[_i].style.visibility = '';
			}		
		}		

	},

	element : {
		getPos : function getPos(obj) {
			return {
				X: Layout.element.getPosX(obj),
				Y: Layout.element.getPosY(obj)
			};
		},
		
		getPosX : function getPosX(obj) {
		
		    var curleft = 0;
		
		    if (obj.offsetParent) {
		        while (obj.offsetParent) {
		            curleft += obj.offsetLeft
		            obj = obj.offsetParent;
		        }
		    } else if (obj.x) {
		        curleft += obj.x;
		    }
		
		    return curleft;
		},

		getPosY : function getPosY(obj) {
		
		    var curtop = 0;
		    if (obj.offsetParent) {
		        while (obj.offsetParent) {
		            curtop += obj.offsetTop
		            obj = obj.offsetParent;
		        }
		    } else if (obj.y) {
		        curtop += obj.y;
		    }
		    
		    return curtop;
		}		
	}
};