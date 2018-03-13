/*******************************************************************************
Copyright (c) 1999 Thomas Brattli (www.bratta.com)

eXperience DHTML coolFrameMenus - Get it at www.bratta.com
Version Beta 1.0
This script can be used freely as long as all copyright messages are
intact. 

Visit www.bratta.com/dhtml/scripts.asp for the latest version of the script.

(You can delete the comments below to save space)

Known bugs:

Opera 4: This menu is very close to working on Opera, but as far as I could 
figure out opera don't support innerHTML or document.createElement() which
makes the changing of the text inside the submenus hard to do. If anyone 
know a solution to this please let me know.

Netscape 6: This will not work on any Mozilla version below M17 (no innerHTML support)
Netscape PR1 is M14 I think. It should work on Mozilla, but I seems to be having 
some problems with reaching elements over frames. I think that this is a bug 
in Mozilla and hopefully they will fix the framesupport sometime soon.

Explorer 4 for mac:
It will not work in this browser, nothing does. It works just fine in Explorer 5
for mac though.

Script checked with:
PC
Netscape 4.08
Netscape 4.03
Netscape 4.04
Internet Explorer 4.01
Internet Explorer 5.0
Internet Explorer 5.5
Mozilla M17 <-- Not working yet
Opera 4 <-- Not working yet
MAC
Netscape 4
Explorer 5

LAST NOTE:
I would reccomend to not use to many items on each menu. You will get 
flickering on older machines if you do... Try keeping it at a max of 10

THE REALLY LAST NOTE:
If you have this linked js file inside another directory then your menu.html
file be aware of that Explorer treats realtive links relative to menu.html while
Netscape treats it relative to this file. So I suggest that you keep this
file and your menu.html in the same directory.

If there are features you think should be added to this menu please
post it in the coolMenu and coolframeMenu forum at my site:
http://www.bratta.com/dhtml/scripts.asp?url=forum
*******************************************************************************/

/*****************************************************************************
Pageobject
******************************************************************************/
function makePageCoords(){
	this.x=0;this.x2=(bw.ns4 || bw.ns5)?innerWidth:document.body.offsetWidth-3;
	this.y=0;this.y2=(bw.ns4 || bw.ns5)?innerHeight+3:document.body.offsetHeight;
	this.x50=this.x2/2;	this.y50=this.y2/2;
	this.x10=(this.x2*10)/100-5;this.y10=(this.y2*10)/100-5
	this.x15=(this.x2*15)/100-5;this.y15=(this.y2*15)/100-5; 
	return this;
}

