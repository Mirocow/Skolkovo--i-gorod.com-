var rus2eng={"А":"A","Б":"B","В":"V","Г":"G","Д":"D","Е":"E","Ё":"YO","Ж":"ZH","З":"Z","И":"I","Й":"J","К":"K","Л":"L","М":"M","Н":"N","О":"O","П":"P","Р":"R","С":"S","Т":"T","У":"U","Ф":"F","Х":"H","Ц":"C","Ч":"CH","Ш":"SH","Щ":"W","Ъ":"","Ы":"Y","Ь":"","Э":"E","Ю":"YU","Я":"YA","а":"a","б":"b","в":"v","г":"g","д":"d","е":"e","ё":"yo","ж":"zh","з":"z","и":"i","й":"j","к":"k","л":"l","м":"m","н":"n","о":"o","п":"p","р":"r","с":"s","т":"t","у":"u","ф":"f","х":"h","ц":"c","ч":"ch","ш":"sh","щ":"w","ъ":"","ы":"y","ь":"","э":"e","ю":"yu","я":"ya"};var eng2rus={"А":"A","YA":"Я"};var rus2engRE=/(?:[А-Яа-я])/g;var eng2rusRE=/(?:YA|A)/g;function trCallbackRu(str){return rus2eng[str]}function trCallbackEn(str){return eng2rus[str]}function transliterateRu(str){return str.replace(rus2engRE,trCallbackRu)}function transliterateEn(str){return str}function base64encode(str){var sWinChrs='АБВГДЕЖЗИЙКЛМНОПРСТУФХЦЧШЩЪЫЬЭЮЯабвгдежзийклмнопрстуфхцчшщъыьэюя';var sBase64Chrs='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/';var arrBase64=sBase64Chrs.split('');var a=new Array();var i=0;for(i=0;i<str.length;i++){var cch=str.charCodeAt(i);if(cch>127){cch=sWinChrs.indexOf(str.charAt(i))+163;if(cch<163)continue}a.push(cch)}var s=new Array();var lPos=a.length-a.length%3;var t=0;for(i=0;i<lPos;i+=3){t=(a[i]<<16)+(a[i+1]<<8)+a[i+2];s.push(arrBase64[(t>>18)&0x3f]+arrBase64[(t>>12)&0x3f]+arrBase64[(t>>6)&0x3f]+arrBase64[t&0x3f])}switch(a.length-lPos){case 1:t=a[lPos]<<4;s.push(arrBase64[(t>>6)&0x3f]+arrBase64[t&0x3f]+'==');break;case 2:t=(a[lPos]<<10)+(a[lPos+1]<<2);s.push(arrBase64[(t>>12)&0x3f]+arrBase64[(t>>6)&0x3f]+arrBase64[t&0x3f]+'=');break}return s.join('')}var parsedCookies=null;function setCookie(name,value,expires){var e="";if(expires){var d=new Date();d.setTime(d.getTime()+expires);e="; expires="+d.toGMTString()}if(value===null){e="; expires=Thu, 01-Jan-1970 00:00:01 GMT"}document.cookie=name+"="+value+e+"; path=/";if(parsedCookies){if(value!=null)parsedCookies[name]=value;else delete parsedCookies[name]}}function getCookie(name){if(!parsedCookies){parsedCookies={};var pairs=document.cookie.split(";");for(var i=0;i<pairs.length;i++){var pair=pairs[i].split("=");parsedCookies[pair[0].replace(/^\s/,"")]=pair[1]}}return parsedCookies[name]||null}function relationControl(_typeId,_fieldSuffix,_prependEmpty,_sourceUri){var _self=this;var typeId=_typeId;var fieldSuffix=_fieldSuffix||_typeId;var needLoad=true;var selectInput=null;var textInput=null;var addButton=null;var addedOption=null;var useSearchOption=null;var suggestDiv=null;var timeHandler=null;var suggestItems=null;var suggestIndex=null;var mouseX=0;var mouseY=0;var sourceUri=_sourceUri||'/admin/data/guide_items_all/';var init=function(){selectInput=document.getElementById('relationSelect'+fieldSuffix);textInput=document.getElementById('relationInput'+fieldSuffix);addButton=document.getElementById('relationButton'+fieldSuffix);if(!selectInput){alert('Select input for field #'+fieldSuffix+' not found');return}if(addButton){addButton.onclick=function(){_self.addItem()}}if(textInput){textInput.onkeyup=function(keyEvent){var code=keyEvent?keyEvent.keyCode:event.keyCode;if(code==13&&addButton){_self.addItem();return false}else{_self.doSearch()}};textInput.onkeydown=function(keyEvent){var code=keyEvent?keyEvent.keyCode:event.keyCode;if(code==13){return false}}}var onLoadItems=function(){if(needLoad){_self.loadItemsAll();needLoad=false}};selectInput.onmouseover=onLoadItems;selectInput.onfocus=onLoadItems;for(var i=0;i<selectInput.childNodes.length;i++){if(selectInput.childNodes[i].nodeType!=1){selectInput.removeChild(selectInput.childNodes[i]);i=0}}if(_prependEmpty&&$("option[value='']",selectInput).size()==0){$(selectInput).prepend("<option value=''></option>")}};this.rescan=function(){textInput=document.getElementById('relationInput'+fieldSuffix);if(textInput){textInput.onkeyup=function(keyEvent){var code=keyEvent?keyEvent.keyCode:event.keyCode;if(code==13&&addButton){_self.addItem()}else{_self.doSearch()}}}};this.getValue=function(){var opts=$("option[selected]",$(selectInput));var values=[];for(var i=0;i<opts.length;i++){values[opts[i].value]=$(opts[i]).text()}return values};this.loadItems=function(startsWith){$.ajax({url:sourceUri+typeId+".xml?limit&search[]="+encodeURIComponent(startsWith),type:"get",complete:function(r,t){_self.updateItems(r)}})};this.loadItemsAll=function(){$.ajax({url:sourceUri+typeId+".xml?allow-empty",type:"get",complete:function(r,t){_self.updateItemsAll(r)}})};this.updateItemsAll=function(response){if(response.responseXML.getElementsByTagName('empty').length){if(textInput){textInput.onkeyup=function(keyEvent){var code=keyEvent?keyEvent.keyCode:event.keyCode;switch(code){case 38:{if(suggestItems.length&&(suggestIndex>0||suggestIndex==null)){highlightSuggestItem((suggestIndex===null)?(suggestItems.length-1):(suggestIndex-1))}break}case 40:{if(suggestItems.length&&(suggestIndex<(suggestItems.length-1)||suggestIndex==null)){highlightSuggestItem((suggestIndex===null)?0:(suggestIndex+1))}break}case 13:{addHighlitedItem();hideSuggest();break}case 27:{hideSuggest();break}default:{clearTimeout(timeHandler);timeHandler=setTimeout(function(){_self.doSearchAjax()},500)}}};textInput.onblur=function(){if(suggestDiv){if(mouseX<parseInt(suggestDiv.style.left)||mouseX>(parseInt(suggestDiv.style.left)+parseInt(suggestDiv.offsetWidth))||mouseY<parseInt(suggestDiv.style.top)||mouseY>(parseInt(suggestDiv.style.top)+parseInt(suggestDiv.offsetHeight))){hideSuggest()}}};var total=response.responseXML.getElementsByTagName('empty')[0].getAttribute('total');if(!useSearchOption){useSearchOption=new Option(' ','');useSearchOption.innerHTML=getLabel('js-relation-total')+total+". "+getLabel('js-relation-use_search');selectInput.insertBefore(useSearchOption,selectInput.firstChild)}}return}var items=response.responseXML.getElementsByTagName('object');var selection=[];var i=0;for(i=0;i<selectInput.options.length;i++){if(selectInput.options[i].selected){selection.push(selectInput.options[i].value)}}$("option:not([selected])",selectInput).remove();$("option[value='']",selectInput).remove();if(_prependEmpty)$(selectInput).prepend("<option value=''> </option>");for(i=0;i<items.length;i++){var itemId=items[i].getAttribute('id');var hasItem=false;for(var idx in selection){if(selection[idx]==itemId){hasItem=true;delete selection[idx];break}}if(!hasItem){var text=items[i].getAttribute('name');var opt=new Option(text,itemId);opt.innerHTML=text;selectInput.appendChild(opt)}}if($.browser.msie){var d=selectInput.style.display;selectInput.style.display='none';selectInput.style.display=d}};this.updateItems=function(response){suggestIndex=null;suggestItems=response.responseXML.getElementsByTagName('object');if(!suggestItems.length)return;var ul=null;if(!suggestDiv){suggestDiv=document.createElement('div');suggestDiv.className='relationAutosuggest';var pos=$(textInput).offset();suggestDiv.style.position='absolute';suggestDiv.style.zIndex=1050;suggestDiv.style.width=textInput.clientWidth+"px";suggestDiv.style.top=(pos.top+textInput.offsetHeight)+"px";suggestDiv.style.left=pos.left+"px";ul=document.createElement('ul');suggestDiv.appendChild(ul);document.body.appendChild(suggestDiv)}suggestDiv.style.display='';$(document).mousemove(documentMouseMoveHandler);ul=suggestDiv.firstChild;while(ul.firstChild){ul.removeChild(ul.firstChild)}for(i=0;i<suggestItems.length;i++){var text=suggestItems[i].getAttribute('name');var li=document.createElement('li');li.innerHTML=text;li.onmouseover=function(){highlightSuggestItem(this.suggestIndex)};li.onmouseout=function(){this.className=''};li.onclick=function(){addHighlitedItem();hideSuggest()};li.suggestIndex=i;ul.appendChild(li)}};var documentMouseMoveHandler=function(e){if(!e){mouseX=event.clientX+document.body.scrollLeft;mouseY=event.clientY+document.body.scrollTop}else{mouseX=e.pageX;mouseY=e.pageY}return true};this.addItem=function(_text,_value){if(!(_text&&_text.length)&&!(textInput&&textInput.value.length)){return}clearSearch();removeGroups();if(!selectInput.multiple&&addedOption&&!_text&&!_value){addedOption.innerHTML=(_value?'':'&rarr;&nbsp;&nbsp;')+textInput.value;addedOption.value=_value?_value:textInput.value;selectInput.selectedIndex=0}else{addedOption=new Option(_text?_text:textInput.value,_value?_value:textInput.value);addedOption.innerHTML=(_value?'':'&rarr;&nbsp;&nbsp;')+(_text?_text:textInput.value);if(selectInput.options.length){selectInput.insertBefore(addedOption,selectInput.firstChild)}else{selectInput.appendChild(addedOption)}}textInput.value='';addedOption.selected=true;if(jQuery.browser.msie){setTimeout(function(){addedOption.selected=false;addedOption.selected=true},20)}};var highlightSuggestItem=function(itemIndex){if(suggestDiv.style.display!='none'){var list=suggestDiv.firstChild;var oldHighlited=list.childNodes.item(suggestIndex);if(oldHighlited){oldHighlited.className=''}list.childNodes.item(itemIndex).className='active';suggestIndex=itemIndex}};var addHighlitedItem=function(){if(suggestDiv&&suggestDiv.style.display!='none'&&suggestIndex!==null){var text=suggestItems[suggestIndex].getAttribute('name');var value=suggestItems[suggestIndex].getAttribute('id');var found=false;for(var i=0;i<selectInput.options.length;i++){if(selectInput.options[i].value==value){found=true;selectInput.options[i].selected=true;break}}if(!found){_self.addItem(text,value)}}else if(textInput.value.length&&addButton){_self.addItem()}};var hideSuggest=function(){if(suggestDiv&&suggestDiv.style.display!='none'){suggestDiv.style.display='none';$(document).unbind('mousemove',documentMouseMoveHandler)}};this.doSearch=function(){var text=textInput.value.toLowerCase();clearSearch();if(text==''){if(selectInput.multiple)removeGroups();return}for(var i=0;i<selectInput.options.length;i++){var optionText=selectInput.options[i].text;var optionText2=optionText.replace(/^.\s\s/,'');if(optionText.substring(0,text.length).toLowerCase()===text||optionText2.substring(0,text.length).toLowerCase()===text){if(selectInput.multiple){if(selectInput.firstChild.nodeName.toLowerCase()!='optgroup'){createGroups();searchGroup=selectInput.firstChild;itemsGroup=selectInput.lastChild}var currentItem=selectInput.options[i];if(currentItem.parentNode==searchGroup)continue;currentItem.oldPrevSibling=currentItem.previousSibling;itemsGroup.removeChild(currentItem);searchGroup.appendChild(currentItem);if(searchGroup.childNodes.length==5)return}else{selectInput.selectedIndex=i;return}}}};this.doSearchAjax=function(){if(textInput.value){this.loadItems(textInput.value)}};var createGroups=function(){var searchGroup=document.createElement('optgroup');searchGroup.label='Search results';var itemsGroup=document.createElement('optgroup');itemsGroup.label='------------------------------------------------';while(selectInput.firstChild){var child=selectInput.firstChild;selectInput.removeChild(child);itemsGroup.appendChild(child)}selectInput.appendChild(searchGroup);selectInput.appendChild(itemsGroup)};var removeGroups=function(){if(selectInput.firstChild&&selectInput.firstChild.nodeName.toLowerCase()=='optgroup'){selectInput.removeChild(selectInput.firstChild);var itemsGroup=selectInput.firstChild;while(itemsGroup.firstChild){var child=itemsGroup.firstChild;itemsGroup.removeChild(child);selectInput.appendChild(child)}selectInput.removeChild(itemsGroup)}};var clearSearch=function(){if(selectInput.firstChild&&selectInput.firstChild.nodeName.toLowerCase()=='optgroup'){var searchGroup=selectInput.firstChild;var itemsGroup=selectInput.lastChild;while(searchGroup.firstChild){var child=searchGroup.firstChild;searchGroup.removeChild(child);if(child.oldPrevSibling!==undefined||child.oldPrevSibling==null){if(child.oldPrevSibling&&child.oldPrevSibling.nextSibling){itemsGroup.insertBefore(child,child.oldPrevSibling.nextSibling)}else if(child.oldPrevSibling===null){itemsGroup.insertBefore(child,itemsGroup.firstChild)}else{itemsGroup.appendChild(child)}child.oldPrevSibling=undefined}}}};init()}function symlinkControl(_id,_module,_types,_options){var _self=this;var id=_id;var types=(_types instanceof Array)?_types:[_types];var typesStr=(_types instanceof Array)?'&htypes[]='+_types.join('&htypes[]='):'';var module=_module||null;var container=null;var textInput=null;var treeButton=null;var pagesList=null;var suggestDiv=null;var suggestItems=null;var suggestIndex=null;var mouseX=0;var mouseY=0;if(!_options)var _options={};var iconBase=_options['iconsPath']||'/images/cms/admin/mac/tree/';var fadeClrStart=_options['fadeColorStart']||[255,0,0];var fadeClrEnd=_options['fadeColorEnd']||[255,255,255];var inputName=_options['inputName']||('symlinkInput'+id);var noImages=_options['noImages']||false;var pagesCache={};var init=function(){if(!window.symlinkControlsList)window.symlinkControlsList={};window.symlinkControlsList[id]=_self;container=document.getElementById('symlinkInput'+id);if(!container){alert('Symlink container #'+id+' not found');return}var input=document.createElement('input');input.type='hidden';input.name=inputName;container.parentNode.insertBefore(input,container);pagesList=document.createElement('ul');container.appendChild(pagesList);textInput=document.createElement('input');container.appendChild(textInput);treeButton=noImages?document.createElement('input'):document.createElement('img');container.appendChild(treeButton);textInput.type='text';if(noImages){treeButton.type='button';treeButton.value='╘'}else{treeButton.src="/images/cms/admin/mac/tree.png";treeButton.height="18"}treeButton.className='treeButton';treeButton.onclick=function(){$.openPopupLayer({name:"Sitetree",title:"Выбор страницы",width:620,height:335,url:"/styles/common/js/tree.html?id="+id+(module?"&module="+module:"")+(window.lang_id?"&lang_id="+window.lang_id:"")})};pagesList.className='pageslist';textInput.onkeypress=function(e){var keyCode=e?e.keyCode:window.event.keyCode;if(keyCode==13)return false};textInput.onkeyup=function(e){var keyCode=e?e.keyCode:window.event.keyCode;switch(keyCode){case 38:{if(suggestItems.length&&(suggestIndex>0||suggestIndex==null)){highlightSuggestItem((suggestIndex===null)?(suggestItems.length-1):(suggestIndex-1))}break}case 40:{if(suggestItems.length&&(suggestIndex<(suggestItems.length-1)||suggestIndex==null)){highlightSuggestItem((suggestIndex===null)?0:(suggestIndex+1))}break}case 13:{addHighlitedItem();hideSuggest();return false;break}case 27:{hideSuggest();break}default:{_self.doSearch()}}};textInput.onblur=function(){if(suggestDiv){if(mouseX<parseInt(suggestDiv.style.left)||mouseX>(parseInt(suggestDiv.style.left)+parseInt(suggestDiv.offsetWidth))||mouseY<parseInt(suggestDiv.style.top)||mouseY>(parseInt(suggestDiv.style.top)+parseInt(suggestDiv.offsetHeight))){hideSuggest()}}}};this.loadItems=function(searchText){$.ajax({url:"/admin/content/load_tree_node.xml?limit&domain_id[]="+(window.domain_id?window.domain_id:'1')+typesStr+(window.lang_id?"&lang_id="+window.lang_id:"")+"&search-all-text[]="+encodeURIComponent(searchText),type:"get",complete:function(r,t){_self.updateItems(r)}})};this.updateItems=function(response){suggestIndex=null;suggestItems=response.responseXML.getElementsByTagName('page');if(!suggestItems.length)return;var tmp=[];for(var i=0;i<suggestItems.length;i++){if(pagesCache[suggestItems[i].getAttribute('id')])continue;tmp[tmp.length]=suggestItems[i]}suggestItems=tmp;var ul=null;if(!suggestDiv){suggestDiv=document.createElement('div');suggestDiv.className='symlinkAutosuggest';var pos=$(textInput).offset();suggestDiv.style.position='absolute';suggestDiv.style.zIndex=1050;suggestDiv.style.width=textInput.clientWidth+"px";suggestDiv.style.top=(pos.top+textInput.offsetHeight)+"px";suggestDiv.style.left=pos.left+"px";ul=document.createElement('ul');suggestDiv.appendChild(ul);document.body.appendChild(suggestDiv)}showSuggest();$(document).mousemove(documentMouseMoveHandler);ul=suggestDiv.firstChild;while(ul.firstChild){ul.removeChild(ul.firstChild)}for(i=0;i<suggestItems.length;i++){if(pagesCache[suggestItems[i].getAttribute('id')])continue;var name=getElementText(suggestItems[i].getElementsByTagName('name')[0]);var type=getElementText(suggestItems[i].getElementsByTagName('basetype')[0]);var link=suggestItems[i].getAttribute('link');var li=document.createElement('li');var span=document.createElement('span');var a=document.createElement('a');li.title=name;if(name.length>20)name=name.substr(0,20)+'...';if(link.length>55)link=link.substr(0,55)+'...';li.appendChild(document.createTextNode(name));li.appendChild(span);li.appendChild(document.createElement('br'));li.appendChild(a);span.appendChild(document.createTextNode(' ('+type+')'));a.appendChild(document.createTextNode(link));a.href=link;li.onmouseover=function(){highlightSuggestItem(this.suggestIndex)};li.onclick=function(){addHighlitedItem();hideSuggest()};li.suggestIndex=i;ul.appendChild(li)}};this.doSearch=function(){var text=textInput.value;_self.loadItems(text)};var highlightSuggestItem=function(itemIndex){if(suggestDiv.style.display!='none'){var list=suggestDiv.firstChild;var oldHighlited=list.childNodes.item(suggestIndex);if(oldHighlited){oldHighlited.className=''}list.childNodes.item(itemIndex).className='active';suggestIndex=itemIndex}};var addHighlitedItem=function(){if(suggestDiv&&suggestDiv.style.display!='none'&&suggestIndex!==null){var id=suggestItems[suggestIndex].getAttribute('id');var name=getElementText(suggestItems[suggestIndex].getElementsByTagName('name')[0]);var aname=suggestItems[suggestIndex].getAttribute('link');var type=suggestItems[suggestIndex].getElementsByTagName('basetype')[0];var t='';var module=(t=type.getAttribute('module'))?t:'';var method=(t=type.getAttribute('method'))?t:'';_self.addItem(id,name,[module,method],aname)}};this.addItem=function(pageId,name,basetype,href){if(pagesCache[pageId]!==undefined)return;var page=document.createElement('li');var text=document.createElement('span');var link=document.createElement('a');var btn=document.createElement('a');var input=document.createElement('input');input.type='hidden';input.name=inputName;input.value=pageId;btn.input=input;link.href=href;if(noImages){btn.appendChild(document.createTextNode('[x]'))}else{var btnImage=document.createElement('img');btnImage.src=iconBase+'symlink_delete.png';btnImage.alt='delete';btn.appendChild(btnImage)}btn.href='javascript:void(0);';btn.className='button';btn.onclick=function(){this.input.parentNode.removeChild(this.input);pagesList.removeChild(this.parentNode);delete pagesCache[pageId]};text.title=basetype[0]+" "+basetype[1];text.appendChild(document.createTextNode(name));link.appendChild(document.createTextNode(href));page.appendChild(btn);if(!noImages){var icon=document.createElement('img');icon.src=iconBase+'ico_'+basetype[0]+'_'+basetype[1]+'.png';page.appendChild(icon)}page.appendChild(text);page.appendChild(link);pagesList.appendChild(page);container.parentNode.insertBefore(input,container);page.style.backgroundColor=makeHexRgb(fadeClrStart);page.startColor=fadeClrStart;page.endColor=fadeClrEnd;page.pname=name;page.fade=fader;setTimeout(function(){page.fade()},2000);pagesCache[pageId]=true;if($('#eip_page').size()){frameElement.height=($('#eip_page').height()>500)?500:$('#eip_page').height()}};var fader=function(){if(this.fadeColor==undefined){this.fadeColor=[];this.fadeColor[0]=this.startColor[0];this.fadeColor[1]=this.startColor[1];this.fadeColor[2]=this.startColor[2]}if(Math.round(this.fadeColor[0]+this.fadeColor[1]+this.fadeColor[2])==Math.round(this.endColor[0]+this.endColor[1]+this.endColor[2]))return;this.fadeColor[0]+=(this.endColor[0]-this.startColor[0])/50;this.fadeColor[1]+=(this.endColor[1]-this.startColor[1])/50;this.fadeColor[2]+=(this.endColor[2]-this.startColor[2])/50;this.style.backgroundColor=makeHexRgb(this.fadeColor);var _p=this;setTimeout(function(){_p.fade()},20)};var showSuggest=function(){if(suggestDiv){var pos=$(textInput).offset();suggestDiv.style.width=textInput.clientWidth;suggestDiv.style.top=pos.top+textInput.offsetHeight;suggestDiv.style.left=pos.left;suggestDiv.style.display=''}};var hideSuggest=function(){if(suggestDiv&&suggestDiv.style.display!='none'){suggestDiv.style.display='none';$(document).unbind('mousemove',documentMouseMoveHandler)}};var documentMouseMoveHandler=function(e){if(!e){mouseX=event.clientX+document.body.scrollLeft;mouseY=event.clientY+document.body.scrollTop}else{mouseX=e.pageX;mouseY=e.pageY}return true};var getElementText=function(element){return(element.firstChild&&element.firstChild.nodeType==3)?element.firstChild.nodeValue:element.nodeValue};init()};var hex=['0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f'];function makeHexRgb(rgb){var result='';for(var i=0;i<3;i++){result=result+hex[Math.floor(rgb[i]/16)]+hex[Math.floor(rgb[i]%16)]}return'#'+result}function permissionsControl(_containerId){var _self=this;var container=document.getElementById(_containerId);var ownertable=null;var input=null;var permissionCache={};var guestLevel=0;var guestRow=null;var suggestDiv=null;var suggestItems=null;var suggestIndex=null;var mouseX=0;var mouseY=0;var titles=[getLabel('js-permissions-view'),getLabel('js-permissions-edit'),getLabel('js-permissions-create'),getLabel('js-permissions-delete'),getLabel('js-permissions-move')];var construct=function(){var table=document.createElement('table');var header=document.createElement('tr');var th=document.createElement('th');th.style.width="100%";th.appendChild(document.createTextNode(' '));header.appendChild(th);var images=["/images/cms/admin/mac/tree/view.png","/images/cms/admin/mac/tree/ico_edit.png","/images/cms/admin/mac/tree/ico_add.png","/images/cms/admin/mac/tree/ico_del.png","/images/cms/admin/mac/ico_data_drag_a.gif"];for(var i=0;i<titles.length;i++){th=document.createElement('th');var img=document.createElement("img");img.src=images[i];img.alt=img.title=titles[i];th.appendChild(img);th.className="permissionType";header.appendChild(th)}table.className="permissionTable";var addRow=document.createElement('tr');var addCell=document.createElement('td');addCell.colspan=6;addCell.setAttribute('colspan','6');addCell.className='addOwner';addRow.appendChild(addCell);input=document.createElement('input');addCell.appendChild(input);input.onkeypress=function(e){var keyCode=e?e.keyCode:window.event.keyCode;if(keyCode==13)return false};input.onkeyup=inputKeyup;input.onblur=inputBlur;ownertable=document.createElement('tbody');var thead=document.createElement("thead");thead.appendChild(header);var tfoot=document.createElement("tfoot");tfoot.appendChild(addRow);table.appendChild(thead);table.appendChild(ownertable);table.appendChild(tfoot);container.appendChild(table);_self.add(2373,"",0)};this.add=function(id,name,level,ignoreGuestLevel){var pObject={};pObject.id=id;pObject.name=name;pObject.level=level;if(id==2373){guestLevel=level;name="Все"}else if(level==guestLevel&&!ignoreGuestLevel){return}if(id==14||id==15)return;permissionCache[id]=pObject;var row=document.createElement('tr');var td=document.createElement('td');var icon=document.createElement('img');icon.src="/images/cms/admin/mac/perm_user.png";td.appendChild(document.createTextNode(name));row.appendChild(td);var l=[1,2,4,8,16];var n=['perms_read','perms_edit','perms_create','perms_delete','perms_move'];for(var i=0;i<l.length;i++){var cb=document.createElement('input');cb.type='checkbox';cb.name=n[i]+'['+id+']';cb.value=l[i];cb.title=titles[i];if(level&l[i]){cb.checked=true}td=document.createElement('td');td.appendChild(cb);td.className="permissionType";row.appendChild(td)}if(id==2373&&guestRow){ownertable.replaceChild(row,guestRow)}else{ownertable.appendChild(row)}if(id==2373)guestRow=row};this.loadItems=function(searchText){$.ajax({url:"/admin/users/getPermissionsOwners/4.xml?limit&search-all-text[]="+encodeURIComponent(searchText),method:"get",complete:function(r){_self.updateItems(r)}})};this.updateItems=function(response){suggestIndex=null;suggestItems=response.responseXML.getElementsByTagName('owner');var tmp=[];if(!suggestItems.length)return;for(var i=0;i<suggestItems.length;i++){var id=parseInt(suggestItems[i].getAttribute('id'));if(permissionCache[id]==undefined){tmp[tmp.length]=suggestItems[i]}}suggestItems=tmp;if(!suggestItems.length)return;var ul=null;if(!suggestDiv){suggestDiv=document.createElement('div');suggestDiv.className='symlinkAutosuggest';var pos=$(input).offset();suggestDiv.style.position='absolute';suggestDiv.style.zIndex=1050;suggestDiv.style.width=input.clientWidth+"px";suggestDiv.style.top=(pos.top+input.offsetHeight)+"px";suggestDiv.style.left=pos.left+"px";ul=document.createElement('ul');suggestDiv.appendChild(ul);document.body.appendChild(suggestDiv)}showSuggest();$(document).mousemove(documentMouseMoveHandler);ul=suggestDiv.firstChild;while(ul.firstChild){ul.removeChild(ul.firstChild)}var index=0;for(i=0;i<suggestItems.length;i++){var text=suggestItems[i].getAttribute('name');var li=document.createElement('li');var icon=document.createElement('img');icon.src="/images/cms/admin/mac/perm_"+suggestItems[i].getAttribute('type')+".png";li.appendChild(icon);li.appendChild(document.createTextNode(text));if(suggestItems[i].getAttribute('type')=='group'){li.appendChild(document.createElement('br'));var span=document.createElement('span');li.appendChild(span);var users=suggestItems[i].getElementsByTagName('user');var s="";for(var j=0;j<users.length;j++){s=s+(j?", ":"")+users[j].getAttribute('name')}span.appendChild(document.createTextNode(s))}li.onmouseover=function(){highlightSuggestItem(this.suggestIndex)};li.onmouseout=function(){this.className=''};li.onclick=function(){addHighlitedItem();hideSuggest();input.value=""};li.suggestIndex=index;ul.appendChild(li);index++}};this.doSearch=function(){var text=input.value;_self.loadItems(text)};var highlightSuggestItem=function(itemIndex){if(suggestDiv.style.display!='none'){var list=suggestDiv.firstChild;var oldHighlited=list.childNodes.item(suggestIndex);if(oldHighlited){oldHighlited.className=''}list.childNodes.item(itemIndex).className='active';suggestIndex=itemIndex}};var addHighlitedItem=function(){if(suggestDiv&&suggestDiv.style.display!='none'&&suggestIndex!==null){var id=suggestItems[suggestIndex].getAttribute('id');var name=suggestItems[suggestIndex].getAttribute('name');var type=suggestItems[suggestIndex].getAttribute('type');if(type!='user'){_self.add(id,name,guestLevel,true)}else{$.ajax({url:"/udata/users/getUserPermissions/"+id+"/"+window.page_id+"/",method:"get",complete:function(r){var u=r.responseXML.getElementsByTagName('user');var p=guestLevel;if(u.length){p=parseInt($(u[0]).text())}_self.add(id,name,p,true)}})}}};var inputBlur=function(){if(suggestDiv){if(mouseX<parseInt(suggestDiv.style.left)||mouseX>(parseInt(suggestDiv.style.left)+parseInt(suggestDiv.offsetWidth))||mouseY<parseInt(suggestDiv.style.top)||mouseY>(parseInt(suggestDiv.style.top)+parseInt(suggestDiv.offsetHeight))){hideSuggest()}}};var inputKeyup=function(e){var keyCode=e?e.keyCode:window.event.keyCode;switch(keyCode){case 38:{if(suggestItems.length&&(suggestIndex>0||suggestIndex==null)){highlightSuggestItem((suggestIndex===null)?(suggestItems.length-1):(suggestIndex-1))}break}case 40:{if(suggestItems.length&&(suggestIndex<(suggestItems.length-1)||suggestIndex==null)){highlightSuggestItem((suggestIndex===null)?0:(suggestIndex+1))}break}case 13:{addHighlitedItem();hideSuggest();return false;break}case 27:{hideSuggest();break}default:{_self.doSearch()}}};var showSuggest=function(){if(suggestDiv){var pos=$(input).offset();suggestDiv.style.width=input.clientWidth;suggestDiv.style.top=pos.top+input.offsetHeight;suggestDiv.style.left=pos.left;suggestDiv.style.display=''}};var hideSuggest=function(){if(suggestDiv&&suggestDiv.style.display!='none'){suggestDiv.style.display='none';$(document).unbind('mousemove',documentMouseMoveHandler)}};var documentMouseMoveHandler=function(e){if(!e){mouseX=event.clientX+document.body.scrollLeft;mouseY=event.clientY+document.body.scrollTop}else{mouseX=e.pageX;mouseY=e.pageY}return true};var getElementText=function(element){return(element.firstChild&&element.firstChild.nodeType==3)?element.firstChild.nodeValue:element.nodeValue};construct()};function fileControl(name,options){var _self=this;var container=document.getElementById('fileControlContainer_'+name);var select=null;var inputName=options.inputName||name;var imagesOnly=options.imagesOnly||false;var videosOnly=options.videosOnly||false;var cwd='.';var defaultCwd='.';var loaded=false;var construct=function(){select=document.createElement('select');container.appendChild(select);select.onmouseover=function(){if(!loaded)loadListing()};window['fileControlSelect_'+name]=select;select.id='fileControlSelect_'+name;select.name=inputName;select.control=_self;select.className='fileControlSelect';var option=document.createElement('option');option.innerHTML='';option.value='';option.selected=true;select.appendChild(option);var img=document.createElement('img');img.src="/images/cms/browse_folder.png";var a=document.createElement('a');a.href='javascript:void(0);';a.onclick=function(){showFileBrowser(select.id,defaultCwd,imagesOnly,videosOnly)};a.appendChild(img);container.appendChild(a)};var showFileBrowser=function(selectId,folder,imageOnly,videoOnly){var qs='id='+selectId;var index=0;var file=cwd.replace(/^\.\//,"/")+((index=select.value.lastIndexOf('/'))!=-1?select.value.substr(index):select.value);qs=qs+'&file='+file;if(folder){qs=qs+'&folder='+folder}if(imageOnly){qs=qs+'&image=1'}if(videoOnly){qs=qs+'&video=1'}$.openPopupLayer({name:"Filemanager",title:"Файловый менеджер",width:660,height:460,url:"/styles/common/other/filebrowser/umifilebrowser.html?"+qs})};this.clearItems=function(){while(select.options.length){select.options[0].parentNode.removeChild(select.options[0])}var option=document.createElement('option');option.innerHTML='';option.value=cwd+'/';option.selected=true;select.appendChild(option);loaded=false};var loadListing=function(){loaded=true;$.ajax({url:"/admin/data/getfilelist/?folder="+base64encode(cwd.substr(1))+(imagesOnly?"&showOnlyImages=1":"")+(videosOnly?"&showOnlyVideos=1":""),type:"get",complete:function(r,t){_self.updateItems(r)}})};this.updateItems=function(response){var files=response.responseXML.getElementsByTagName('file');if(!select.options.length){this.add(null,true)}for(var i=0;i<files.length;i++){this.add(files[i].getAttribute('name'))}if($.browser.msie){var d=select.style.display;select.style.display='none';select.style.display=d}};this.setFolder=function(name,isDefault){if(cwd!=name){cwd=name;this.clearItems()}if(isDefault!=undefined&&isDefault){defaultCwd=name}};this.add=function(name,selected){if(name&&!name.length)return;if(!name)name='';if(name.lastIndexOf("/")!=-1){this.setFolder(name.substr(0,name.lastIndexOf("/")));name=name.substr(name.lastIndexOf("/")+1)}for(var i=0;i<select.options.length;i++){if(select.options[i].innerHTML==name){if(selected)select.options[i].selected=selected;return}}var option=document.createElement('option');option.innerHTML=name;option.value=((cwd.indexOf("./")!=0)?'.':'')+(cwd+'/'+name);if(selected!=undefined&&selected)option.selected=true;select.appendChild(option)};construct()}(function(){var checkPrivateMessages=function(){jQuery.get('/umess/inbox/?mark-as-opened=1',function(xml){jQuery('message',xml).each(function(index,node){var title=jQuery(node).attr('title');var content=jQuery('content',node).text();var date=jQuery('date',node).text();var sender=jQuery('sender',node).attr('name');content='<p>'+content+'</p><div class="header">'+date+', '+sender+'</div>';jQuery.jGrowl(content,{'header':title,'life':10000})})});setTimeout(checkPrivateMessages,15000)};checkPrivateMessages()})();