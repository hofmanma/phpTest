/*******************************************************************************
Copyright (c) 1999 Thomas Brattli (www.bratta.com)

eXperience DHTML coolFrameMenus - Get it at www.bratta.com
Version Beta 1.0
This script can be used freely as long as all copyright messages are
intact. 

All files that goes in the "main" frame must have this file linked to it
(after the body tag!!)
*******************************************************************************/
function makeMenus(){
	if(parent.frmMenu){
		if(parent.frmMenu.oCFMenu){
			if(parent.frmMenu.oCFMenu.frameString2){
				document.write(parent.frmMenu.oCFMenu.frameString)
				if(parent.frmMenu.bw.ns5){
					document.close()
					document.body.innerHTML+=parent.frmMenu.oCFMenu.frameString2
				}else{
					document.write(parent.frmMenu.oCFMenu.frameString2)
					document.close()
				}
				parent.frmMenu.oCFMenu.refresh()
			}
		}
	}
}
function unload(){
	if(parent.frmMenu){
		if(parent.frmMenu.oCFMenu){
			parent.frmMenu.oCFMenu.loaded=0
		}
	}
}
makeMenus()
window.onunload=unload;
