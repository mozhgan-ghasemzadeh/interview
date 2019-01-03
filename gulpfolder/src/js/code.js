function myFunction(item){
		var parent =item.parentNode;
		var div = parent.querySelector("#content");
		var dots = div.querySelector("#dots");
		var para = div.querySelector("#more");
		var p = dots.parentNode;
		if(p.tagName == "P"){
			p.style.display ="inline";
		}
		
		
		if(dots.classList == "dotsShow"){
			para.classList.remove("moreHide");
			para.classList.add("moreShow");
			dots.classList.remove("dotsShow");
			dots.classList.add("dotsHide");
			item.innerHTML = "Read less";
			
		}
		else{
			para.classList.remove("moreShow");
			para.classList.add("moreHide");
			dots.classList.remove("dotsHide");
			dots.classList.add("dotsShow");
			item.innerHTML = "Read more";
		}
	}
