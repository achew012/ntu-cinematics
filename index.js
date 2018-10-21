const bannerLinks=['./img/crazyrichasian-banner.jpg','./img/downadarkhall-banner.jpg','./img/firstpurge-banner.jpg']
const movies=["Crazy Rich Asian (PG)","Down A Dark Hall (PG)","The First Purge (M18)"];

var count=0;
function banner() {  	 
	var bannerElement= document.getElementById('banner');
	var movie= document.getElementById('movie');
	count++;
	if(count<bannerLinks.length){
		bannerElement.setAttribute("src", bannerLinks[count]);	
		movie.innerHTML=movies[count];
		console.log(movie.innerHTML);
	}else{
		count=0;
		bannerElement.setAttribute("src", bannerLinks[count]);
		movie.innerHTML=movies[0];
	}
	

}
setInterval(banner,3000);



