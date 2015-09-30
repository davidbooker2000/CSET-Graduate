
var interfaceimg=new Array()
function preloadimg(){
for (i=0;i<arguments.length;i++){
interfaceimg[i]=new Image()
interfaceimg[i].src=arguments[i]
}
}

//Enter full URL to image tabs to preload below. Separate with comma:

preloadimg("taba.gif", "tabb.gif", "tabc.gif", "tabd.gif", "tabe.gif", "tabf.gif")