/*****************************************************************************
Debugging function
******************************************************************************/
function debug(txt,ev){
	if(mDebugging==2) self.status=txt
	else alert(txt)
	if(ev) eval(ev)
	return false
}
/********************************************************************************
Checking if the values are % or not.
********************************************************************************/
function cf_checkp(num,w,check){
	if(num){
		if(num.toString().indexOf("%")!=-1){
			if(w || check && (this.frametype==2 || this.frametype==3)) num=(page.x2*parseFloat(num)/100)
			else num=(page.y2*parseFloat(num)/100)
		}else num=parseFloat(num)
	}else num=0
	return num
}
/*****************************************************************************
General function to check if the frame exists.
******************************************************************************/
function cf_checkFrame(){
	if(top[this.menuFrameName]) return true
	else return false
}
/*****************************************************************************
Checking if the main frame has been scrolled or not!
******************************************************************************/
function cf_checkScrolled(){
	if(!top[this.menuFrameName]) return
	if(bw.ns4 || bw.ns5){
		this.scrolledX=top[this.menuFrameName].pageXOffset
		this.scrolledY=top[this.menuFrameName].pageYOffset
	}else{
		this.scrolledX=top[this.menuFrameName].document.body.scrollLeft
		this.scrolledY=top[this.menuFrameName].document.body.scrollTop
	}
}
/*****************************************************************************
General objects function, for frameobjects and regular objects!
******************************************************************************/
function makeFObj(frame,obj,parent,topnum,subnum,sub2num,sub3num,border){
	if(frame){
		if(!top[frame] && mDebugging) return debug('Frame: '+frame+' doesn\'t exist'+top[frame]) 
  		this.evnt=bw.dom?top[frame].document.getElementById(obj):bw.ie4?top[frame].document.all[obj]:bw.ns4?eval('top.'+frame+'.document.'+obj):0;
	}else{
  		this.evnt=bw.dom?document.getElementById(obj):bw.ie4?document.all[obj]:bw.ns4?eval('document.'+obj):0;
	}
	if(mDebugging){
		if(!this.evnt) return debug('There seems to be an error with this layer:\nFrame: '+frame+'\nLayer: '+obj)
	}
	this.css=bw.dom||bw.ie4?this.evnt.style:bw.ns4?this.evnt:0;			
	this.ref=bw.dom || bw.ie4?document:bw.ns4?this.css.document:0;
	this.writeIt=cf_writeIt;
	this.height=bw.ns4?this.ref.height:this.evnt.offsetHeight;
	this.width=bw.ns4?this.ref.width:this.evnt.offsetWidth;
	this.x=(bw.ns4 || bw.ns5)? parseInt(this.css.left):this.evnt.offsetLeft;
	this.y=(bw.ns4 || bw.ns5)? parseInt(this.css.top):this.evnt.offsetTop;					
	this.hideIt=cf_hideIt;	this.showIt=cf_showIt; this.clipTo=cf_clipTo;		
	this.moveIt=cf_moveIt; this.bgChange=cf_bgChange;		
	this.parent=parent		
	if(frame && !border){
		this.evnt.onmouseover=new Function(parent.name+".mmover("+subnum+","+sub2num+","+sub3num+")");
		this.evnt.onmouseout=new Function(parent.name+".mmout("+subnum+","+sub2num+","+sub3num+")");
	}else if(!border){
		this.evnt.onmouseover=new Function(parent.name+".mover("+topnum+")");
		this.evnt.onmouseout=new Function(parent.name+".mmout2()");
	}
	this.obj = obj + "Object"; 	eval(this.obj + "=this")
	this.fcChange=cf_fcChange;
	return this
}
function cf_showIt(){this.css.visibility="visible"}
function cf_hideIt(){this.css.visibility="hidden"}
function cf_bgChange(color){if(color){if(bw.dom || bw.ie4) this.css.backgroundColor=color
else if(bw.ns4) this.css.bgColor=color}}
function cf_clipTo(t,r,b,l,w){if(bw.ns4){this.css.clip.top=t;this.css.clip.right=r
this.css.clip.bottom=b;this.css.clip.left=l
}else{this.css.clip="rect("+t+","+r+","+b+","+l+")"; if(w){this.css.width=r; this.css.height=b}}}
function cf_moveIt(x,y){this.x=x; this.y=y; this.css.left=this.x;this.css.top=this.y}
function cf_place(){this.moveIt(this.pagex,this.pagey); this.showIt()}
function cf_writeIt(text){if(bw.ns4){this.ref.write(text);this.ref.close()}
else this.evnt.innerHTML=text}
function cf_fcChange(color){
	if(bw.ie4){
		this.evnt.children[0].style.color=color
	}else{
		this.evnt.childNodes[0].style.color=color
	}
}
/*****************************************************************************
Event functions
******************************************************************************/
//Mouseover on sub and sub2 menus
function cf_mmover(subnum,sub2num,sub3num){
	clearTimeout(this.tim)
	this.over=1
	if(sub3num>-1){
		this.activeSub3=sub3num
		this.sub3[sub3num].bgChange(this.sub3bgcoloron)
		if(!bw.ns4) this.sub3[sub3num].fcChange(this.sub3hovercolor)
	}else if(sub2num>-1){
		if(this.activeSub2>-1) this.sub2[this.activeSub2].bgChange(this.sub2bgcoloroff)
		this.activeSub2=sub2num
		this.sub2[sub2num].bgChange(this.sub2bgcoloron)
		if(!bw.ns4) this.sub2[sub2num].fcChange(this.sub2hovercolor)
		this.showSub3(sub2num)
	}else if(subnum>-1){
		if(this.activeSub>-1) this.sub[this.activeSub].bgChange(this.subbgcoloroff)
		if(this.activeSub2>-1) this.sub2[this.activeSub2].bgChange(this.sub2bgcoloroff)
		this.activeSub=subnum
		this.sub[subnum].bgChange(this.subbgcoloron)
		if(!bw.ns4) this.sub[subnum].fcChange(this.subhovercolor)
		this.hideSub3()
		this.showSub2(subnum)
	}
}
//Mouseout on sub and sub2 menus
function cf_mmout(subnum,sub2num,sub3num){
	this.tim=setTimeout(this.name+".mout()",500)
	this.over=0
	if(sub3num>-1){
		this.sub3[sub3num].bgChange(this.sub3bgcoloroff)
		if(!bw.ns4) this.sub3[sub3num].fcChange(this.sub3textcolor)
	}else if(sub2num>-1){
		if(this.activeTop>-1 && this.activeSub>-1 && this.mtop[this.activeTop].sub.length!=0){
			if(!bw.ns4) this.sub2[sub2num].fcChange(this.sub2textcolor)
			if(!this.mtop[this.activeTop].sub[this.activeSub].sub[sub2num]) return 
			if(this.mtop[this.activeTop].sub[this.activeSub].sub[sub2num].sub.length==0) this.sub2[sub2num].bgChange(this.sub2bgcoloroff)
		}
	}else if(subnum>-1){
		if(this.activeTop>-1 && this.mtop[this.activeTop].sub.length!=0){
			if(!bw.ns4) this.sub[subnum].fcChange(this.subtextcolor)
			if(!this.mtop[this.activeTop].sub[subnum]) return 
			if(this.mtop[this.activeTop].sub[subnum].sub.length==0)	this.sub[subnum].bgChange(this.subbgcoloroff)
		}
	}
}
function cf_mmout2(name){
	this.tim=setTimeout(this.name+".mout()",500)
	this.over2=0
}
//Mouseover on the top menus
function cf_mover(num){
	if(!this.checkFrame() || !this.loaded) return
	clearTimeout(this.tim)
	if(this.activeTop>-1){
		if(this.bordersize>0) this.sub.border.hideIt()
		this.top[this.activeTop].bgChange(this.mainbgcoloroff)
		if(!bw.ns4) this.top[this.activeTop].css.color=this.maintextcolor
	}
	this.activeTop=num
	this.top[this.activeTop].bgChange(this.mainbgcoloron)
	this.hideSub2(); this.hideSub3()
	this.checkScrolled()
	if(!bw.ns4) this.top[num].css.color=this.mainhovercolor
	this.over2=1
	ln=this.mtop[num].sub.length
	for(i=0;i<this.maxsubs;i++){
		if(i<ln){
			this.sub[i].writeIt('<span class="clSub">'+this.mtop[num].sub[i].text+'</span>')
			this.sub[i].bgChange(this.subbgcoloroff)
			if(bw.ns4){
				this.sub[i].ref.captureEvents(Event.MOUSEDOWN)
				this.sub[i].ref.onmousedown=new Function(this.name+".go("+num+","+i+")")
			}else this.sub[i].evnt.onclick=new Function(this.name+".go("+num+","+i+")")
			this.sub[i].bgChange(this.subbgcoloroff)
			this.sub[i].showIt()
			if(this.frametype==0){
				x=this.subXplacement
				y=this.top[num].y + (this.subheight*i) +this.subYplacement + (this.bordersize*i)
			}else if(this.frametype==1){
				x=this.framesize- this.subwidth +this.subXplacement
				y=this.top[num].y + (this.subheight*i) +this.subYplacement + (this.bordersize*i)
			}else if(this.frametype==2){
				x=this.top[num].x+this.subXplacement
				y=this.subYplacement + (this.subheight*i) + (this.bordersize*i)
			}else if(this.frametype==3){
				x=this.top[num].x+this.subXplacement
				y=this.framesize - ((ln-i-1)*this.subheight)-this.subheight+this.subYplacement+(this.bordersize*i)-(this.bordersize*ln)
			}
			if(this.pagecheck){
				if(this.frametype==2 || this.frametype==3){
					if(x+this.subwidth>page.x2) x=this.top[num].x - this.subwidth + this.top[num].width
				}
			}
			this.sub[i].moveIt(x+this.scrolledX,y+this.scrolledY)
		}else this.sub[i].hideIt()
	}
	if(this.bordersize>0){
		if(ln!=0){
			this.sub.border.clipTo(0,this.subwidth + this.bordersize*2, this.subheight*ln + this.bordersize*(ln+1) ,0,1)
			this.sub.border.moveIt(this.sub[0].x-this.bordersize, this.sub[0].y-this.bordersize)
			this.sub.border.showIt()
		}else this.sub.border.hideIt()
	}
}
//Mouseout on all menus
function cf_mout(){
	if(!this.checkFrame() || !this.loaded || this.over) return
	this.activeTop=-1
	clearTimeout(this.tim)
	for(i=0;i<this.top.length;i++){this.top[i].bgChange(this.mainbgcoloroff); if(!bw.ns4) this.top[i].css.color=this.maintextcolor}
	for(i=0;i<this.maxsubs;i++){this.sub[i].hideIt()}
	if(this.bordersize>0) this.sub.border.hideIt()
	this.activeSub=-1; this.activeSub2=-1; this.activeSub2=-1
	this.hideSub2(); this.hideSub3()
}
/*****************************************************************************
Function that "resets" the object pointers when a new page loads. 
Without this Explorere crashes.
******************************************************************************/
function cf_refresh(){
	for(i=0;i<this.maxsubs;i++){
		this.sub[i]=new makeFObj(this.menuFrameName,'divSub'+i,this,-1,i,-1,-1)
	}
	for(i=0;i<this.maxsubs2;i++){
		this.sub2[i]=new makeFObj(this.menuFrameName,'divSub2_'+i,this,-1,-1,i,-1)
	}
	for(i=0;i<this.maxsubs3;i++){
		this.sub3[i]=new makeFObj(this.menuFrameName,'divSub3_'+i,this,-1,-1,-1,i)
	}
	this.loaded=true
	for(i=0;i<this.mtop.length;i++){
		if(this.bordersize>0) this.top[i].border.showIt()
		this.top[i].showIt()
	}
	if(this.frametype==1){ //Right menu
		this.framesize=bw.ns4||bw.ns5?top[this.menuFrameName].innerWidth+5:top[this.menuFrameName].document.body.offsetWidth-3;
	}else if(this.frametype==3){ //Bottom menu
		this.framesize=bw.ns4||bw.ns5?top[this.menuFrameName].innerHeight+5:top[this.menuFrameName].document.body.offsetHeight-1;
	}	
	if(this.bordersize>0){
		this.sub.border=new makeFObj(this.menuFrameName,'divSubBorder',this,-1,-1,-1,-1,1)
		this.sub2.border=new makeFObj(this.menuFrameName,'divSub2Border',this,-1,-1,-1,-1,1)
		this.sub3.border=new makeFObj(this.menuFrameName,'divSub3Border',this,-1,-1,-1,-1,1)
	}
}
/*****************************************************************************
Shows and hides the sub2s
******************************************************************************/
function cf_showSub2(num){
	if(this.activeTop<0) return 
	if(!this.mtop[this.activeTop].sub[num])return 
	ln=this.mtop[this.activeTop].sub[num].sub.length
	for(i=0;i<this.maxsubs2;i++){
		if(i<ln){
			this.sub2[i].writeIt('<span class="clSub2">'+this.mtop[this.activeTop].sub[num].sub[i].text+'</span>')
			this.sub2[i].bgChange(this.sub2bgcoloroff)	
			if(bw.ns4){
				this.sub2[i].ref.captureEvents(Event.MOUSEDOWN)
				this.sub2[i].ref.onmousedown=new Function(this.name+".go("+this.activeTop+","+num+","+i+")")
			}else this.sub2[i].evnt.onclick=new Function(this.name+".go("+this.activeTop+","+num+","+i+")")
			if(this.frametype==3) y=this.sub[num].y- ((ln-i-1)*this.sub2height)+this.sub2Yplacement+(this.bordersize*i)-(this.bordersize*ln)
			else y=this.sub[num].y+(i*this.sub2height)+this.sub2Yplacement+(this.bordersize*i)
			x=this.sub[num].x+this.sub2Xplacement
			if(this.pagecheck){
				if(this.frametype==2 || this.frametype==3){
					if(x+this.sub2width>page.x2) x=this.sub[num].x-this.sub2Xplacement
				}
			}
			this.sub2[i].moveIt(x,y)
			this.sub2[i].bgChange(this.sub2bgcoloroff)
			this.sub2[i].showIt()
		}else this.sub2[i].hideIt()
	}
	if(this.bordersize>0){
		if(ln!=0){
			this.sub2.border.clipTo(0,this.sub2width + this.bordersize*2, this.sub2height*ln + this.bordersize*(ln+1),0,1)
			this.sub2.border.moveIt(this.sub2[0].x-this.bordersize, this.sub2[0].y-this.bordersize)
			this.sub2.border.showIt()
		}else this.sub2.border.hideIt()
	}
}
function cf_hideSub2(num){
	for(i=0;i<this.maxsubs2;i++){
		this.sub2[i].hideIt()
	}
	if(this.bordersize>0) this.sub2.border.hideIt()
}
/*****************************************************************************
Shows and hides the sub3s
******************************************************************************/
function cf_showSub3(num){
	if(this.activeTop<0 || this.activeSub<0 || this.mtop[this.activeTop].sub.length==0) return 
	if(!this.mtop[this.activeTop].sub[this.activeSub].sub[num]) return 
	ln=this.mtop[this.activeTop].sub[this.activeSub].sub[num].sub.length
	for(i=0;i<this.maxsubs3;i++){
		if(i<ln){
			this.sub3[i].writeIt('<span class="clSub3">'+this.mtop[this.activeTop].sub[this.activeSub].sub[num].sub[i].text+'</span>')
			this.sub3[i].bgChange(this.sub3bgcoloroff)	
			if(bw.ns4){
				this.sub3[i].ref.captureEvents(Event.MOUSEDOWN)
				this.sub3[i].ref.onmousedown=new Function(this.name+".go("+this.activeTop+","+this.activeSub+","+num+","+i+")")
			}else this.sub3[i].evnt.onclick=new Function(this.name+".go("+this.activeTop+","+this.activeSub+","+num+","+i+")")
			if(this.frametype==3) y=this.sub2[num].y - ((ln-i-1)*this.sub3height) + this.sub3Yplacement+(this.bordersize*i)-(this.bordersize*ln)
			else y=this.sub2[num].y+ (i*this.sub3height) + this.sub3Yplacement+(this.bordersize*i)
			x=this.sub2[num].x+this.sub3Xplacement
			if(this.pagecheck){
				if(this.frametype==2 || this.frametype==3){
					if(x+this.sub3width+10>page.x2) x=this.sub2[num].x-this.sub3Xplacement
				}
			}
			this.sub3[i].moveIt(x,y)
			this.sub3[i].showIt()
		}else this.sub3[i].hideIt()
	}
	if(this.bordersize>0){
		if(ln!=0){
			this.sub3.border.clipTo(0,this.sub3width + this.bordersize*2, this.sub3height*ln + this.bordersize*(ln+1),0,1)
			this.sub3.border.moveIt(this.sub3[0].x-this.bordersize, this.sub3[0].y-this.bordersize)
			this.sub3.border.showIt()
		}else this.sub3.border.hideIt()
	}
}
function cf_hideSub3(num){
	for(i=0;i<this.maxsubs3;i++){
		this.sub3[i].hideIt()
	}
	if(this.bordersize>0) this.sub3.border.hideIt()
}
/*****************************************************************************
Sets the top menus
******************************************************************************/
function cf_construct(){
	this.top=new Array()
	this.x=this.checkp(this.fromleft,1); this.y=this.checkp(this.fromtop)
	this.pxbetween=this.checkp(this.pxbetween,0,1)
	for(i=0;i<this.mtop.length;i++){
		this.top[i]=new makeFObj(0,'divTop'+i,this,i,-1,-1,-1)
		this.top[i].bgChange(this.mainbgcoloroff)
		if(this.menuplacement!=0){
			if(this.frametype==2 || this.frametype==3) this.x=this.checkp(this.menuplacement[i],0,1)
			else this.y=this.checkp(this.menuplacement[i],0,1)
		}
		this.w=this.mtop[i].width||this.mainwidth
		this.top[i].moveIt(this.x,this.y)
		this.top[i].bgChange(this.mainbgcoloroff)
		this.top[i].clipTo(0,this.w,this.mainheight,0,1)
		this.top[i].width=this.w
		if(this.bordersize>0){
			this.top[i].border=new makeFObj(0,'divTop'+i+'Border',this,i,-1,-1,-1,1)
			this.top[i].border.moveIt(this.x-this.bordersize,this.y-this.bordersize)
			this.top[i].border.bgChange(this.bordercolor)
			this.top[i].border.clipTo(0,this.w+this.bordersize*2,this.mainheight+this.bordersize*2,0,1)
		}
		if(bw.ns4){
			this.top[i].ref.captureEvents(Event.MOUSEDOWN)
			this.top[i].ref.onmousedown=new Function(this.name+".go("+i+")")
		}else this.top[i].evnt.onclick=new Function(this.name+".go("+i+")")
		if(this.frametype==2 || this.frametype==3) this.x+=this.w+this.pxbetween
		else this.y+=this.mainheight+this.pxbetween
	}
	setTimeout("window.onresize=resized;",500)
}
/*****************************************************************************
Refreshing page if it's resized! - You can disable or change this if you want.
It's not 100% safe, but it should work in most frame enviroments
******************************************************************************/
function resized(){
	page2=new makePageCoords()
	if(page2.x2!=page.x2 || page.y2!=page2.y2){
		//Trapping what page that's in the frameset!
		if(top[oCFMenu.menuFrameName]) murl=top[oCFMenu.menuFrameName].location.href
		else murl=""
		if(murl.indexOf("http://")>-1){ //if not it's a local test page
			murl=murl.substr(murl.indexOf("/")+2,murl.length)
			currurl=location.href
			sign=currurl.indexOf("?")>-1?"&":"?"
			location.href=location.href  + sign + "resizedurl=" + murl
		}else location.reload()
	}
}
/*****************************************************************************
Make functions
******************************************************************************/
function cf_makeTop(text,link,target,width,fc){
	this.mtop[this.a]=new Array()
	this.mtop[this.a].sub=new Array()
	this.mtop[this.a].text=text
	this.mtop[this.a].link=link
	this.mtop[this.a].target=target
	this.mtop[this.a].width=width
	this.mtop[this.a].fc=fc
	this.b=0; this.a++
	if(this.bordersize>0) document.write('\n<div id="divTop'+(this.a-1)+'Border" class="clMainBorder"></div>\n')
	document.write('\n<div id="divTop'+(this.a-1)+'" class="clMain">'+text+'</div>\n')
}
function cf_makeSub(text,link,target,fc){
	this.mtop[this.a-1].sub[this.b]=new Array()
	this.mtop[this.a-1].sub[this.b].sub=new Array()
	this.mtop[this.a-1].sub[this.b].text=text
	this.mtop[this.a-1].sub[this.b].link=link
	this.mtop[this.a-1].sub[this.b].target=target
	this.mtop[this.a-1].sub[this.b].fc=fc
	this.c=0; this.b++
}
function cf_makeSub2(text,link,target,fc){
	this.mtop[this.a-1].sub[this.b-1].sub[this.c]=new Array()
	this.mtop[this.a-1].sub[this.b-1].sub[this.c].sub=new Array()
	this.mtop[this.a-1].sub[this.b-1].sub[this.c].text=text
	this.mtop[this.a-1].sub[this.b-1].sub[this.c].link=link
	this.mtop[this.a-1].sub[this.b-1].sub[this.c].target=target
	this.mtop[this.a-1].sub[this.b-1].sub[this.c].fc=fc
	this.d=0; this.c++
}
function cf_makeSub3(text,link,target,fc){
	this.mtop[this.a-1].sub[this.b-1].sub[this.c-1].sub[this.d]=new Array()
	this.mtop[this.a-1].sub[this.b-1].sub[this.c-1].sub[this.d].text=text
	this.mtop[this.a-1].sub[this.b-1].sub[this.c-1].sub[this.d].link=link
	this.mtop[this.a-1].sub[this.b-1].sub[this.c-1].sub[this.d].target=target
	this.mtop[this.a-1].sub[this.b-1].sub[this.c-1].sub[this.d].fc=fc
	this.d++
}
/*****************************************************************************
This function makes the string that will be written out in the main frame
whenever a page loads there.
******************************************************************************/
function cf_makeFrameString(){
	this.subwidth=this.checkp(this.subwidth,1)
	this.subheight=this.checkp(this.subheight)
	this.sub2width=this.checkp(this.sub2width,1)
	this.sub2height=this.checkp(this.sub2height)
	this.sub3width=this.checkp(this.sub3width,1)
	this.sub3height=this.checkp(this.sub3height)
	sw=bw.ns4?6:3;
	str='\n<style>\n'
		+'SPAN.clSub{'+this.substyle+'; width:'+(this.subwidth-sw)+'; color:'+this.subtextcolor+'}\n'
		+'SPAN.clSub2{'+this.sub2style+'; width:'+(this.sub2width-sw)+'; color:'+this.sub2textcolor+'}\n'
		+'SPAN.clSub3{'+this.sub3style+'; width:'+(this.sub3width-sw)+'; color:'+this.sub3textcolor+'}\n'
		+'DIV.clSubs{'+this.substyle+'; color:'+this.subcolor+'; cursor:hand; position:absolute; visibility:hidden; clip:rect(0,'+this.subwidth+','+this.subheight+',0); left:0; width:'+this.subwidth+'; height:'+this.subheight+'}\n'
	for(i=0;i<this.maxsubs;i++){
		str+='#divSub'+i+'{top:'+(this.subheight*i)+';}\n'	
	}
	if(this.bordersize>0){
		str+='#divSubBorder{position:absolute; background-color:'+this.bordercolor+'; layer-background-color:'+this.bordercolor+'}\n'
		str+='#divSub2Border{position:absolute; background-color:'+this.bordercolor+'; layer-background-color:'+this.bordercolor+'}\n'
		str+='#divSub3Border{position:absolute; background-color:'+this.bordercolor+'; layer-background-color:'+this.bordercolor+'}\n'
	}	
	str+='DIV.clSubs3{'+this.sub3style+'; color:'+this.sub3textcolor+'; cursor:hand; position:absolute; visibility:hidden; clip:rect(0,'+this.sub3width+','+this.sub3height+',0); left:0; width:'+this.sub3width+'; height:'+this.sub3height+'}\n'
	str+='DIV.clSubs2{'+this.sub2style+'; color:'+this.sub2textcolor+'; cursor:hand;position:absolute; visibility:hidden; clip:rect(0,'+this.sub2width+','+this.sub2height+',0); left:0; width:'+this.sub2width+'; height:'+this.sub2height+'}\n'
		+'</style>\n\n'
	this.frameString=str
	str="\n\n"
	if(this.bordersize>0) str+='<div id="divSubBorder"></div>\n\n'
	for(i=0;i<this.maxsubs;i++){
		str+='<div id="divSub'+i+'" class="clSubs"></div>\n'
	}
	if(this.bordersize>0) str+='<div id="divSub2Border"></div>\n\n'
	for(i=0;i<this.maxsubs2;i++){
		str+='<div id="divSub2_'+i+'" class="clSubs2"></div>\n'
	}
	if(this.bordersize>0) str+='<div id="divSub3Border"></div>\n\n'
	for(i=0;i<this.maxsubs3;i++){
		str+='<div id="divSub3_'+i+'" class="clSubs3"></div>\n'
	}
	this.frameString2=str	
}
/*****************************************************************************
Styles for the top items
******************************************************************************/
function cf_makeStyle(){
	this.mainheight=this.checkp(this.mainheight)
	this.mainwidth=this.checkp(this.mainwidth,1)
	str='\n\n<style>\n'
	str+='\tDIV.clMain{position:absolute; cursor:hand; color:'+this.maintextcolor+'; visibility:hidden; '+this.topstyle+' }\n'
	if(this.bordersize>0)str+='\tDIV.clMainBorder{position:absolute; cursor:hand; visibility:hidden; '+this.topstyle+' }\n'	
	str+='</style>\n\n'	
	document.write(str)
}
/*****************************************************************************
Going to another page
******************************************************************************/
function cf_go(num,subnum,sub2num,sub3num){
	if(sub3num>-1){
		url=this.mtop[num].sub[subnum].sub[sub2num].sub[sub3num].link
		target=this.mtop[num].sub[subnum].sub[sub2num].sub[sub3num].target
		fc=this.mtop[num].sub[subnum].sub[sub2num].sub[sub3num].fc
	}else if(sub2num>-1){
		url=this.mtop[num].sub[subnum].sub[sub2num].link
		target=this.mtop[num].sub[subnum].sub[sub2num].target
		fc=this.mtop[num].sub[subnum].sub[sub2num].fc
	}else if(subnum>-1){
		url=this.mtop[num].sub[subnum].link
		target=this.mtop[num].sub[subnum].target
		fc=this.mtop[num].sub[subnum].fc
	}else{
		url=this.mtop[num].link
		target=this.mtop[num].target
		fc=this.mtop[num].fc
	}	
	if(url){
		this.over=0; this.mout()
		if(target=="_blank") window.open(url)
		else if(target=="_top" || target=="window") top.location.href=url  
		else top[target].location.href=url
	}else if(fc){
		eval(fc)
	}
}

/*****************************************************************************
Making the main CoolFrame menu object
******************************************************************************/
function coolFrameMenu(name){
	page=new makePageCoords()
	this.name=name
	this.sub=new Array(); this.sub2=new Array()
	this.sub3=new Array(); this.construct=cf_construct;
	this.over=false; this.tim=100
	this.refresh=cf_refresh;
	this.checkFrame=cf_checkFrame; this.mmout2=cf_mmout2
	this.mover=cf_mover; this.mout=cf_mout;
	this.mmover=cf_mmover; this.mmout=cf_mmout;
	this.a=0; this.b=0; this.c=0; this.d=0;
	this.loaded=false; this.mtop=new Array()
	this.makeTop=cf_makeTop; this.makeSub=cf_makeSub;
	this.makeSub2=cf_makeSub2; this.makeSub3=cf_makeSub3;
	this.showSub2=cf_showSub2; this.hideSub2=cf_hideSub2;
	this.showSub3=cf_showSub3; this.hideSub3=cf_hideSub3;
	this.activeTop=-1; this.activeSub=-1
	this.lastSub=-1; this.frameString2=0
	this.makeFrameString=cf_makeFrameString;
	this.makeStyle=cf_makeStyle;
	this.checkp=cf_checkp;
	this.go=cf_go;
	this.scrolledX=0; this.scrolledY=0
	this.checkScrolled=cf_checkScrolled;
}
